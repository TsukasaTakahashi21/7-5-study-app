<?php
//DB接続
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=learningmanagement; charset=utf8',
  $dbUserName, 
  $dbPassword
);

$id = isset($_POST['id']) ? $_POST['id'] : '';
$theme = isset($_POST['theme']) ? $_POST['theme'] : '';
$contents = isset($_POST['contents']) ? $_POST['contents'] : '';


// エラーメッセージ表示
$errors = [];
if (empty($theme) || empty($contents)) {
  $errors[] = 'タイトルまたは学習のまとめが入力されていません';
}

if(empty($errors)) {
  $sql = "UPDATE learningnotes SET theme = :theme, contents = :contents WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam( ':id', $id, PDO::PARAM_INT);
  $stmt->bindParam( ':theme', $theme, PDO::PARAM_STR);
  $stmt->bindParam( ':contents', $contents, PDO::PARAM_STR);
  $result = $stmt->execute();

  if($result) {
    header('Location: index.php');
    exit();
  } else {
    $errors[] = '更新に失敗しました';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>学習更新</title>
</head>
<body>
  <?php if (!empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
      <p><?php echo $error; ?></p>
    <?php endforeach; ?>
  <?php endif; ?>
  <a href="index.php">トップページへ戻る</a>
</body>
</html>