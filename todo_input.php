<?php
session_start(); //セッションの開始
include('functions.php'); //関数ファイル読み込み
check_session_id(); //idチェック関数の実行
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
  <title>todo input</title>
</head>

<body>

  <section class="container">
    <header class="text-center text-light my-4">
      <h1 class="mb-4">todo input</h1>
      <a href="todo_read.php">todo list</a>
    </header>

    <form action="todo_create.php" method="POST" class="add text-center my-4">
      <input type="text" name="todo" class="form-control m-auto" placeholder="to do">
      <input type="date" name="deadline" class="form-control m-auto" placeholder="deadline">
      <button class="button">submit</button>
    </form>

    <div class="text-center text-light my-4">
      <a href="todo_logout.php">logout</a>
    </div>

  </section>


</body>

</html>