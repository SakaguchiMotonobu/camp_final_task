<!-- php（DBと連携） -->
<?php
//1.  DBに接続
try {

$edit_id = $_GET["id"];

$pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM temperature_table WHERE id=$edit_id"); 
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
      $edit_date = $result["date"];
      $edit_temperature = $result["temperature"];
  }

}
?>

<!-- html -->
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
                <a href="../index.html" class="main_icon"
                ><img src="../img/stork.png" alt="コウノトリ"
                /></a>
                <a href="../index.html" class="main_title">
                <p class="title">S-tallk ～これからの話について～</p>
                </a>
                <div class="menu-btn">
                    <img src="../img/hamburger.png" alt="ハンバーガーメニュー" />
                    <div class="menu">
                       <a href="../index.html" class="dec"><div class="menu__item">トップページ</div></a>
                       <a href="../input.html" class="dec"><div class="menu__item">検温結果の記録</div></a>
                       <a href="temperature_record.php" class="dec"><div class="menu__item">基礎体温の推移</div></a>
                       <a href="#" class="dec"><div class="menu__item">出産日予測</div></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- ヘッダー -->

      <!-- 機能部分 -->
      <div class="function_field">
        <div class="main_field">
          <div class="input_field">
            <div class="input_inner_field">
              <!-- タイトル -->
              <div class="input_title_edit">
                <img src="../img/edit.png" alt="体温計" />
                <p class="input_text_title">検温記録の修正</p>
              </div>
              <div class="attention">
                <p>※正しい日付、体温を入力し「確定」を押してください。</p>
              </div>
              <!-- タイトル -->

                <form method="post" action="temperature_record_edit_done.php" class="daily_record">

                    <!-- idをhiddenで次の画面へパス -->
                    <input type="hidden" name="id" value="<?php echo $edit_id;?>">
                    <!-- idをhiddenで次の画面へパス -->

                    <!-- 日付の入力 -->
                    <p class="small_title"><span class="emphasis">●日付</span></p>
                    <div class="small_input">
                        <input
                        type="date"
                        id="date_input"
                        class="date_input"
                        name="date"
                        placeholder="Date"
                        value="<?php echo $edit_date;?>"
                        required
                        />
                    </div>
                    <!-- 日付の入力 -->

                    <!-- 体温の入力 -->
                    <p class="small_title">
                        <span class="emphasis">●体温</span
                        >（※半角数字で小数点第一位まで入力）
                    </p>
                    <div class="small_input">
                        <input
                        type="temperature"
                        id="temperature_input"
                        class="temperature_input"
                        name="temperature"
                        value="<?php echo $edit_temperature;?>"
                        required
                        />
                        <div>℃</div>
                    </div>
                    <!-- 体温の入力 -->

                    <!-- 記録ボタン -->
                    <div class="submit_container">
                        <input type="submit" class="button" value="確定" />
                    </div>
                    <!-- 記録ボタン -->
                </form>
            </div>
          </div>
        </div>
      </div>
      <!-- 機能部分 -->


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

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- jsファイル読込み -->
    <script src="../js/stork.js"></script>

</body>
</html>
<!-- html -->