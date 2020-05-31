<!-- php（DBと連携） -->
<?php
//1.  DBに接続
try {

$done_id = $_POST["id"];

$pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ削除SQL作成
$stmt = $pdo->prepare("DELETE FROM temperature_table WHERE id=$done_id"); 
$status = $stmt->execute();

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

        <p>削除しました。</p>
        <?php echo $done_id ?>

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