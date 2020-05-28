<!-- php（DBと連携） -->
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
　<title>基礎体温の推移</title> 
</head>
<body>
  <h1>●基礎体温の推移</h1>
  <canvas id="line_chart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

  <script>
    let chart_date = <?php echo $chart_date_json; ?>;
    let chart_temperature = <?php echo $chart_temperature_json; ?>;

    console.log(chart_date);
    console.log(chart_temperature);

    // グラフに表示する数を限定
    while (chart_date.length>28) {
        chart_date.shift();
    }
    while (chart_temperature.length>28) {
        chart_temperature.shift();
    }


  var ctx = document.getElementById("line_chart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: chart_date,
      datasets: [
        {
          label: '基礎体温（℃）',
          data: chart_temperature,
          borderColor: "rgba(253,126,0,1)",
          backgroundColor: "rgba(0,0,0,0)",
          pointBackgroundColor: "rgba(253,126,0,1)",
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
          ticks: {
            suggestedMax: 38,
            suggestedMin: 35,
            stepSize: 0.5,
            callback: function(value, index, values){
              return  value +  '℃'
            }
          }
        }]
      },
    }
  });
  </script>
</body>
</html>
<!-- html, js -->