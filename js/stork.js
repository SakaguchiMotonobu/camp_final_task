$(document).ready(function () {
  //   alert("呼び出し成功");

  const img_src = ["img/baby01.jpg", "img/baby02.jpg", "img/baby03.jpg"];
  let num = -1;

  function slideshow_timer() {
    if (num === 2) {
      num = 0;
    } else {
      num++;
    }
    document.getElementById("baby_img").src = img_src[num];
  }

  setInterval(slideshow_timer, 4000);

  // 以下実験
  $(
    (function () {
      $(".menu-btn").on("click", function () {
        $(".menu").toggleClass("is-active");
      });
    })()
  );
});
