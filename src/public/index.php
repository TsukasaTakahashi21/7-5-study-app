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

$sql = "SELECT * FROM learningnotes";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$learnings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>学習のまとめ一覧</title>
</head>
<body>
  <a href="create.php">まとめを追加</a>
  <table border="1" width="800" bgcolor= #EEEEEE>
    <tr>
      <th>テーマ</th>
      <th>学習のまとめ</th>
      <th>作成日時</th>
      <th>編集</th>
      <th>削除</th>
    </tr>
    <?php foreach ($learnings as $learning): ?>
      <tr>
      <td><?php echo htmlspecialchars($learning['theme'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($learning['contents'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($learning['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><a href="edit.php?id=<?php echo htmlspecialchars($learning['id'], ENT_QUOTES, 'UTF-8'); ?>">編集</a></td>
        <td><a href="delete.php?id=<?php echo htmlspecialchars($learning['id'], ENT_QUOTES, 'UTF-8'); ?>">削除</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>