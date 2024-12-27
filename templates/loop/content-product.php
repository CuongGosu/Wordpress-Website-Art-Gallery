<li class="item-product"  data-aos="zoom-in">
                <a href="<?php the_permalink() ?>" class="product-thumbnail">
                  <div class="thumbnail-primary">
                    <img src="<?php thePostThumbnailUrl() ?>" alt="<?php the_title() ?>" />
                  </div>
                  <div class="thumbnail-secondary">
                  <?php
                    // Lấy danh sách ID hình ảnh từ album sản phẩm (nếu có)
                    $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
                    
                    if ($gallery) {
                        // Tách chuỗi gallery thành mảng các ID hình ảnh
                        $gallery_ids = explode(',', $gallery);
                        
                        // Lấy ID của hình ảnh đầu tiên trong album
                        $first_image_id = $gallery_ids[0];
                        
                        // Lấy URL của hình ảnh đầu tiên từ ID
                        $first_image_url = wp_get_attachment_url($first_image_id);
                        
                        // Nếu URL tồn tại, hiển thị hình ảnh đầu tiên trong album
                        if ($first_image_url) {
                            echo '<img src="' . esc_url($first_image_url) . '" alt="' . esc_attr(get_the_title()) . '" />';
                        } else {
                            // Fallback nếu không có hình ảnh nào, sử dụng ảnh thumbnail chính
                            echo '<img src="' . get_the_post_thumbnail_url() . '" alt="' . esc_attr(get_the_title()) . '" />';
                        }
                    } else {
                        // Fallback nếu không có album hình ảnh, sử dụng ảnh thumbnail chính
                        echo '<img src="' . get_the_post_thumbnail_url() . '" alt="' . esc_attr(get_the_title()) . '" />';
                    }
                    ?>
                  </div>
                </a>
                <div class="box-content">
                  <h3 class="info-name"><?php the_title() ?></h3>
                  <span class="info-text">
                    <span class="info-text-type">
                  <?php
                          // Lấy các term của taxonomy 'material' cho post hiện tại
                          $terms = get_the_terms(get_the_ID(), 'product_cat');
                          
                          // Kiểm tra nếu có term, và hiển thị term đầu tiên
                          if ($terms && !is_wp_error($terms)) {
                              echo esc_html($terms[0]->name) . " /"; // Hiển thị tên của term đầu tiên
                          
                          } else {
                              echo ''; // Dòng này sẽ hiển thị nếu không có chất liệu nào
                          }
                        ?>     
                        </span>
                        <span class="info-text-size">
                  
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
                </span>
                      <?php if (!empty($price_regular)) : ?>
                        <span class="info-price"><?php echo getPostMeta($price_regular); ?> vnđ</span>
                    <?php endif; ?>
                </div>
</li>