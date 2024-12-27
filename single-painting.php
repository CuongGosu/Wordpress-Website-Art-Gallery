<?php get_header() ;
     $artist_id = get_post_meta(get_the_ID(), 'artist', true);
     if ($artist_id) {
        $artist = get_post($artist_id);
        $artist_name = get_the_title($artist_id); // Lấy tên nghệ sĩ
        $artist_url = get_permalink($artist_id);
        $artist_address = getPostMeta("address",$artist_id);
        $artist_content = apply_filters('the_content', $artist->post_content);
     }  $artist_thumbnail_url = get_the_post_thumbnail_url($artist_id, 'full');
        // Truy vấn các tác phẩm liên kết với nghệ sĩ


?>
<main>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">
          <div class="wrapper">
            <h1 class="heading-territory">Chi tiết tác phẩm</h1>
          </div>
        </section>
        <section class="section-detail-painting">
          <div class="wrapper">
            <div class="painting-inner">
              <div class="painting-left">
                <figure class="artist-thumbnail object-fit">
                  <img src="<?php thePostThumbnailUrl()?>" alt="<?php theTitle() ?>" />
                </figure>
              </div>
              <div class="painting-right">
                <h2 class="title-product"><?php theTitle() ?></h2>
                <h4 class="name-artist">
                        <a href="<?php echo esc_url($artist_url); ?>">
                            <?php echo esc_html($artist_name); // Hiển thị tên nghệ sĩ ?>
                        </a>
                    </h4>
                <p class="info-location"><?php echo esc_html($artist_address); ?></p>
                <div>
                  <span>
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
                </div>
                <div>
                <span class="info-text"> C <?php echo getPostMeta('width') ?> × R <?php echo getPostMeta('height') ?> × S <?php echo getPostMeta('size') ?>cm</span>
                </div>
                <a class="button-contact" href="#" target="_blank">Liên hệ</a>
                <div class="more-info">
                  <?php echo getPostMeta('sub_information') ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section-intro-painting">
          <div class="wrapper">
            <h2 class="heading-title">Giới thiệu về tác phẩm</h2>
            <div class="intro-inner">
              <div class="intro-top">
                <?php theContent() ?>
              </div>
              <div class="intro-bottom">
                <?php
                     $terms = get_the_terms(get_the_ID(), 'material');
                          
                     // Kiểm tra nếu có term, và hiển thị term đầu tiên
                     if ($terms && !is_wp_error($terms)) {
                      $term_names = [];
                      foreach ($terms as $term) {
                          $term_names[] = esc_html($term->name);
                      }
                      $paintingMaterial = new Theme\Taxonomies\PaintingMaterial();
                      echo "<div>". $paintingMaterial->singular . ": ";
                      echo implode(', ', $term_names) . "</div>";
                     }
                ?>
                <?php
                     $terms = get_the_terms(get_the_ID(), 'painting_cat');
                          
                     // Kiểm tra nếu có term, và hiển thị term đầu tiên
                     if ($terms && !is_wp_error($terms)) {
                      $term_names = [];
                      foreach ($terms as $term) {
                          $term_names[] = esc_html($term->name);
                      }
                      $paintingCat = new Theme\Taxonomies\PaintingCat();
                      echo "<div>". $paintingCat->singular . ": ";
                      echo implode(', ', $term_names) . "</div>";
                     }
                ?>
                <?php
                     $terms = get_the_terms(get_the_ID(), 'style');
                          
                     // Kiểm tra nếu có term, và hiển thị term đầu tiên
                     if ($terms && !is_wp_error($terms)) {
                      $term_names = [];
                      foreach ($terms as $term) {
                          $term_names[] = esc_html($term->name);
                      }
                      $paintingStyle = new Theme\Taxonomies\PaintingStyle();
                      echo "<div>". $paintingStyle->singular . ": ";
                      echo implode(', ', $term_names) . "</div>";

                     }
                ?>
                <?php
                     $terms = get_the_terms(get_the_ID(), 'topic');
                          
                     // Kiểm tra nếu có term, và hiển thị term đầu tiên
                     if ($terms && !is_wp_error($terms)) {
                      $term_names = [];
                      foreach ($terms as $term) {
                          $term_names[] = esc_html($term->name);
                      }
                      $paintingTopic = new Theme\Taxonomies\PaintingStyle();
                      echo "<div>". $paintingTopic->singular . ": ";
                      echo implode(', ', $term_names) . "</div>";
                     }
                ?>
              </div>
            </div>
          </div>
        </section>
        <section class="section-artist-painting">
          <div class="wrapper">
            <h3 class="heading-title">Giới thiệu tác giả</h3>
            <div class="artist-box">
              <div class="box-content">
                <?php echo $artist_content;  ?>
              </div>
              <a class="box-thumbnail" href="#">
                <figure class="thumbnail-image">
                    <?php
                      echo '<img src="' . esc_url($artist_thumbnail_url) . '" alt="' . get_the_title($artist_id) . '" />';
                    ?>
                </figure>
              </a>
            </div>
          </div>
        </section>
        <section class="section-painting-similar">
  <div class="wrapper">
    <h2 class="heading-title">Tác phẩm cùng loại</h2>
    <div class="similar-box swiper">
      <div class="swiper-wrapper similar-wrapper">
        <?php
        // Lấy các term của taxonomy 'material' cho post hiện tại
        $terms = get_the_terms(get_the_ID(), 'material');
        
        if ($terms && !is_wp_error($terms)) {
            $term_ids = wp_list_pluck($terms, 'term_id');
            
            // Query các bài viết liên quan có cùng 'material'
            $args = [
                'post_type' => 'painting',  // Tên post type của bạn
                'posts_per_page' => 6,      // Số lượng bài viết muốn hiển thị
                'post__not_in' => [get_the_ID()],  // Loại trừ bài viết hiện tại
                'tax_query' => [
                    [
                        'taxonomy' => 'material',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                    ],
                ],
            ];
            
            $similar_query = new WP_Query($args);
            
            if ($similar_query->have_posts()) :
                while ($similar_query->have_posts()) : $similar_query->the_post(); ?>
                  <div class="swiper-slide similar-slide">
                    <a href="<?php the_permalink(); ?>">
                      <figure class="similar-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('medium'); // Hiển thị thumbnail của bài viết ?>
                        <?php endif; ?>
                      </figure>
                      <div class="similar-info">
                        <h4 class="similar-title"><?php the_title(); ?></h4>
                        <p class="similar-type">
                          <?php
                          // Lấy lại term 'material' của bài viết này để hiển thị
                          $product_terms = get_the_terms(get_the_ID(), 'material');
                          if ($product_terms && !is_wp_error($product_terms)) {
                              echo esc_html($product_terms[0]->name); // Hiển thị term đầu tiên
                          }
                          ?>
                        </p>
                        <p class="similar-artist">
                          <?php
                          // Lấy custom field 'artist' của bài viết
                          $artist_id = get_post_meta(get_the_ID(), 'artist', true);
                          if ($artist_id) {
                              echo esc_html(get_the_title($artist_id)); // Hiển thị tên của nghệ sĩ
                          }
                          ?>
                        </p>
                      </div>
                    </a>
                  </div>
                <?php endwhile; 
                wp_reset_postdata();
            else :
                echo '<p>Không có tác phẩm nào cùng loại.</p>';
            endif;
        } else {
            echo '<p>Không có chất liệu tương ứng.</p>';
        }
        ?>
      </div>
      <div class="button-control swiper-button-next"></div>
      <div class="button-control swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

      </main>

<?php get_footer() ?>