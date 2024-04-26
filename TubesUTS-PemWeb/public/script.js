function menu_handler() {
  var status = $("#container-menu").hasClass("hidden");
  if (status) {
    // jika tersembunyi
    $("#container-menu").removeClass("hidden");
  } else {
    $("#container-menu").addClass("hidden");
  }
}

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth", // Smooth scrolling animasi
  });
}
