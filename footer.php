<?php wp_footer() ?>
<footer class="footer-primary">
        <div class="wrapper">
          <div class="footer-inner flex">
            <div class="col-footer logo">
              <div class="logo-footer-primary">
							<img src="<?php theOptionImage('footer_logo') ?>" alt="<?php theOption('ten_cong_ty') ?>">

              </div>
              <div class="footer-info">
                Sed quia consequuntur magni dolor qui ratione porro tatem
                sequineque porro.
              </div>
              <ul class="footer-social flex">
                <li>
                  <a href="<?php theOption('fan_page') ?>" target="_blank">
                    <ion-icon name="logo-facebook"></ion-icon>
                  </a>
                </li>
                <li>
                  <a href="<?php theOption('youtube') ?>" target="_blank">
                    <ion-icon name="logo-youtube"></ion-icon>
                  </a>
                </li>
                <li>
                  <a href="<?php theOption('instagram') ?>" target="_blank">
                    <ion-icon name="logo-instagram"></ion-icon>
                  </a>
                </li>
                <li>
                  <a href="#" target="_blank">
                    <ion-icon name="logo-twitter"></ion-icon>
                  </a>
                </li>
              </ul>
              <div class="footer-qr"> 
                <?php
              // Bao gồm thư viện phpqrcode
              require_once get_template_directory() . '/phpqrcode/qrlib.php';
              
              // Đường dẫn URL cần mã hóa
              $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "https" : "http";
              $host = $_SERVER['HTTP_HOST'];

              // Tạo URL đầy đủ
              $url = $protocol . "://" . $host;

              
              // Đường dẫn lưu mã QR và logo
              $qrFilePath = get_template_directory() . '/qrcodes/website_qr.png';
              $favicon_id = carbon_get_theme_option('favicon' . currentLanguage());

              // Kiểm tra và lấy URL từ ID ảnh
              $logoPath = $favicon_id ? wp_get_attachment_url($favicon_id) : '';
              
              if (!$logoPath) {
                  // Nếu không có URL, gán một đường dẫn mặc định
                  $logoPath = get_template_directory() . '/images/default-logo.png'; // Đường dẫn mặc định đến logo
              }
              
              // Tạo thư mục qrcodes nếu chưa tồn tại
              if (!file_exists(get_template_directory() . '/qrcodes')) {
                  mkdir(get_template_directory() . '/qrcodes', 0755, true);
              }
              
              // Tạo mã QR và lưu vào file
              QRcode::png($url, $qrFilePath, QR_ECLEVEL_H, 10);
              
              // Kết hợp mã QR và logo
              $qrImage = imagecreatefrompng($qrFilePath);
              $logoImage = imagecreatefrompng($logoPath);
              
              // Lấy kích thước của QR và logo
              $qrWidth = imagesx($qrImage);
              $qrHeight = imagesy($qrImage);
              $logoWidth = imagesx($logoImage);
              $logoHeight = imagesy($logoImage);
              
              // Tính toán kích thước logo để chèn vào giữa (tùy chỉnh phần trăm nếu muốn logo lớn/nhỏ hơn)
              $logoQRWidth = $qrWidth * 0.2; // Logo chiếm 20% chiều rộng mã QR
              $logoQRHeight = $logoHeight * ($logoQRWidth / $logoWidth); // Tỉ lệ logo
              
              // Tính vị trí để đặt logo vào giữa mã QR
              $logoX = ($qrWidth - $logoQRWidth) / 2;
              $logoY = ($qrHeight - $logoQRHeight) / 2;
              
              // Thêm logo vào giữa mã QR
              imagecopyresampled($qrImage, $logoImage, $logoX, $logoY, 0, 0, $logoQRWidth, $logoQRHeight, $logoWidth, $logoHeight);
              
              // Lưu ảnh mới
              imagepng($qrImage, $qrFilePath);
              
              // Giải phóng bộ nhớ
              imagedestroy($qrImage);
              imagedestroy($logoImage);
              
              // Hiển thị mã QR có logo trên trang
              echo '<img src="' . get_template_directory_uri() . '/qrcodes/website_qr.png" alt="QR Code with Logo" />';
              ?>
              
              </div>
            </div>
            <div class="col-footer">
              <h3 class="footer-title"><?php _e(get_nav_name('gm-footer')) ?></h3>
              <?php
              wp_nav_menu([
                'menu'           => 'gm-footer',
                'theme_location' => 'gm-footer',
                 'container'      => false,
                 'menu_class' => 'list-footer',
                 'depth' => 1,
                      ])
                ?>

            </div>
            <div class="col-footer">
              <h3 class="footer-title"><?php _e(get_nav_name('gm-footer-02')) ?></h3>
              <?php
              wp_nav_menu([
                'menu'           => 'gm-footer-02',
                'theme_location' => 'gm-footer-02',
                 'container'      => false,
                 'menu_class' => 'list-footer',
                 'depth' => 1,
                      ])
                ?>
            </div>
            <div class="col-footer">
              <h3 class="footer-title">Liên hệ</h3>
              <ul class="list-footer-contact">
                <li>
                  <span><ion-icon name="location-outline"></ion-icon></span>
                  <span 
                    ><?php theOption('dia_chi')?></span
                  >
                </li>
                <li>
                  <span
                    ><ion-icon name="phone-portrait-outline"></ion-icon
                  ></span>
                  <span><?php theOption('dien_thoai') ?></span>
                </li>
                <li>
                  <span><ion-icon name="mail-outline"></ion-icon></span>
                  <span><?php theOption('email') ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="copyright-inner">
            <span> Copyright © 2024 Flamboyant Art Gallery . </span>
            <span>
              Thiết kế và vận hành website:

              <a
                href="https://nrglobal.vn"
                target="_blank"
                class="link-copyright"
              >
                NR Global
              </a>
            </span>
          </div>
        </div>
      </footer>
      <script>
          AOS.init();
      </script>
    </body>
    <?php wp_footer() ?>
</html>