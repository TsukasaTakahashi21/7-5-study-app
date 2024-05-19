<?php
//DB接続
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=learningmanagement; charset=utf8',
  $dbUserName, 
  $dbPassword
);

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!$id) {
  die('IDが指定されていません');
}

$sql = "SELECT * FROM learningnotes WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$learning = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$learning) {
  die('データが見つかりません');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>学習フォームの編集</title>
</head>
<body>
  <h2>編集</h2>
  <form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($learning['id'], ENT_QUOTES, 'UTF-8'); ?>">
    <label for="" name="theme">タイトル</label>
    <input type="text" name="theme" value="<?php echo htmlspecialchars($learning['theme'], ENT_QUOTES, 'UTF-8'); ?>"><br>
    <label for="" name="contents">学習のまとめ</label>
    <textarea name="contents" id="" cols="30" rows="10"><?php echo htmlspecialchars($learning['contents'], ENT_QUOTES, 'UTF-8'); ?>更新</textarea>

    <button type="submit">更新</button>
  </form>
</body>
</html>