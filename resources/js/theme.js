var loader = `<div class=\"gm-loader\" style="position:fixed;z-index:99999999;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background-color:rgba(0,0,0,0.51)"><div class=\"windows8\"> <div class=\"wBall\" id=\"wBall_1\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_2\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_3\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_4\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_5\"> <div class=\"wInnerBall\"> </div> </div> </div></div>`;
$('#contact-form').submit(function (e) {
  e.preventDefault();
  let form = $(this);
  // form.validate();
  // if (form.valid()) {
  $('body').append(loader);
  $.post(
    $(this).attr('action'),
    {
      action: 'send_contact_form',
      _token: $(this).find('[name="_token"]').val(),
      name: $(this).find('[name="name"]').val(),
      email: $(this).find('[name="email"]').val(),
      phone_number: $(this).find('[name="phone_number"]').val(),
      // subject: $(this).find('[name="subject"]').val(),
      message: $(this).find('[name="message"]').val(),
    },
    function (response) {
      if (response.success === true) {
        swal(
          'Thành công',
          'Bạn đã gửi liên hệ thành công. Chúng tôi sẽ liên hệ trong thời gian sớm nhất. Xin cám ơn !',
          'success'
        );

        form.trigger('reset');

        $('#modal-booking').modal('hide');
      } else {
        swal(
          'Thất bại',
          'Có lỗi trong quá trình gửi tin nhắn. Vui lòng thử lại !',
          'error'
        );
      }
      $(document).find('.gm-loader').remove();
    }
  );
  // }
});
