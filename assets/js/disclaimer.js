document.addEventListener("DOMContentLoaded", function () {
  const styleSelect = document.getElementById("custom_title_highlight_style");
  const disclaimer = document.querySelector(".highlight-style-disclaimer");

  function toggleDisclaimer(event) {
    var value = event ? event.target.value : styleSelect.value;

    if (value === "circle" || value === "square") {
      disclaimer.style.display = "block";
    } else {
      disclaimer.style.display = "none";
    }
  }

  toggleDisclaimer();

  styleSelect.addEventListener("change", toggleDisclaimer);
});
