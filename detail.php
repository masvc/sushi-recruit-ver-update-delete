<?php
$id = $_GET["id"];

//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM entry WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',    $_GET["id"],    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//３．データ表示
$values = "";
if ($status == false) {
    sql_error($stmt);
}

//全データ取得
$v = $values =  $stmt->fetch(); //一番上の行から１行だけとる


?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sushi inc. Recruit Site</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="destyle.css" />
</head>

<body>
    <header>
        <div class="headbox">
            <img class="logo" src="img/logo.png" alt="" />
            <a class="logop" href="index.php"> Sushi inc. </a>
        </div>
        <div class="navi">
            <button class="b1"><a href="admin.php">ポジション追加はこちらへ</a></button>
        </div>
    </header>

    <main>
        <div class="recruit">
            <form action="update.php" method="post" enctype="multipart/form-data">
                <div class="ra">
                    <div>
                        <p class="p1">名前：</p>
                        <input type="text" class="in" name="name" value="<?= $v["name"] ?>">
                    </div>
                    <div>
                        <p class="p1">メールアドレス：</p>
                        <input type="email" class="in" name="mail" value="<?= $v["mail"] ?>">
                    </div>
                    <div>
                        <p class="p1">希望のポジション：</p>
                        <select class="in" name="position" value="<?= $v["position"] ?>">
                            <?php
                            // CSVファイルのパス
                            $csvFile = 'data.csv';

                            // CSVファイルを読み込み
                            if (($handle = fopen($csvFile, 'r')) !== FALSE) {
                                // 各行を処理
                                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                                    // 配列の0番目の要素を選択肢として表示
                                    echo '<option value="' . htmlspecialchars($data[0]) . '">' . htmlspecialchars($data[0]) . '</option>';
                                }
                                fclose($handle);
                            } else {
                                echo '<option value="">CSVファイルの読み込みに失敗しました</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <p class="p1">履歴書など書類[PDF or img]：</p>
                        <input type="file" class="in" name="file" accept=".pdf, .jpg, .jpeg, .png" value="<?= $v["file"] ?>">
                    </div>
                    <div>
                        <input type="hidden" name="id" value="<?= $v["id"] ?>">;
                    </div>
                </div>
                <button type="submit" class="b2">応募する</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy;Sushi inc.</p>
    </footer>
</body>

</html>