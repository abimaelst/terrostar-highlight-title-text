document.addEventListener("DOMContentLoaded", function () {
  const colorPicker = document.querySelector(
    'input[name="custom_title_highlight_color"]'
  );
  if (colorPicker) {
    wpColorPickerOptions = {};
    wp.colorPicker.colorPicker(colorPicker, wpColorPickerOptions);
  }
});
