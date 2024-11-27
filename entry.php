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
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <div class="ra">
                    <div>
                        <p class="p1">名前：</p>
                        <input type="text" class="in" name="name" required>
                    </div>
                    <div>
                        <p class="p1">メールアドレス：</p>
                        <input type="email" class="in" name="mail" required>
                    </div>
                    <div>
                        <p class="p1">希望のポジション：</p>
                        <select class="in" name="position" required>
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
                        <input type="file" class="in" name="file" accept=".pdf, .jpg, .jpeg, .png" required>
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