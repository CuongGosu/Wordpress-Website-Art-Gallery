<?php
//Template name: Contact us
get_header(); ?>

<main>
<section class="banner-common" style="--url-backgroundBanner:url(<?php theOptionImage('breadcrumb') ?>);">
          <div class="wrapper">
            <h1 class="heading-territory">Liên hệ</h1>
          </div>
        </section>
        <section class="section-contact">
          <div class="wrapper">
            <div class="contact-inner">
              <div class="contact-left">
                <h3 class="heading-title">Form liên hệ</h3>
                <form action="/wp-admin/admin-ajax.php" class="contact-form" id="contact-form">
                  <div class="form-col">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="gm-input--name"
                        placeholder="<?php echo __('Họ và tên', 'gaumap') ?>" 
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control"
                        name="phone_number"
                        id="gm-input--phone"
                        placeholder="<?php echo __('Số điện thoại', 'gaumap') ?>" 

                        required
                      />
                    </div>
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      name="email"
                      id="gm-input--email"
                      placeholder="<?php echo __('Email', 'gaumap') ?>" 
                      required
                    />
                  </div>
                  <div class="form-group">
                    <textarea
                      type="text"
                      class="form-control"
                      name="message"
                      id="gm-input--message"
                      rows="5"
                      style="resize: none"
                      required
                    ></textarea>
                  </div>
                  <input type="hidden" name="action" value="send_contact_form">
						        <?php wp_nonce_field('send_contact_form', '_token') ?> 
                  <button type="submit" class="button-contact">
                    Gửi liên hệ
                  </button>
                </form>
              </div>
              <div class="contact-right">
                <h3 class="heading-title">Google map</h3>
                <div class="contact-google-map">
                 <?php theOption('ban_do_cong_ty') ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>

<?php get_footer() ?>