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
    <section class="missionimg">
      <div>
        <h2 class="mission">
          伝統と革新を融合させ、世界中に感動を届ける寿司を創造する
        </h2>
        <div>
          <button class="b2">
            <a href="position.php">ポジション一覧</a>
          </button>
          <button class="b3"><a href="entry.php">応募する</a></button>
        </div>
      </div>
    </section>
    <section class="jobboard">
      <div class="jobbox">
        <?php
        $filename = "data.csv";
        $fp = fopen($filename, "r");
        while (!feof($fp)) {
          $csv = fgets($fp);

          $array = explode(",", $csv);


          echo "<div class='jb'>", "<div class='pn'>", $array[0], "</div>", "<br>", "<div class='an'>",  $array[1], "</div>", "<br>", "<div class='dn'>", $array[2], "</div>", "<br>", "</div>";
        };
        fclose($fp); ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy;Sushi inc.</p>
  </footer>
</body>

</html>