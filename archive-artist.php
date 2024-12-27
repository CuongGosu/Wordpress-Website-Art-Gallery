<?php get_header() ?>
<main>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">
    <div class="wrapper">
    <h1 class="heading-territory">Danh sách nghệ sĩ</h1>
    </div>
</section>
<section class="section-top-artist">
  <div class="wrapper">
    <div class="info-primary">
      <h2 class="heading-secondary">
        <span class="line line-left"></span>
        <span class="heading-text"> Nghệ sĩ nổi bật </span>
        <span class="line lline-right"></span>
      </h2>
    </div>
    <div class="artist-swiper">
      <ul class="swiper-wrapper list-artist">
        <?php
        // Truy vấn nghệ sĩ nổi bật (slug: nghe-si-noi-bat)
        $args_noibat = array(
          'post_type' => 'artist',
          'tax_query' => array(
            array(
              'taxonomy' => 'artist_cat',
              'field'    => 'slug',
              'terms'    => 'nghe-si-noi-bat', // Slug cho nghệ sĩ nổi bật
            ),
          ),
        );

        $query_noibat = new WP_Query($args_noibat);

        if ($query_noibat->have_posts()) {
          while ($query_noibat->have_posts()): $query_noibat->the_post();
        ?>
          <li class="item-artist swiper-slide">
            <a href="<?php the_permalink(); ?>">
              <div class="artist-avatar object-fit">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
              </div>
              <div class="artist-info">
                <p class="info-birth"><?php echo get_post_meta(get_the_ID(), 'birth', true); ?></p>
                <p class="info-name"><?php the_title(); ?></p>
              </div>
            </a>
          </li>
        <?php
          endwhile;
          wp_reset_postdata();
        } else {
          echo '<p>Không có nghệ sĩ nổi bật nào.</p>';
        }
        ?>
      </ul>
      <div class="artist-control swiper-button-next"></div>
      <div class="artist-control swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

<section class="section-top-artist">
  <div class="wrapper">
    <div class="info-primary">
      <h2 class="heading-secondary">
        <span class="line line-left"></span>
        <span class="heading-text"> Nghệ sĩ mới </span>
        <span class="line lline-right"></span>
      </h2>
    </div>
    <div class="artist-swiper">
      <ul class="swiper-wrapper list-artist">
        <?php
        // Truy vấn nghệ sĩ mới (slug: nghe-si-moi)
        $args_moi = array(
          'post_type' => 'artist',
          'tax_query' => array(
            array(
              'taxonomy' => 'artist_cat',
              'field'    => 'slug',
              'terms'    => 'nghe-si-moi', // Slug cho nghệ sĩ mới
            ),
          ),
        );

        $query_moi = new WP_Query($args_moi);

        if ($query_moi->have_posts()) {
          while ($query_moi->have_posts()): $query_moi->the_post();
        ?>
          <li class="item-artist swiper-slide">
            <a href="<?php the_permalink(); ?>">
              <div class="artist-avatar object-fit">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
              </div>
              <div class="artist-info">
                <p class="info-birth"><?php echo get_post_meta(get_the_ID(), 'birth', true); ?></p>
                <p class="info-name"><?php the_title(); ?></p>
              </div>
            </a>
          </li>
        <?php
          endwhile;
          wp_reset_postdata();
        } else {
          echo '<p>Không có nghệ sĩ mới nào.</p>';
        }
        ?>
      </ul>
      <div class="artist-control swiper-button-next"></div>
      <div class="artist-control swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

</main>
<?php get_footer() ?>