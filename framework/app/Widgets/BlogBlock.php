<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

use function PHPSTORM_META\type;

class BlogBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('blog_block', __('Danh sách bài viết', 'nrglobal'), __('Hiển thị các tin tức', 'nrglobal'), [
          Field::make('image', 'bg_block', __('Ảnh nền trang tin tức', 'nrglobal')),
          Field::make('text', 'sub_title', __('Tiêu đề phụ', 'nrglobal')),
          Field::make('text', 'main_title', __('Tiêu đề chính', 'nrglobal')),
          Field::make('multiselect', 'blog_category', __('Lọc theo danh mục', 'nrglobal'))
          ->set_options(function () {
              $terms = get_terms(['taxonomy' => 'category', 'hide_empty' => false ]);
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
          Field::make('text', 'blog_per_page', __('Số lượng', 'nrglobal'))
          ->set_default_value(8)
          ->set_attributes(['type' => 'number']),
            Field::make('radio', 'blog_style', __('Sắp xếp theo', 'nrglobal'))

                  ->set_options([

                      'feature-blog'   => __('Nổi bật', 'nrglobal'),

                      'new-blog'       => __('Mới nhất', 'nrglobal'),
            ]),
        ]);
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
      $blog_style = $instance['blog_style']; 
      $blog_category = $instance['blog_category']; 

      switch ($blog_style) {
          case 'new-blog':
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
      if (in_array(0, $blog_category)) {
        // Không thêm 'tax_query' khi chọn "Tất cả"
        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $instance['blog_per_page'],
            'meta_query'     => $meta_query,
        ];
      } else {
        // Nếu chọn danh mục cụ thể, thêm 'tax_query' vào
        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $instance['blog_per_page'],
            'meta_query'     => $meta_query,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $blog_category,
                    'operator' => 'IN',
                ],
            ],
        ];
      }
       $listBlog = new \WP_Query($args);
        if (is_home()) {
            ?>
        <section class="section-top-blog" style="--url-backgroundBlog:url(<?php echo getImageUrlById($instance['bg_block']) ?>);">
          <div class="wrapper">
            <div class="product-inner">
              <div class="info-primary" data-aos="zoom-in" data-aos-anchor-placement="center-bottom">
                <h2 class="heading-secondary">
                  <span class="line line-left"></span>
                  <span class="heading-text"> Tin tức </span>
                  <span class="line line-right"></span>
                </h2>
              </div>
            </div>
            <div class="blog-swiper">
              <ul class="swiper-wrapper list-blog">
              <?php
                  if($listBlog->have_posts()){
                      while($listBlog->have_posts()){
                      $listBlog->the_post();
                      ?>
                 <li class="swiper-slide item-blog " data-aos="fade-up"
                 data-aos-anchor-placement="top-bottom">
                  <a href="#" class="blog-thumbnail object-fit">
                    <figure>
                      
                      <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title(); ?>" />
                    </figure>
                  </a>
                  <div class="blog-info">
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="info-time"><?php echo get_the_date() ?></time>
                    <h3 class="info-title">
                        <?php echo get_the_title()?>
                    </h3>
                    <a href="#" class="button-tertiary">Xem chi tiết</a>
                  </div>
                </li>
                      <?php          
                      }

                      wp_reset_postdata();
                      wp_reset_query();

                  }

                ?>
              
              </ul>
              <div class="blog-control swiper-button-next"></div>
              <div class="blog-control swiper-button-prev"></div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </section>
            <?php
        }
    }
}
