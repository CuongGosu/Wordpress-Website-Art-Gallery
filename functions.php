<?php

require_once 'vendor/autoload.php';

register_nav_menu('gm-primary', __('Menu chính', 'gaumap'));
register_nav_menu('gm-sidebar', __('Menu sidebar', 'gaumap'));
register_nav_menu('gm-footer', __('Menu footer', 'gaumap'));
register_nav_menu('gm-footer-02', __('Menu footer 02', 'gaumap'));

new \Theme\PostTypes\Post();
new \Theme\PostTypes\Product();
new \Theme\PostTypes\Artist();
new \Theme\PostTypes\Painting();
new \Theme\Taxonomies\Category();
new \Theme\Taxonomies\ArtistCat();
new \Theme\Taxonomies\ProductCat();
new \Theme\Taxonomies\PaintingCat();
new \Theme\Taxonomies\PaintingTopic();
new \Theme\Taxonomies\PaintingMaterial();
new \Theme\Taxonomies\PaintingStyle();


loadStyles([
  "https://fonts.googleapis.com" ,
  "https://fonts.gstatic.com"  ,
  "https://fonts.googleapis.com" ,
  "https://fonts.gstatic.com"  ,
  "https://fonts.googleapis.com" ,
  "https://fonts.gstatic.com"  ,
    "https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap",
  "https://fonts.googleapis.com" ,
  "https://fonts.gstatic.com"  ,
  "https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap",   
  "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" ,
  asset("css/general.css") ,
   asset("css/index.css"),
   asset("css/header.css" ),
   asset("css/footer.css" ),
   asset("css/archive_product.css" ),
   asset("css/archive_painting.css" ),
   asset("css/single_artist.css" ),
   asset("css/single_painting.css" ),
   asset("css/single_product.css" ),
   asset("css/archive_post.css" ),
   asset("css/single_post.css" ),
   asset("css/contact-us.css" ),
   "https://unpkg.com/aos@2.3.1/dist/aos.css",
]);

loadScripts([
  "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js",
  "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js",
  "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js",
 "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",
 asset("js/main.js"),
 asset("js/theme.js"),
 "https://unpkg.com/aos@2.3.1/dist/aos.js",
]);

add_action('widgets_init', function () {
  register_sidebar([
      'name'          => __('Trang chủ - Nội dung trang chủ', 'nrglobal'),
      'id'            => 'home',
      'description'   => __('Khu vực hiển thị nội dung trang chủ', 'nrglobal'),
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<h2 class="home">',
      'after_title'   => '</h2>',
  ]);

  register_widget(\Gaumap\Widgets\IntroBlock::class); 
  register_widget(\Gaumap\Widgets\PaintingBlock::class); 
  register_widget(\Gaumap\Widgets\ProductBlock::class); 
  register_widget(\Gaumap\Widgets\ArtistBlock::class); 
  register_widget(\Gaumap\Widgets\BlogBlock::class); 

});

