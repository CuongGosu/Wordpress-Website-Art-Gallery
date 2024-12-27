<?php
//Template name: GIới thiệu công ty
get_header() ;

?>
 <main>
        <section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">
          <div class="wrapper">
          <h1 class="heading-territory">Giới thiệu</h1>
          </div>
        </section>
        <section class="section-top-intro">
          <div class="wrapper">
            <div class="intro-inner">
              <div class="info-primary">
                <span class="title-primary">History of art department</span>
                <h2 class="heading-secondary">
                  <span class="line line-left"></span>
                  <span class="heading-text"> Giới thiệu Flamboyant </span>
                  <span class="line lline-right"></span>
                </h2>
              </div>
              <div class="intro-content">
                <div class="intro-information flex-col">
                  <h3 class="intro-title">
                   <?php theOption('ten_cong_ty') ?>
                  </h3>
                  <p class="intro-description">
                    <?php theOption('short_intro') ?>
                  </p>
                </div>
                <div class="intro-thumbnail">
                  <img src="<?php theOptionImage('image_intro') ?>" alt="<?php theOption('ten_cong_ty') ?>"/>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
<?php get_footer() ?>