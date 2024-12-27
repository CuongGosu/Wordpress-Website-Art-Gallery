<?php get_header() ;

?>
<main>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">
          <div class="wrapper">
            <h1 class="heading-territory">Chi tiết sản phẩm</h1>
          </div>
        </section>
        <section class="section-detail-product">
          <div class="wrapper">
            <div class="product-inner">
              <div class="product-left">
                <?php
                   $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
                   $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                   $thumbnail_url = wp_get_attachment_url($thumbnail_id);
                   if ($gallery) {
                    $gallery_ids = explode(',', $gallery);
                ?>
                <div class="swiper thumbnail-preview">
                  <div class="swiper-wrapper list-thumbnail-preview">
                  <div class="swiper-slide object-fit preview-item">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Thumbnail Image" />
                  </div>
                  <?php
                // Duyệt qua từng ID hình ảnh trong gallery
                    foreach ($gallery_ids as $attachment_id) {
                        // Lấy URL của hình ảnh tương ứng
                        $image_url = wp_get_attachment_url($attachment_id);

                        if ($image_url) { // Kiểm tra nếu URL tồn tại
                ?>
                <div class="swiper-slide object-fit preview-item">
                  <img src="<?php echo esc_url($image_url); ?>" alt="Gallery Image" />
                </div>
                <?php
                        }
                    }
                ?>
                  </div>
                </div>
                <?php } ?>
                <div class="swiper thumbnail-hero">
                  <div class="swiper-wrapper">
                  <div class="swiper-slide object-fit preview-item">
                     <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Thumbnail Image" />
                 </div>
                  <?php
                     if ($gallery){
                // Duyệt qua từng ID hình ảnh trong gallery
                    foreach ($gallery_ids as $attachment_id) {
                        // Lấy URL của hình ảnh tương ứng
                        $image_url = wp_get_attachment_url($attachment_id);

                        if ($image_url) { // Kiểm tra nếu URL tồn tại
                ?>
                <div class="swiper-slide object-fit slide-image">
                  <img src="<?php echo esc_url($image_url); ?>" alt="Gallery Image" />
                </div>
                <?php
                        }
                    }
                  }
                ?>

                  </div>
                </div>
              </div>
              <div class="product-right">
                <h3 class="title-product"><?php theTitle() ?></h3>
                <div>
                  <span>              
                    <?php
                          // Lấy các term của taxonomy 'material' cho post hiện tại
                          $terms = get_the_terms(get_the_ID(), 'product_cat');
                          
                          // Kiểm tra nếu có term, và hiển thị term đầu tiên
                          if ($terms && !is_wp_error($terms)) {
                              echo esc_html($terms[0]->name) . " /"; // Hiển thị tên của term đầu tiên
                          
                          } else {
                              echo ''; // Dòng này sẽ hiển thị nếu không có chất liệu nào
                          }
                        ?>      </span>
   
                </div>
                <div>
                <?php
                                   if(getPostMeta('width')){
                                    echo "C /". getPostMeta('width') ;
                                  }
                                
                                  if(getPostMeta('height')){
                                    echo "R /". getPostMeta('height') ;
                                  }
                                
                                  if(getPostMeta('size')){
                                    echo "S /". getPostMeta('size') ;
                                  }
                ?>
              
              
              </span>
                  
                <a class="button-contact" href="#" target="_blank">Liên hệ</a>
                <div class="more-info">
                  <?php if(getPostMeta('price_regular')){?>
                <span class="info-price"><?php echo number_format(getPostMeta('price_regular'), 0, ',', '.'); ?> vnđ</span>
                    <?php }?>
              </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section-intro-painting">
          <div class="wrapper">
            <h2 class="heading-title">Giới thiệu về sản phẩm</h2>
            <div class="intro-inner">
              <div class="intro-top">
                <?php theContent() ?>
              </div>
              <div class="intro-bottom"></div>
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
        $terms = get_the_terms(get_the_ID(), 'product_cat');
        
        if ($terms && !is_wp_error($terms)) {
            $term_ids = wp_list_pluck($terms, 'term_id');
            
            // Query các bài viết liên quan có cùng 'material'
            $args = [
                'post_type' => 'product',  // Tên post type của bạn
                'posts_per_page' => 6,      // Số lượng bài viết muốn hiển thị
                'post__not_in' => [get_the_ID()],  // Loại trừ bài viết hiện tại
                'tax_query' => [
                    [
                        'taxonomy' => 'product_cat',
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