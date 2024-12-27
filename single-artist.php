<?php get_header() ?>
<main>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">

          <div class="wrapper">
            <h2 class="heading-territory">Câu chuyện nghệ sĩ</h2>
          </div>
</section>
        <section class="section-detail-artist">
          <div class="wrapper">
            <div class="artist-inner">
              <div class="artist-left">
                <figure class="artist-thumbnail object-fit">
                  <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>" />
                </figure>
                <div class="artist-information">
                  <h2 class="artist-name"><?php the_title(); ?></h2>
                  <p class="artist-info flex">
                    <?php if(getPostMeta('birth')){ ?>
                    <span class="info-birth"><?php getPostMeta('birth') ?></span>
                    <?php } ?>
                    <?php if (getPostMeta('location')) { ?>
                    <span class="info-location"><?php getPostMeta('location') ?></span>
                    <?php } ?>
                  </p>

                  <div class="artist-introducation">
                    <span class="intro-description">
                      <?php echo theContent() ?>
                    </span>
                    <button class="toggle-btn">Xem thêm</button>
                  </div>
                  <?php if(getPostMeta('main_train')){ ?>
                  <div class="artist-learn">
                    <h4>Đào tạo</h4>
                    <ul class="list-learn">
                        <?php foreach(getPostMeta('main_train') as $main_train){?>
                      <li>
                        <time datetime="<?php echo $main_train['mock_time'] ?>"><?php echo $main_train['mock_time'] ?> </time>
                        <p><?php echo $main_train['information'] ?></p>
                      </li>
                      <?php } ?>
                    </ul>
                    <button class="toggle-btn">Xem thêm</button>
                  </div>
                  <?php } ?>
                  <?php if(getPostMeta('main_exhibition')){ ?>
                  <div class="artist-exhibition">
                    <h4>Triển lãm</h4>
                    <ul class="list-exhibition">
                    <?php foreach(getPostMeta('main_exhibition') as $main_exhibition){?>
                      <li>
                      <time datetime="<?php echo $main_exhibition['mock_time'] ?>"><?php echo $main_exhibition['mock_time'] ?> </time>
                      <p><?php echo $main_exhibition['information'] ?></p>
                      </li>
                      <?php } ?>
                    </ul>
                    <button class="toggle-btn">Xem thêm</button>
                  </div>
                  <?php } ?>

                </div>
              </div>
              <div class="artist-right">
                <?php
                $artist_id = get_the_ID(); 

                // Truy vấn các tác phẩm liên kết với nghệ sĩ này
                $args = [
                    'post_type' => 'painting',          // Post type của tác phẩm
                    'posts_per_page' => -1,             // Lấy tất cả bài viết
                    'meta_query' => [
                        [
                            'key' => 'artist',           // Trường meta lưu ID nghệ sĩ trong tác phẩm
                            'value' => $artist_id,       // Lấy ID của nghệ sĩ hiện tại
                            'compare' => '=',
                        ],
                    ],
                ];
                
                $paintings = new WP_Query($args);
                ?>
                <h2 class="title-product">
                  Tác phẩm <span class="count-painting"></span>
                </h2>
                <?php
                if ($paintings->have_posts()) {
                    echo '<ul class="list-product">';
                    while ($paintings->have_posts()) {
                        $paintings->the_post();
                        
                        // Lấy URL bài viết (tác phẩm)
                        $link = get_permalink();
                        
                        // Lấy ảnh đại diện của bài viết
                        $thumbnail = get_the_post_thumbnail(null, 'thumbnail', ['alt' => get_the_title()]);
                        
                        // Kiểm tra xem bài viết có ảnh đại diện không
                        if ($thumbnail) {
                            echo '<li class="item-product">';
                            echo '<a href="' . esc_url($link) . '">'; 
                            echo '<figure class="image-product object-fit">';
                            echo '<img src="' . esc_url(get_the_post_thumbnail_url(null, null)) . '" alt="' . esc_attr(get_the_title()) . '" />';
                            echo '</figure>';
                            echo '</a>';
                            echo '</li>';
                            
                        } else {
                            echo '<li>Không có ảnh đại diện.</li>';
                        }
                    }
                    echo '</ul>';
                } else {
                    echo 'Không có tác phẩm nào liên kết với nghệ sĩ này.';
                }
                ?>
              </div>
            </div>
          </div>
        </section>
      </main>
<?php get_footer() ?>