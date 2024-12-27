<li class=" item-blog">
                  <a href="<?php the_permalink() ?>" class="blog-thumbnail object-fit">
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt />
                  </a>
                  <div class="blog-info">
                    <time datetime="<?php echo get_the_date() ?>" class="info-time"><?php echo get_the_date() ?></time>
                    <h3 class="info-title">
                        <?php echo get_the_title()?>
                    </h3>
                    <a href="<?php the_permalink() ?>" class="button-tertiary">Xem chi tiết</a>
                  </div>
 </li>