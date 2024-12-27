<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

use function PHPSTORM_META\type;

class IntroBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('intro_block', __('Giới thiệu công ty', 'nrglobal'), __('Hiển thị nội dung giới thiệu', 'nrglobal'), [
          Field::make('text', 'sub_title', __('Tiêu đề phụ', 'nrglobal')),
          Field::make('text', 'main_title', __('Tiêu đề chính', 'nrglobal')),
          Field::make('text', 'heading_title', __('Tiêu đề giới thiệu', 'nrglobal')),
          Field::make('rich_text', 'description', __('Mô tả công ty', 'nrglobal')),
          Field::make('text', 'link', __('Link chuyển hướng', 'nrglobal')),
          Field::make('image', 'thumbnail', __('Ảnh giới thiệu công ty', 'nrglobal')),

        ]);
    }
    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {

        if (is_home()) {
            ?>
          <section class="section-top-intro">
          <div class="wrapper">
            <div class="intro-inner">
              <div class="info-primary" data-aos="zoom-in" data-aos-anchor-placement="center-bottom">
                <span class="title-primary"><?php echo $instance['sub_title'] ?></span>
                <h2 class="heading-secondary">
                  <span class="line line-left"></span>
                  <span class="heading-text"> <?php echo $instance['main_title'] ?> </span>
                  <span class="line line-right"></span>
                </h2>
              </div>
              <div class="intro-content">
                <div class="intro-information flex-col" data-aos="fade-up-right">
                  <h3 class="intro-title">
                    <?php echo $instance['heading_title'] ?>
                  </h3>
                  <p class="intro-description">
                    <?php echo $instance['description'] ?>
                  </p>
                  <a class="button-primary red" href="./gioi-thieu">Xem thêm</a>
                </div>
                <div class="intro-thumbnail" data-aos="fade-up-left">
                  <img src="<?php echo getImageUrlById($instance['thumbnail']) ?>" alt="<?php echo $instance['heading_title'] ?>" />
                </div>
              </div>
            </div>
          </div>
        </section>
            <?php
        }
    }
}
