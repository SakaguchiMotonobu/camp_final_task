<?php
//1.  DB接続します xxxにDB名を入れます
try {
// mampの場合は注意です！違います！別途後ほど確認します！
$pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
//作ったテーブル名を書く場所  xxxにテーブル名を入れます
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
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録画面へ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] $view-->
<div>

    <div class="container jumbotron">
    <table border="1" width="500" cellspacing="0" cellpadding="5" bordercolor="#333333" class="book_table">
    <tr>
    <th width="35px">No.</th>
    <th width="150px">書籍名</th>
    <th width="150px">ＵＲＬ</th>
    <th width="200px">書評</th>
    <th width="120px">登録日時</th>
    </tr>
    <?=$view?>
    </table>
    </div>

</div>
<!-- Main[End] -->

</body>
</html>
