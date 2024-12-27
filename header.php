<!doctype html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head() ?>
</head>
<body>
<div class="container">
      <header class="header-primary">
        <div class="wrapper">
          <div class="header-inner flex align-center">
            <div class="header-top flex align-center">
              <div class="header-top-left flex align-center">
                <div class="header-time">
                  <span class="header-icon">
                    <ion-icon name="time-outline"></ion-icon>
                  </span>
                  <?php theOption('daily_time') ?>
                </div>
                <div class="header-location">
                  <span class="header-icon">
                    <ion-icon name="location-outline"></ion-icon>
                  </span>
                  <?php theOption('dia_chi')  ?>
                </div>
                <div class="header-phone">
                  <span class="header-icon">
                    <ion-icon name="phone-portrait-outline"></ion-icon>
                  </span>
               <?php theOption('dien_thoai') ?>
                </div>
              </div>
              <div class="header-top-right flex">
                <ul class="list-header-social flex align-center">
                  <li class="item-header-social">
                    <a href="<?php theOption('fan_page') ?>" target="_blank"> Facebook </a>
                  </li>
                  <li class="item-header-social">
                    <a href="<?php theOption('instagram') ?>" target="_blank"> Instagram </a>
                  </li>
                  <li class="item-header-social">
                    <a href="<?php theOption('youtube') ?>" target="_blank"> Youtube </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="header-bottom flex align-center">
              <a href="/" class="header-logo-primary object-fit">
								<img src="<?php theOptionImage('header_logo') ?>" alt="<?php theOption('ten_cong_ty') ?>">
              </a>
              <div class="header-navigation">
                <?php wp_nav_menu([
                  'menu' => 'gm-primary',
                  'theme-location' => 'gm-primary',
                  'container' =>false,
                  'menu_class' => 'list-navigation pc-menu',
                  'walker' => new \Gaumap\Walkers\CustomMenuWalker('pc')
                ])
                   ?>
              </div>
              <div class="header-right">
                <div class="header-list-icon flex">

                  <form class="header-item-icon" method="get">
                  <!-- <input type="hidden" name="post_type" value="product"> -->
                  <!-- <input type="hidden" name="post_type[]" value="product"> -->
              <!-- <input type="hidden" name="post_type[]" value="artist"> -->
              <input type="hidden" name="post_type" value="painting">
                    <input type="text" name="s" class="form-control" placeholder="Tìm kiếm"/>
                    <button type="submit">
                        <ion-icon name="search"></ion-icon>
                      </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <header class="header-primary-mobile">
        <div class="wrapper">
          <div class="header-inner flex align-center">
            <a href="/" class="mobile-logo-primary object-fit">
										<img src="<?php theOptionImage('mobile_logo') ?>" alt="<?php theOption('ten_cong_ty') ?>">

            </a>
            <div class="header-navigation-mobile">
              <?php wp_nav_menu([
                  'menu' => 'gm-primary',
                  'theme-location' => 'gm-primary',
                  'container' =>false,
                  'menu_class' => 'list-navigation mobile-menu',
                  'walker' => new \Gaumap\Walkers\CustomMenuWalker('mobile')
                ])
                   ?>
            </div>
            <div class="header-right">
              <div class="header-list-icon flex">
              <form class="header-item-icon" method="get">
                  <input type="hidden" name="post_type" value="product">
                    <input type="text" name="s" class="form-control" placeholder="Tìm kiếm"/>
                    <button type="submit">
                        <ion-icon name="search"></ion-icon>
                      </button>
                  </form>
              </div>
            </div>
            <div class="button-header-burger">
              <div class="button-wrapper">
                <span></span><span></span><span></span>
              </div>
            </div>
          </div>
        </div>
      </header>