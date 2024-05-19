<?php
//DB接続
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=learningmanagement; charset=utf8',
  $dbUserName, 
  $dbPassword
);

$theme = isset($_POST['theme']) ? $_POST['theme'] : '';
$contents = isset($_POST['contents']) ? $_POST['contents'] : '';

// エラーメッセージの表示
$errors = [];
if (empty($theme) || empty($contents)) {
  $errors[] = 'タイトルまたは学習のまとめが入力されていません';
}

// データをDBに保存
if (empty($errors)) {
  $sql = "INSERT INTO learningnotes (theme, contents) VALUES (:theme, :contents)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':theme', $theme, PDO::PARAM_STR);
  $stmt->bindValue('contents', $contents, PDO::PARAM_STR);
  $stmt->execute();
  header('Location: index.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if (!empty($errors)): ?>
    <?php foreach($errors as $error): ?>
      <p><?php echo $error."\n"; ?></p>
    <?php endforeach; ?>
    <a href="index.php">トップページへ</a>
  <?php endif; ?>

</body>
</html>