<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

use function PHPSTORM_META\type;

class ArtistBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('artist_block', __('Danh sách Nghệ sĩ', 'nrglobal'), __('Hiển thị danh sách nghệ sĩ', 'nrglobal'), [
          Field::make('text', 'sub_title', __('Tiêu đề phụ', 'nrglobal')),
          Field::make('text', 'main_title', __('Tiêu đề chính', 'nrglobal')),
          Field::make('multiselect', 'artist_category', __('Lọc theo danh mục', 'nrglobal'))
          ->set_options(function () {
              $terms = get_terms(['taxonomy' => 'artist_cat', 'hide_empty' => false ]);
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
          Field::make('text', 'artist_per_page', __('Số lượng', 'nrglobal'))

          ->set_default_value(8)
          
          ->set_attributes(['type' => 'number']),
        ]);
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
      $artist_category = $instance['artist_category']; 


          // Kiểm tra nếu trong mảng có chứa giá trị 0 (tức là chọn "Tất cả")
          if (in_array(0, $artist_category)) {
            // Không thêm 'tax_query' khi chọn "Tất cả"
            $args = [
                'post_type'      => 'artist',
                'post_status'    => 'publish',
                'posts_per_page' => $instance['artist_per_page'],
            ];
          } else {
            // Nếu chọn danh mục cụ thể, thêm 'tax_query' vào
            $args = [
                'post_type'      => 'artist',
                'post_status'    => 'publish',
                'posts_per_page' => $instance['artist_per_page'],
                'tax_query'      => [
                    [
                        'taxonomy' => 'artist_cat',
                        'field'    => 'term_id',
                        'terms'    => $artist_category,
                        'operator' => 'IN',
                    ],
                ],
            ];
          }
       $listArtist = new \WP_Query($args);
        if (is_home()) {
            ?>
         <section class="section-top-artist">
          <div class="wrapper">
            <div class="info-primary" data-aos="zoom-in" data-aos-anchor-placement="center-bottom">
              <span class="title-primary"><?php echo $instance['sub_title']?></span>
              <h2 class="heading-secondary">
                <span class="line line-left"></span>
                <span class="heading-text"> <?php echo $instance['main_title']?></span>
                <span class="line line-right"></span>
              </h2>
            </div>
            <div class="artist-swiper">
              <ul class="swiper-wrapper list-artist">
              <?php
                if($listArtist->have_posts()){
                    while($listArtist->have_posts()){
                     $listArtist->the_post();
                    ?>
                  <li class="item-artist swiper-slide">
                  <a href="<?php echo get_the_permalink() ?>">
                    <div class="artist-avatar object-fit">
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title() ?>" />
                    </div>
                    <div class="artist-info">
                      <?php
                        if(getPostMeta('birth')){
                          echo '<p class="info-birth">'.getPostMeta('birth').'</p>';
                        }
                      ?>
                      <p class="info-name"><?php echo get_the_title() ?></p>
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
              <div class="artist-control swiper-button-next"></div>
              <div class="artist-control swiper-button-prev"></div>
              <div class="swiper-pagination"></div>
            </div>
            <a href="<?php echo home_url('nghe-si') ?>" class="button-primary red">Xem thêm</a>
          </div>
        </section>
            <?php
        }
    }
}
