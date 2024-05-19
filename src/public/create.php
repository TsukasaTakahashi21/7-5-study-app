
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>学習登録</title>
</head>
<body>
  <h2>学習のまとめを登録</h2>
  <form action="store.php" method="post">
    <label for="" name="theme">タイトル</label>
    <input type="text" name="theme" placeholder="タイトル"><br>
    <label for="" name="contents">学習のまとめ</label>
    <textarea name="contents" id="" cols="30" rows="10"></textarea><br>
    <button type="submit">登録</button>
  </form>
</body>
</html>