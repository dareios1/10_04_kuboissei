<?php
// 送信データのチェック
// var_dump($_GET);
// exit();
session_start();

// 関数ファイルの読み込み
include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM todo_table WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Font Awesome https://fontawesome.com/start -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- Bootstrap https://getbootstrap.com/docs/4.3/getting-started/introduction/ -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>todo edit</title>
</head>

<body>

  <section class="container">
    <header class="text-center text-light my-4">
      <h1 class="mb-4">todo edit</h1>
      <a href="todo_read.php">todo list</a>
    </header>

    <form action="todo_update.php" method="POST" class="add text-center my-4">
      <input type="text" name="todo" class="form-control m-auto" placeholder="to do" value="<?= $record["todo"] ?>">
      <input type="date" name="deadline" class="form-control m-auto" placeholder="deadline" value="<?= $record["deadline"] ?>">
      <button class="button">submit</button>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </form>

    <div class="text-center text-light my-4">
      <a href="todo_logout.php">logout</a>
    </div>

  </section>

</body>

</html>