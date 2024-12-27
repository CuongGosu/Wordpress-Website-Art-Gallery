<section class="section-banner">
          <div class="swiper banner-swiper">
            <div class="banner-wrapper swiper-wrapper">
              <?php 
              $sliders = getOption('main_slider') ;
                if(!empty($sliders)) {
                  foreach($sliders as $slider) {
                    ($slider['link'] != '') ? $link_slider = $slider['link'] : $link_slider = "#";
              ?>
              <div class="banner-slide swiper-slide">
                <div class="banner-info">
                  <span class="title-primary"><?php echo $slider['name_artist']?></span>
                  <h1 class="heading-primary"><?php echo $slider['name_product']?></h1>
                  <a class="button-primary" href=<?php echo $link_slider ?>>Xem thêm</a>
                </div>
                <img src="<?php echo getImageUrlById($slider['image']) ?>" alt="<?php echo $slider['name_product'] ?>"/>
              </div>
              <?php
                    }
              } ?>
            </div>
          </div>
          <div class="banner-pagination swiper-pagination"></div>
</section>