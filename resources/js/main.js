// swiper banner
var swiperBanner = new Swiper('.banner-swiper', {
  autoplay: {
    delay: 4000000,
  },
  loop: true,
  spaceBetween: 30,
  effect: 'fade',
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});
//
var swiperProduct = new Swiper('.product-secondary-swiper', {
  paginationClickable: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  effect: 'coverflow',
  loop: true,
  centeredSlides: true,
  slidesPerView: 3,
  coverflowEffect: {
    rotate: 0,
    stretch: 50,
    depth: 150,
    modifier: 1.5,
    slideShadows: true,
  },
  breakpoints: {
    1023: {
      slidesPerView: 3,
    },

    320: {
      slidesPerView: 2,
    },
  },
});
//
var swiperArtist = new Swiper('.artist-swiper', {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 5,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
  },
  speed: 3000,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    1024: {
      slidesPerView: 5,
    },
    767: {
      slidesPerView: 4,
    },
    560: {
      slidesPerView: 3,
    },
    320: {
      slidesPerView: 2,
    },
  },
});
var swiperArtist = new Swiper('.blog-swiper', {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 4,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    1024: {
      slidesPerView: 4,
    },
    767: {
      slidesPerView: 3,
    },
    560: {
      slidesPerView: 2,
    },
    320: {
      slidesPerView: 1,
    },
  },
});
// hambuger
$('.button-wrapper').click(function () {
  var $headerPrimary = $('.header-primary-mobile');
  if ($headerPrimary.hasClass('open')) {
    $headerPrimary.removeClass('open');
    $(this).removeClass('active');
  } else {
    $headerPrimary.addClass('open');
    $(this).addClass('active');
  }
});
// icon
const iconsElement = document.querySelectorAll('.icons-dropdown'); // Chọn tất cả các icon có class .icons-dropdown

iconsElement.forEach((iconWrapper) => {
  const toggleIcon = iconWrapper.querySelector('.icons-toogle-plus'); // Lấy icon con
  const wrapElement = iconWrapper
    .closest('.menu-item-has-children')
    .querySelector('.sub-menu'); // Tìm submenu tương ứng

  iconWrapper.addEventListener('click', (e) => {
    e.preventDefault(); // Ngăn chặn hành vi mặc định (nếu có)

    // Đổi class của icon (toggle dấu + và -)
    toggleIcon.classList.toggle('open');
    // Đổi class của submenu để hiển thị hoặc ẩn
    wrapElement.classList.toggle('open');
  });
});
// intro detail artist
document.addEventListener('DOMContentLoaded', function () {
  // artist-introducation
  const contentIntro = document.querySelector(
    '.artist-introducation .intro-description'
  );
  const toggleBtnIntro = document.querySelector(
    '.artist-introducation .toggle-btn'
  );

  if (contentIntro && toggleBtnIntro) {
    toggleBtnIntro.addEventListener('click', function () {
      contentIntro.classList.toggle('expanded');
      toggleBtnIntro.textContent = contentIntro.classList.contains('expanded')
        ? 'Rút gọn'
        : 'Xem thêm';
    });

    function checkTextHeight() {
      const lineHeight = parseFloat(getComputedStyle(contentIntro).lineHeight);
      const maxLines = 4;
      const maxHeight = lineHeight * maxLines;

      if (contentIntro.scrollHeight > maxHeight) {
        toggleBtnIntro.style.display = 'block';
      } else {
        toggleBtnIntro.style.display = 'none';
      }
    }

    checkTextHeight();
  }

  // section-detail-artist list-learn
  const learnList = document.querySelector(
    '.section-detail-artist .list-learn'
  );
  const toggleBtnLearn = document.querySelector('.artist-learn .toggle-btn');

  if (learnList && toggleBtnLearn) {
    function checkListLearnHeight() {
      const listHeight = learnList.scrollHeight;
      const maxLines = 4.5 * 1;
      const maxHeight =
        parseFloat(getComputedStyle(learnList).lineHeight) * maxLines;

      if (listHeight > maxHeight) {
        toggleBtnLearn.style.display = 'block';
      } else {
        toggleBtnLearn.style.display = 'none';
      }
    }

    toggleBtnLearn.addEventListener('click', function () {
      learnList.classList.toggle('expanded');
      toggleBtnLearn.textContent = learnList.classList.contains('expanded')
        ? 'Rút gọn'
        : 'Xem thêm';
    });

    checkListLearnHeight();
  }

  // section-detail-artist list-exhibition
  const exhibitionList = document.querySelector(
    '.section-detail-artist .list-exhibition'
  );
  const toggleBtnExhibition = document.querySelector(
    '.artist-exhibition .toggle-btn'
  );

  if (exhibitionList && toggleBtnExhibition) {
    function checkListExhibitionHeight() {
      const listHeight = exhibitionList.scrollHeight;
      const maxLines = 4 * 1;
      const maxHeight =
        parseFloat(getComputedStyle(exhibitionList).lineHeight) * maxLines;

      if (listHeight > maxHeight) {
        toggleBtnExhibition.style.display = 'block';
      } else {
        toggleBtnExhibition.style.display = 'none';
      }
    }

    toggleBtnExhibition.addEventListener('click', function () {
      exhibitionList.classList.toggle('expanded');
      toggleBtnExhibition.textContent = exhibitionList.classList.contains(
        'expanded'
      )
        ? 'Rút gọn'
        : 'Xem thêm';
    });

    checkListExhibitionHeight();
  }
});

//
var swiperPaintingSimilar = new Swiper('.similar-box', {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 4,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    1024: {
      slidesPerView: 4,
    },
    767: {
      slidesPerView: 3,
    },
    560: {
      slidesPerView: 2,
    },
    320: {
      slidesPerView: 1,
    },
  },
});
// Kiểm tra trước khi khởi tạo Swiper (2 swiper)
if (
  document.querySelector('.thumbnail-preview') &&
  document.querySelector('.thumbnail-hero')
) {
  var swiperThumbnailPreview = new Swiper('.thumbnail-preview', {
    loop: true,
    slidesPerView: 4,
    direction: 'vertical',
    spaceBetween: 15,
    slidesPerView: 'auto',
    freeMode: true,
    watchSlidesProgress: true,
  });

  var swiperThumbnailHero = new Swiper('.thumbnail-hero', {
    loop: true,
    thumbs: {
      swiper: swiperThumbnailPreview,
    },
  });
}

// Kiểm tra trước khi gán sự kiện chuột
if ($('.preview-item').length > 0) {
  $('.preview-item').on('mouseover', function () {
    if (swiperThumbnailHero) {
      swiperThumbnailHero.slideTo($(this).index());
    }
  });
}
