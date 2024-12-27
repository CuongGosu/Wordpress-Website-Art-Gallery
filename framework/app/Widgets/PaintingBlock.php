<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

use function PHPSTORM_META\type;

class PaintingBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('painting_block', __('Danh sách tác phẩm', 'nrglobal'), __('Hiển thị những bức tranh', 'nrglobal'), [
          Field::make('image', 'bg_block', __('Ảnh nền', 'nrglobal')),
          Field::make('text', 'sub_title', __('Tiêu đề phụ', 'nrglobal')),
          Field::make('text', 'main_title', __('Tiêu đề chính', 'nrglobal')),
          Field::make('multiselect', 'painting_category', __('Lọc theo danh mục', 'nrglobal'))
          ->set_options(function () {
              $terms = get_terms(['taxonomy' => 'painting_cat', 'hide_empty' => false ]);
              $items = [];
              $items[0] = __('Tất cả', 'nrglobal');
              foreach ($terms as $term) {
                  if($term->parent == 0){
                      $items[$term->term_id] = $term->name;
                      $items = array_merge($items, get_child_terms($term->term_id, $terms, '--'));
                  }
              }
              return $items;
          }),
          Field::make('text', 'painting_per_page', __('Số lượng', 'nrglobal'))

          ->set_default_value(8)

          ->set_attributes(['type' => 'number']),

            Field::make('radio', 'painting_style', __('Sắp xếp theo', 'nrglobal'))

                  ->set_options([

                      'feature-painting'   => __('Nổi bật', 'nrglobal'),

                      'new-painting'       => __('Mới nhất', 'nrglobal'),

            ]),

        ]);
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
      $painting_style = $instance['painting_style']; 
      $painting_category = $instance['painting_category']; 
     

      switch ($painting_style) {
          case 'new-painting':
              $meta_query = [];
             break;
         
          default:
              
              $meta_query[] = [

                array(

                    'key'     => '_is_feature',

                    'value'   => 'yes',

                )

            ];  
              break;
      }

          // Kiểm tra nếu trong mảng có chứa giá trị 0 (tức là chọn "Tất cả")
          if (in_array(0, $painting_category)) {
            // Không thêm 'tax_query' khi chọn "Tất cả"
            $args = [
                'post_type'      => 'painting',
                'post_status'    => 'publish',
                'posts_per_page' => $instance['painting_per_page'],
                'meta_query'     => $meta_query,
            ];
          } else {
            // Nếu chọn danh mục cụ thể, thêm 'tax_query' vào
            $args = [
                'post_type'      => 'painting',
                'post_status'    => 'publish',
                'posts_per_page' => $instance['painting_per_page'],
                'meta_query'     => $meta_query,
                'tax_query'      => [
                    [
                        'taxonomy' => 'painting_cat',
                        'field'    => 'term_id',
                        'terms'    => $painting_category,
                        'operator' => 'IN',
                    ],
                ],
            ];
          }
       $listPainting = new \WP_Query($args);
        if (is_home()) {
            ?>
          <section class="section-product-primary" style="--url-background:url(<?php echo getImageUrlById($instance['bg_block']) ?>);">
          <div class="wrapper">
            <div class="product-inner">
              <div class="info-primary" data-aos="zoom-in" data-aos-anchor-placement="center-bottom">
                <span class="title-primary"><?php echo $instance['sub_title'] ?></span>
                <h2 class="heading-secondary">
                  <span class="line line-left"></span>
                  <span class="heading-text"> <?php echo $instance['main_title'] ?> </span>
                  <span class="line line-right"></span>
                </h2>
              </div>
            </div>
            <ul class="list-product-primary">
              <?php
                if($listPainting->have_posts()){
                    while($listPainting->have_posts()){
                     $listPainting->the_post();
                    ?>
                     <li class="item-product-primary" data-aos="zoom-out-up" data-aos-anchor-placement="center-bottom">
                      <div class="item-thumbnail">
                        <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title() ?>" />
                      </div>
                      <div class="item-box">
                        <p class="box-info">
                          <span class="info-type">
                          <?php
                          // Lấy các term của taxonomy 'material' cho post hiện tại
                          $terms = get_the_terms(get_the_ID(), 'material');
                          
                          // Kiểm tra nếu có term, và hiển thị term đầu tiên
                          if ($terms && !is_wp_error($terms)) {
                              echo esc_html($terms[0]->name); // Hiển thị tên của term đầu tiên
                          } else {
                              echo ''; // Dòng này sẽ hiển thị nếu không có chất liệu nào
                          }
                        ?>
                          </span>
                          <span class="info-text"> / <?php echo getPostMeta('width') ?> / C <?php echo getPostMeta('height') ?> × R <?php echo getPostMeta('size') ?></span>
                        </p>
                        <h3 class="item-name"><?php echo get_the_title() ?></h3>
                        <a href="<?php echo get_the_permalink() ?>" class="button-secondary">Xem chi tiết</a>
                      </div>
                   </li>
                    <?php          
                    }

                    wp_reset_postdata();

                    wp_reset_query();

                }

              ?>

            </ul>
            <a href="<?php echo home_url('tac-pham') ?>" class="button-primary red">Xem thêm</a>
          </div>
        </section>
            <?php
        }
    }
}
