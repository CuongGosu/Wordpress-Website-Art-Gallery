<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

use function PHPSTORM_META\type;

class ProductBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('product_block', __('Danh sách đổ cổ', 'nrglobal'), __('Hiển thị những bức tranh', 'nrglobal'), [
          Field::make('text', 'sub_title', __('Tiêu đề phụ', 'nrglobal')),
          Field::make('text', 'main_title', __('Tiêu đề chính', 'nrglobal')),
          Field::make('multiselect', 'product_category', __('Lọc theo danh mục', 'nrglobal'))
          ->set_options(function () {
              $terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false ]);
              $items = [];
              $items[0] = __('Tất cả', 'nrglobal');
              foreach ($terms as $term) {
                  if($term->parent == 0){
                      $items[$term->term_id] = $term->name;
                      $items += get_child_terms($term->term_id, $terms, '--');
                  }
              }
              return $items;
          }),
          Field::make('text', 'product_per_page', __('Số lượng', 'nrglobal'))

          ->set_default_value(8)

          ->set_attributes(['type' => 'number']),

            Field::make('radio', 'product_style', __('Sắp xếp theo', 'nrglobal'))

                  ->set_options([

                      'feature-product'   => __('Nổi bật', 'nrglobal'),

                      'new-product'       => __('Mới nhất', 'nrglobal'),

            ]),

        ]);
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
      $product_style = $instance['product_style']; 
      $product_category = $instance['product_category']; 
     

      switch ($product_style) {
          case 'new-product':
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
      if (in_array(0, $product_category)) {
        // Không thêm 'tax_query' khi chọn "Tất cả"
        $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => $instance['product_per_page'],
            'meta_query'     => $meta_query,
        ];
      } else {
        // Nếu chọn danh mục cụ thể, thêm 'tax_query' vào
        $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => $instance['product_per_page'],
            'meta_query'     => $meta_query,
            'tax_query'      => [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $product_category,
                    'operator' => 'IN',
                ],
            ],
        ];
      }
       $listProduct = new \WP_Query($args);
        if (is_home()) {
            ?>
        <section class="section-product-secondary">
          <div class="wrapper">
            <div class="product-inner">
              <div class="info-primary" data-aos="zoom-in" data-aos-anchor-placement="center-bottom" >
              <span class="title-primary"><?php echo $instance['sub_title'] ?></span>
                <h2 class="heading-secondary">
                  <span class="line line-left"></span>
                  <span class="heading-text"> <?php echo $instance['main_title'] ?> </span>
                  <span class="line line-right"></span>
                </h2>
              </div>
            </div>
            <div class="product-secondary-swiper">
              <ul class="list-product-secondary swiper-wrapper">
              <?php
                if($listProduct->have_posts()){
                    while($listProduct->have_posts()){
                     $listProduct->the_post();
                    ?>
                  <li class="item-product swiper-slide">
                  <a href="<?php echo get_the_permalink() ?>">
                    <figure class="item-thumbnail">
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title() ?>" />
                    </figure>
                    <div class="item-info">
                      <h3 class="info-name"><?php echo get_the_title() ?></h3>
                      <span class="info-text">
                      <?php
                          // Lấy các term của taxonomy 'material' cho post hiện tại
                          $terms = get_the_terms(get_the_ID(), 'product_cat');
                          
                          // Kiểm tra nếu có term, và hiển thị term đầu tiên
                          if ($terms && !is_wp_error($terms)) {
                              echo esc_html($terms[0]->name); // Hiển thị tên của term đầu tiên
                              "/";
                          } else {
                              echo ''; // Dòng này sẽ hiển thị nếu không có chất liệu nào
                          }
                        ?>  
                       <?php echo getPostMeta('width') ?> / C <?php echo getPostMeta('height') ?> × R <?php echo getPostMeta('size') ?></span>
                      <?php if (!empty($price_regular)) : ?>
                        <span class="info-price"><?php echo number_format($price_regular, 0, ',', '.'); ?> vnđ</span>
                    <?php endif; ?>
                    </div>
                  </a>
                </li>
                    <?php          
                    }

                    wp_reset_postdata();
                    wp_reset_query();

                }

              ?>
              
              </ul>
              <div class="swiper-pagination"></div>
            </div>
            <a href="<?php echo home_url('cua-hang') ?>" class="button-primary red">Xem thêm</a>
          </div>
        </section>
            <?php
        }
    }
}
