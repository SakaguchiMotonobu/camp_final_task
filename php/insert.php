<?php
//1. POSTデータ取得

//index.htmlからデーターの受け取り（その後、bindValueと結びつけ）
$date = $_POST["date"];
$temperature = $_POST["temperature"];

//2. DB（stork_db）に接続
//以下で、作成したDBに接続をしてデータを登録します
try {
  $pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成 //以下にカラム名を入力
$stmt = $pdo->prepare("INSERT INTO temperature_table(id, date, temperature )VALUES(NULL, :date, :temperature )");
$stmt->bindValue(':date', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':temperature', $temperature, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
  header("Location: select.php");
  exit;

}
?>
