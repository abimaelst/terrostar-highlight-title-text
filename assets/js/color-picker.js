document.addEventListener("DOMContentLoaded", function () {
  const colorPicker = document.querySelector(
    'input[name="custom_title_highlight_color"]'
  );

  if (colorPicker) {
    wpColorPickerOptions = {};
    wp.colorPicker.colorPicker(colorPicker, wpColorPickerOptions);
  }

  const styleSelect = document.getElementById('custom_title_highlight_style');
    const disclaimer = document.querySelector('.highlight-style-disclaimer');
    
    function toggleDisclaimer() {
      
        if (styleSelect.value === 'circle' || styleSelect.value === 'square') {
            disclaimer.style.display = 'block';
        } else {
            disclaimer.style.display = 'none';
        }
    }
    
    toggleDisclaimer();
    
    styleSelect.addEventListener('change', toggleDisclaimer)
});


