<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sushi inc. Recruit Site </title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="destyle.css" />
</head>

<body>
    <header>
        <div class="headbox">
            <img class="logo" src="img/logo.png" alt="" href="index.php" />
            <a class="logop" href="index.php"> Sushi inc. </a>
        </div>
        <div class="navi">
            <button class="b1"><a href="admin.php">ポジション追加はこちらへ</a></button>
        </div>
    </header>

    <main>
        <div class="recruit">
            <form action="write.php" method="post">
                <div class="ra">

                    <div>
                        <p class="p1"> Position:</p>
                        <input type="text" class="in"
                            name="position" placeholder="Sushi Professional">

                    </div>
                    <div>
                        <p class="p1"> Area:</p>
                        <input type="text" class="in" name="area" placeholder="Japan">

                    </div>

                    <div>
                        <p class="p1"> Job Discription:</p>
                        <textarea class="in" name="jd" rows="3" style="overflow-y: scroll;" placeholder=+>経験年数：　年、スキル：素早い手捌きと飾り包丁経験、やる気歓迎！</textarea>
                    </div>
                </div>
                <button type="submit" class="b2">公開する</button>
            </form>
        </div>
    </main>

    <footer>
        <a class="fa" href="select.php">応募者管理へ</a>
        <p>&copy;Sushi inc.</p>
    </footer>
</body>

</html>