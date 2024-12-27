document.addEventListener('DOMContentLoaded', function () {
  const artistSelect = document.getElementById('artist-select');
  const thumbnailContainer = document.getElementById('artist-thumbnail');

  // Lắng nghe sự kiện thay đổi của dropdown
  artistSelect.addEventListener('change', function () {
    console.log('thumbnailUrl');
    const selectedOption = artistSelect.options[artistSelect.selectedIndex];
    const thumbnailUrl = selectedOption.getAttribute('data-thumbnail');
    // Nếu có URL ảnh thumbnail, hiển thị ảnh đó
    if (thumbnailUrl) {
      thumbnailContainer.innerHTML =
        '<img src="' +
        thumbnailUrl +
        '" alt="' +
        selectedOption.text +
        '" style="width: 100px; height: auto;">';
    } else {
      // Nếu không có ảnh, xóa nội dung của container
      thumbnailContainer.innerHTML = '';
    }
  });

  // Kích hoạt sự kiện change khi trang được tải để hiển thị ảnh của nghệ sĩ đã được chọn trước đó
  artistSelect.dispatchEvent(new Event('change'));
});
