<?php get_header() ;
    $obj = get_queried_object();
    ?>
<main>
        <section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">
          <div class="wrapper">
            <h1 class="heading-territory">Đồ cổ</h1>
          </div>
        </section>
        <section class="wrapper-product-secondary">
          <div class="wrapper">
            <ul class="list-product-secondary">
            <?php
                     query_posts([
                      'post_type' => 'product',
                      'order'     => 'DESC', // Sắp xếp từ mới đến cũ
                     'orderby'   => 'modified'
                  ]);
                if(have_posts()){
                    while(have_posts()): the_post();
                        template('loop/content-product');
                    endWhile;
                    wp_reset_postdata();
                    wp_reset_query();
                }

                ?>
              
            </ul>
          </div>
        </section>
      </main>
<?php get_footer() ?>