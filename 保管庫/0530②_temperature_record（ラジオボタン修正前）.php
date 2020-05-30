<!-- php（DBと連携） -->
<?php
//1.  DB接続します xxxにDB名を入れます
try {
$pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("select * from (select * from temperature_table order by date desc limit 30) as A order by id"); //最新30件を日付の昇順で取得
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループ $resultの中に「カラム名」が入ってくるのでそれを表示
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $chart_date[] = $result["date"];
      $chart_temperature[] = $result["temperature"];
      // 表の要素
      $view .= "<tr>";
      $view .= "<td><input type='radio' name='id' value='".$result["id"]."'></td><td>".$result["date"]."</td><td>".$result["temperature"]."</td>";
      $view .= "</tr>";

  }
    // print_r($chart_date);　配列の確認
    // print_r($chart_temperature);　配列の確認
  $chart_date_json = json_encode($chart_date);
  $chart_temperature_json = json_encode($chart_temperature);
}
?>
<!-- php（DBと連携） -->

<!-- html, js -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css" />
　<title>基礎体温の推移</title>
</head>
<body>
    <div class="wrap">
        <!-- ヘッダー -->
        <header>
            <div class="header">
            <a href="index.html" class="main_icon"
            ><img src="../img/stork.png" alt="コウノトリ"
            /></a>
            <a href="index.html" class="main_title">
            <p class="title">S-tallk ～これからの話について～</p>
            </a>
            <div class="menu-btn">
            <img src="../img/hamburger.png" alt="ハンバーガーメニュー" />
            <div class="menu">
            <div class="menu__item">TOP</div>
            <div class="menu__item">ABOUT</div>
            <div class="menu__item">BLOG</div>
            <div class="menu__item">CONTACT</div>
            </div>
            </div>
            </div>
        </header>
        <!-- ヘッダー -->

        <!-- グラフ -->
        <div class="chart">
        <!-- 折れ線グラフ -->
            <div class="line_chart">
                <canvas id="line_chart"></canvas>
            </div>
        <!-- 折れ線グラフ -->

        <!-- 一覧表 -->
        <div class="outer_chart">
            <div class="chart_temperature">
                <form method="post" action="#">
                    <table id="output_temperature">
                        <tr>
                        <th>修正／削除</th>
                        <th>日付</th>
                        <th>体温（℃）</th>
                        </tr>
                        <!-- ＤＢからのデータを表示 -->
                        <?=$view?>
                    </table>
                </form>
            </div>
        </div>
        <!-- 一覧表 -->
        </div>
        <!-- グラフ -->

        <!-- フッター -->
        <footer class="footer text-center">
            <div class="wrapper">
            <small class="copyrights"
            >&copy;Copyright 2020 MOTONOBU SAKAGUCHI All rIghts reserved.
            </small>
            </div>
        </footer>
        <!-- フッター -->
    </div>


        <!-- Chart.jsの読込み -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
        <!-- Chart.jsの読込み -->

        <!-- Chart.jsの設定 -->
        <script>
            let chart_date = <?php echo $chart_date_json; ?>;
            let chart_temperature = <?php echo $chart_temperature_json; ?>;

            // console.log(chart_date);
            // console.log(chart_temperature);

            // グラフに表示する数を15件に限定
            while (chart_date.length>15) {
                chart_date.shift();
            }
            while (chart_temperature.length>15) {
                chart_temperature.shift();
            }

            // 日付の標記の整形
            let chart_date_shap = chart_date.map(item => item.slice(5).replace( '-', '月' )+"日")

        var ctx = document.getElementById("line_chart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: chart_date_shap,
            datasets: [
                {
                label: '体温（℃）',
                data: chart_temperature,
                borderColor: "#ff9933",
                backgroundColor: "rgba(0,0,0,0)",
                pointBackgroundColor: "#ff9933",
                lineTension: 0, //各点を直線で結ぶ
                }
            ],
            },
            options: {
            title: {
                display: true,
                text: '基礎体温の推移'
            },
            scales: {
                yAxes: [{
                ticks: {        // 目盛り
                    suggestedMax: 38.0,
                    suggestedMin: 35.0,
                    stepSize: 1.0,
                    callback: function(value, index, values){
                    return  value +  '℃'
                    }
                }
                }]
            },
            }
        });
        </script>
        <!-- Chart.jsの設定 -->

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- jsファイル読込み -->
    <script src="../js/stork.js"></script>

</body>
</html>
<!-- html, js -->