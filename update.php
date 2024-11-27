<!-- //PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
// POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
// "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
// bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更 -->

<?php
// POSTデータを取得
$name = $_POST["name"];
$mail = $_POST["mail"];
$position = $_POST["position"];
$id = $_POST["id"];

// ファイルのアップロード処理
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);  // ディレクトリが存在しない場合は作成
}

$file = $_FILES["file"];
$fileError = $file["error"];
$fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
$target_file = $target_dir . basename($file["name"]);

// アップロードエラーチェック
if ($fileError !== UPLOAD_ERR_OK && $fileError !== UPLOAD_ERR_NO_FILE) {
    switch ($fileError) {
        case UPLOAD_ERR_INI_SIZE:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = "The uploaded file was only partially uploaded.";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Missing a temporary folder.";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = "Failed to write file to disk.";
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = "A PHP extension stopped the file upload.";
            break;
        default:
            $message = "Unknown upload error.";
            break;
    }
    exit("Error: " . $message);
}

// PDFまたは画像ファイルかどうかチェック
if ($fileError !== UPLOAD_ERR_NO_FILE) {
    if (!in_array($fileType, ["pdf", "jpg", "jpeg", "png"])) {
        exit("Error: Only PDF, JPG, JPEG, PNG files are allowed.");
    }

    // ファイルを指定ディレクトリに移動
    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
        exit("Error: There was an error uploading your file.");
    }
} else {
    $target_file = NULL;  // ファイルがアップロードされていない場合はNULLに設定
}

try {
    $pdo = new PDO('mysql:dbname=recruit;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DB Connect Error: ' . $e->getMessage());
}

// SQL文を準備
$sql = "UPDATE entry SET name=:name, mail=:mail, position=:position, file=:file WHERE id=:id";
$stmt = $pdo->prepare($sql);

// パラメータをバインド
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':position', $position, PDO::PARAM_STR);
$stmt->bindValue(':file', $target_file, PDO::PARAM_STR);  // ファイルパスまたはNULLを保存
$stmt->bindValue(':id',    $id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)


// 実行とエラーチェック
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit("SQL Error: " . $error[2]);
} else {
    header("Location: select.php");
    exit();
}
