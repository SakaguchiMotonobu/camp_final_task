$(document).ready(function () {
  //   alert("呼び出し成功");

  // ハンバーガーメニュー
  $(
    (function () {
      $(".menu-btn").on("click", function () {
        $(".menu").toggleClass("is-active");
      });
    })()
  );
  // ハンバーガーメニュー

  //   スライドショー
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
  setInterval(slideshow_timer, 3000);
  //   スライドショー

  //   予想日の算出
  $("#calculation_field_button").on("click", function () {
    let input_date = $("#input_date").val();

    let input_year = input_date.slice(0, -6);
    let input_month = input_date.slice(5).slice(0, -3) - 1;
    let input_day = input_date.slice(8);

    let cal_date = new Date(input_year, input_month, input_day);

    let birth_prediction = cal_date.setDate(cal_date.getDate() + 280);

    let birth_prediction_date = new Date(birth_prediction);

    let year = birth_prediction_date.getFullYear();
    let month = birth_prediction_date.getMonth() + 1;
    let date = birth_prediction_date.getDate();

    let output = `出産予定日は、</br><span class ="emphasis2">${year}年${month}月${date}日</span></br>くらいです。`;

    $("#arrow").empty();
    $("#arrow").append("⇒");

    $("#result").empty();
    $("#result").append(output);
  });
  //   予想日の算出
});
