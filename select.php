<?php
try {
    $pdo = new PDO('mysql:dbname=recruit;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DB_Connect:' . $e->getMessage());
}

$sql = "SELECT * FROM entry;";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:" . $error[2]);
}

$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
            <a href="index.php">
                <img class="logo" src="img/logo.png" alt="Sushi inc. Logo" />
            </a>
            <a class="logop" href="index.php"> Sushi inc. </a>
        </div>
        <div class="navi">
            <button class="b1"><a href="admin.php">ポジション追加はこちらへ</a></button>
        </div>
    </header>

    <div>
        <div class="members">
            <?php foreach ($values as $value) { ?>
                <ul class="ul1">
                    <li><?= $value["id"] ?></li>
                    <li><?= $value["name"] ?></li>
                    <li><?= $value["mail"] ?></li>
                    <li><?= $value["position"] ?></li>
                    <li><?= $value["file"] ?></li>
                    <li><?= $value["indate"] ?></li>
                    <li><a href="detail.php?id=<?= $value["id"] ?>">[更新]</a></li>
                    <li><a href="delete.php?id=<?= $value["id"] ?>">[削除]</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>

    <footer>
        <p>&copy;Sushi inc.</p>
    </footer>
</body>

</html>