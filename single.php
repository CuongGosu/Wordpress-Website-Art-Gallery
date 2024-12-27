<?php get_header() ?>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">

          <div class="wrapper">
            <h2 class="heading-territory">Tin tức</h2>
          </div>
</section>
<main>
  <section class="section-detail-blog">
    <div class="wrapper">
      <h2 class="title-blog"><?php thePageTitle() ?></h2>
      <?php the_content() ?>
    </div>
  </section>
</main>
<?php get_footer() ?>
