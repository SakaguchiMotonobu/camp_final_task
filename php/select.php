<?php
//1.  DB接続します xxxにDB名を入れます
try {
$pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM temperature_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる $resultの中に「カラム名」が入ってくるのでそれを表示させる例
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $chart_date[] = $result["date"];
      $chart_temperature[] = $result["temperature"];
  }
    print_r($chart_date);
    print_r($chart_temperature);
  $chart_date_json = json_encode($chart_date);
  $chart_temperature_json = json_encode($chart_temperature);
}
?>

<!-- 画面表示部分 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- API読み込み -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <title>体温の推移</title>
  </head>
  <body>
    <!-- php配列の受取り -->
    <script>
        let chart_date = <?php echo $chart_date_json; ?>;
        let chart_temperature = <?php echo $chart_temperature_json; ?>;
        console.log(chart_date);
        console.log(chart_temperature);
        
        for (let i=0; i<chart_date.length;i++){
        console.log(chart_date[i]);
        }
    </script>
    <!-- php配列の受取り -->

    <!-- 折れ線グラフの描画 -->
    <script type="text/javascript">
      google.load("visualization", "1", { packages: ["corechart"] });
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          //グラフデータの指定
          ["月日", "℃"],
          ["5/1", 36.2],
          ["5/2", 36.1],
          ["5/3", 35.8],
          ["5/4", 36.4],
          ["5/5", 36.2],
          ["5/6", 36.2],
          ["5/7", 36.1],
          ["5/8", 35.8],
          ["5/9", 36.4],
          ["5/10", 36.2],
          ["5/11", 36.2],
          ["5/12", 36.1],
          ["5/13", 35.8],
          ["5/14", 36.4],
          ["5/15", 36.2],
          ["5/16", 36.2],
          ["5/17", 36.1],
          ["5/18", 35.8],
          ["5/19", 36.4],
          ["5/20", 36.2],
          ["5/21", 36.2],
          ["5/22", 36.1],
          ["5/23", 35.8],
          ["5/24", 36.4],
          ["5/25", 36.2],
          ["5/26", 36.2],
          ["5/27", 36.1],
          ["5/28", 35.8],
          ["5/29", 36.4],
          ["5/30", 36.2],
          ["5/31", 36.2],
        ]);

        var options = {
          //オプションの指定
          title: "体温の推移",
          colors: ["#ff6600"],
          //   vAxis: { minValue: 35.1, maxValue: 39.9, gridlined: { count: 0.11 } },
        };

        var chart = new google.visualization.LineChart(
          document.getElementById("chart_div")
        ); //グラフを表示させる要素の指定
        chart.draw(data, options);
      }
    </script>
    <!-- 折れ線グラフの描画 -->
    <!-- グラフの表示箇所 -->
    <div id="chart_div"></div>
    <!-- グラフの表示箇所 -->
  </body>
</html>
<!-- 画面表示部分 -->



<!-- <!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマークリスト</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<!-- <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録画面へ</a>
      </div>
    </div>
  </nav>
</header> -->
<!-- Head[End] -->

<!-- Main[Start] $view-->
<!-- <div>

    <div class="container jumbotron">
    <table border="1" width="500" cellspacing="0" cellpadding="5" bordercolor="#333333" class="book_table">
    <tr>
    <th width="35px">No.</th>
    <th width="150px">書籍名</th>
    <th width="150px">ＵＲＬ</th>
    <th width="200px">書評</th>
    <th width="120px">登録日時</th>
    </tr>
    <!-- <?=$view?> -->
    </table>
    </div>

<!-- </div> -->
<!-- Main[End] -->

<!-- </body>
</html> -->
