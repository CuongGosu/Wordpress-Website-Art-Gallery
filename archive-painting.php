<?php get_header() ?>
<main>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">

          <div class="wrapper">
            <h1 class="heading-territory">Tác phẩm</h1>
          </div>
</section>
        <section class="wrapper-product-primary" style="--url-backgroundPainting:url(<?php echo get_template_directory_uri() . "/resources/images/bg_intro.png" ?>);">
          <div class="wrapper">
            <ul class="list-product-primary">
            <?php
                query_posts([
                  'post_type' => 'painting',
                  'order'     => 'DESC', // Sắp xếp từ mới đến cũ
                 'orderby'   => 'modified'
              ]);
      
                    if(have_posts()){

                        while(have_posts()): the_post();

                            template('loop/content-painting');

                        endWhile;

                        wp_reset_postdata();
                        wp_reset_query();

                    }

                    ?>
            </ul>
            <div class="wrapper-pagination">
            <?php thePagination() ?>
            </div>
          </div>
        </section>
      </main>
<?php get_footer() ?>