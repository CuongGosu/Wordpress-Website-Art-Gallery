<?php 
     $artist_id = get_post_meta(get_the_ID(), 'artist', true);
     if ($artist_id) {
        $artist = get_post($artist_id);
        $artist_name = get_the_title($artist_id); // Lấy tên nghệ sĩ
        $artist_url = get_permalink($artist_id);
     }
?>
<li class="item-product-primary"  data-aos="zoom-in">
                <a href="<?php the_permalink() ?>" class="item-thumbnail">
                  <figure>
                    <img src="<?php thePostThumbnailUrl() ?>" alt="<?php the_title() ?>"/>
                  </figure>
                </a>
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
                  <h3 class="item-name"><?php the_title() ?></h3>
                  <a href="<?php echo $artist_url ?>" class="button-secondary"><?php echo $artist_name ?></a>
                </div>
</li>