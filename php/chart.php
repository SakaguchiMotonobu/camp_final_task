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
    $view .= "<tr>";
    $view .= "<td width='35px'>".$result["id"]."</td><td width='150px'>".$result["date"]."</td><td width='150px'>".$result["temperature"]."</td>";//←ここにカラム名を追加していく
    $view .= "</tr>";
  }

}
?>

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
    <!-- 折れ線グラフの描画 -->
    <script type="text/javascript">
      google.load("visualization", "1", { packages: ["corechart"] });
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          //グラフデータの指定
          ["月日", "℃"],
          ["5月27日", 36.2],
          ["5月28日", 36.1],
          ["5月29日", 35.8],
          ["5月30日", 36.4],
          ["5月31日", 36.2],
          ["5月27日", 36.2],
          ["5月28日", 36.1],
          ["5月29日", 35.8],
          ["5月30日", 36.4],
          ["5月31日", 36.2],
          ["5月27日", 36.2],
          ["5月28日", 36.1],
          ["5月29日", 35.8],
          ["5月30日", 36.4],
          ["5月31日", 36.2],
          ["5月27日", 36.2],
          ["5月28日", 36.1],
          ["5月29日", 35.8],
          ["5月30日", 36.4],
          ["5月31日", 36.2],
          ["5月27日", 36.2],
          ["5月28日", 36.1],
          ["5月29日", 35.8],
          ["5月30日", 36.4],
          ["5月31日", 36.2],
          ["5月27日", 36.2],
          ["5月28日", 36.1],
          ["5月28日", 36.1],
        ]);

        var options = {
          //オプションの指定
          title: "体温の推移",
          colors: ["#ff0000"],
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
