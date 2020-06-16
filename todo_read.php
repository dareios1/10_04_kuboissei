<?php
session_start();
include("functions.php");
check_session_id();

// ユーザ名取得
$user_id = $_SESSION['id'];

// DB接続
$pdo = connect_to_db();

// いいね数カウント


// データ取得SQL作成
$sql = 'SELECT * FROM todo_table LEFT OUTER JOIN (SELECT todo_id, COUNT(id) AS cnt FROM like_table GROUP BY todo_id) AS likes ON todo_table.id = likes.todo_id';
// $sql = 'SELECT todo_id, COUNT(id) AS cnt FROM like_table GROUP BY todo_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<div class='date'>{$record["deadline"]}</div>";
    $output .= "<div class='text'>{$record["todo"]}</div>";
    // like edit deleteリンクを追加
    $output .= "<div class='twitter__block-text'>";
    $output .= "<span class='twitter-heart'><a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}'>like{$record["cnt"]}</a></span>";
    $output .= "<span class='twitter-bubble'><a href='todo_edit.php?id={$record["id"]}'>edit</a></span>";
    $output .= "<span class='twitter-loop'><a href='todo_delete.php?id={$record["id"]}'>delete</a></span>";
    $output .= "</div>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
?>

<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>twitter風チャット画面(会話方式)を記事に表示する方法</title>
  <link rel='stylesheet' href='style.css' type='text/css' media='all' />
</head>

<body>

  <!-- ▼twitter風ここから -->
  <div class="twitter__container">
    <!-- タイトル -->
    <div class="twitter__title">
      <span class="twitter-logo"></span>
    </div>

    <a href="todo_input.php">todo input</a>

    <!-- ▼タイムラインエリア scrollを外すと高さ固定解除 -->
    <div class="twitter__contents scroll">

      <!-- 記事エリア -->
      <div class="twitter__block">
        <figure>
          <img src="icon.jpg" />
        </figure>
        <div class="twitter__block-text">
          <div class="name">ダレイオス</div>
          <div class="date"></div>
          <div class="text"></div>
          <div class="twitter__icon"><?= $output ?></div>
        </div>
      </div>

      <a href="todo_logout.php">logout</a>

    </div>
    <!--　▲タイムラインエリア ここまで -->
  </div>
  <!--　▲twitter風ここまで -->

</body>

</html>