<?php get_header() ?>
<main>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">

          <div class="wrapper">
            <h2 class="heading-territory"><?php thePageTitle() ?></h2>
          </div>
</section>
<section class="section-detail-post">
          <div class="wrapper">
            <ul class="list-post">
            <?php

                  if(have_posts()){

                      while(have_posts()): the_post();

                          template('loop/content-post');

                      endwhile;

                      wp_reset_postdata();

                      wp_reset_query();
                  }
                  ?>
            </ul>
          </div>
        </section>
      </main>
<?php get_footer() ?>