function enqueue_admin_custom_scripts() {
  wp_enqueue_script('custom-theme.js', get_template_directory_uri() . '/resources/js/custom-theme.js', ['jquery'], null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_admin_custom_scripts');
add_action('wp_ajax_get_artist_info', 'get_artist_info');
add_action('wp_ajax_nopriv_get_artist_info', 'get_artist_info');

function get_artist_info() {
    if (!isset($_POST['artist_id'])) {
        wp_send_json_error();
    }

    $artist_id = intval($_POST['artist_id']);
    $thumbnail_url = get_the_post_thumbnail_url($artist_id, 'thumbnail');
    $post_type = get_post_type($artist_id);

    // Trả về dữ liệu JSON chứa thumbnail và post type
    wp_send_json_success([
        'thumbnail' => $thumbnail_url,
        'post_type' => $post_type,
    ]);
}
function add_artist_meta_box() {
  add_meta_box(
      'artist_meta_box',      // ID của meta box
      'Nghệ sĩ',              // Tiêu đề của meta box
      'render_artist_meta_box', // Hàm hiển thị meta box
      'painting',             // Post type mà meta box sẽ hiển thị (ở đây là 'painting')
      'side',                 // Vị trí của meta box (side)
      'default'               // Mức độ ưu tiên
  );
}
add_action('add_meta_boxes', 'add_artist_meta_box');

function render_artist_meta_box($post) {
  // Lấy giá trị hiện tại của custom field 'artist'
  $artist_id = get_post_meta($post->ID, 'artist', true);

  // Lấy danh sách tất cả các post type 'artist'
  $artists = get_posts([
      'post_type' => 'artist',
      'posts_per_page' => -1
  ]);

  // Tạo div cho dropdown tùy chỉnh
  echo '<div class="custom-dropdown">';
  echo '<select id="artist-select" name="artist">';
  echo '<option value="">Chọn Nghệ sĩ</option>';

  // Biến lưu thumbnail của nghệ sĩ đã chọn trước đó (nếu có)
  $current_thumbnail = '';

  foreach ($artists as $artist) {
      // Lấy thumbnail của nghệ sĩ
      $thumbnail = get_the_post_thumbnail_url($artist->ID, 'thumbnail');

      // Nếu ID nghệ sĩ được chọn trùng với ID hiện tại, lưu thumbnail cho hiển thị ban đầu
      if ($artist_id == $artist->ID) {
          $current_thumbnail = $thumbnail;
      }

      // Hiển thị tùy chọn với giá trị là ID của nghệ sĩ
      echo '<option value="' . $artist->ID . '"' . selected($artist_id, $artist->ID, false) . ' data-thumbnail="' . esc_url($thumbnail) . '">' . get_the_title($artist->ID) . '</option>';
  }

  echo '</select>';

  // Thêm container để hiển thị ảnh thumbnail đã chọn (nếu có ảnh đã chọn trước đó, hiển thị ngay lập tức)
  if ($current_thumbnail) {
      echo '<div id="artist-thumbnail" style="margin-top: 10px;"><img src="' . esc_url($current_thumbnail) . '" alt="Thumbnail nghệ sĩ" style="width: 100px; height: auto;"></div>';
  } else {
      echo '<div id="artist-thumbnail" style="margin-top: 10px;"></div>';
  }

  echo '</div>';
}


// Lưu meta field 'artist' khi admin lưu post
function save_artist_meta_box($post_id) {
  if (array_key_exists('artist', $_POST)) {
      update_post_meta($post_id, 'artist', $_POST['artist']);
  }
}
add_action('save_post', 'save_artist_meta_box');


// meta field artist cho custom post type product
function add_artist_meta_box_product() {
  add_meta_box(
      'artist_meta_box',      // ID của meta box
      'Nghệ sĩ',              // Tiêu đề của meta box
      'render_artist_meta_box_product', // Hàm hiển thị meta box
      'product',             // Post type mà meta box sẽ hiển thị (ở đây là 'painting')
      'side',                 // Vị trí của meta box (side)
      'default'               // Mức độ ưu tiên
  );
}
add_action('add_meta_boxes', 'add_artist_meta_box_product');

function render_artist_meta_box_product($post) {
  // Lấy giá trị hiện tại của custom field 'artist'
  $artist_id = get_post_meta($post->ID, 'artist', true);

  // Lấy danh sách tất cả các post type 'artist'
  $artists = get_posts([
      'post_type' => 'artist',
      'posts_per_page' => -1
  ]);

  // Tạo div cho dropdown tùy chỉnh
  echo '<div class="custom-dropdown">';
  echo '<select id="artist-select" name="artist">';
  echo '<option value="">Chọn Nghệ sĩ</option>';

  // Biến lưu thumbnail của nghệ sĩ đã chọn trước đó (nếu có)
  $current_thumbnail = '';

  foreach ($artists as $artist) {
      // Lấy thumbnail của nghệ sĩ
      $thumbnail = get_the_post_thumbnail_url($artist->ID, 'thumbnail');

      // Nếu ID nghệ sĩ được chọn trùng với ID hiện tại, lưu thumbnail cho hiển thị ban đầu
      if ($artist_id == $artist->ID) {
          $current_thumbnail = $thumbnail;
      }

      // Hiển thị tùy chọn với giá trị là ID của nghệ sĩ
      echo '<option value="' . $artist->ID . '"' . selected($artist_id, $artist->ID, false) . ' data-thumbnail="' . esc_url($thumbnail) . '">' . get_the_title($artist->ID) . '</option>';
  }

  echo '</select>';

  // Thêm container để hiển thị ảnh thumbnail đã chọn (nếu có ảnh đã chọn trước đó, hiển thị ngay lập tức)
  if ($current_thumbnail) {
      echo '<div id="artist-thumbnail" style="margin-top: 10px;"><img src="' . esc_url($current_thumbnail) . '" alt="Thumbnail nghệ sĩ" style="width: 100px; height: auto;"></div>';
  } else {
      echo '<div id="artist-thumbnail" style="margin-top: 10px;"></div>';
  }

  echo '</div>';
}


// Lưu meta field 'artist' khi admin lưu post
function save_artist_meta_box_product($post_id) {
  if (array_key_exists('artist', $_POST)) {
      update_post_meta($post_id, 'artist', $_POST['artist']);
  }
}
add_action('save_post', 'save_artist_meta_box_product');

