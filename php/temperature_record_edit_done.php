<!-- php（DBと連携） -->
<?php
//1.  DBに接続
try {

$done_id = $_POST["id"];
$done_date = $_POST["date"];
$done_temperature = $_POST["temperature"];

$pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ更新SQL作成
$stmt = $pdo->prepare("UPDATE temperature_table SET date='$done_date',temperature='$done_temperature'  WHERE id=$done_id");
$status = $stmt->execute();

?>

<!-- html -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css" />
  <title>データ修正完了</title>
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
                <p class="title">S-talk ～これからの話について～</p>
                </a>
                <div class="menu-btn">
                    <img src="../img/hamburger.png" alt="ハンバーガーメニュー" />
                    <div class="menu">
                       <a href="../index.html" class="dec"><div class="menu__item">トップページ</div></a>
                       <a href="../input.html" class="dec"><div class="menu__item">検温結果の記録</div></a>
                       <a href="temperature_record.php" class="dec"><div class="menu__item">基礎体温の推移</div></a>
                       <a href="../calculation.html" class="dec"><div class="menu__item">出産日予測</div></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- ヘッダー -->

        <!-- 一覧表 -->
        <div class="outer_chart">
            <div class="chart_temperature_edit">
                <form method="post" action="branch.php">
                    <div class="form">
                        <table id="output_temperature">
                            <tr>
                            <th>日付</th>
                            <th>体温（℃）</th>
                            </tr>
                            <tr>
                            <td><?php echo $done_date ?></td>
                            <td><?php echo $done_temperature ?></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <!-- 一覧表 -->
        <div class="info">
        <p>以上のとおり修正しました。</p>
        </div>

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
