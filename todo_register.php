<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todoリストユーザ登録画面</title>
  <link rel="stylesheet" href="style.scss">
</head>

<body>

  <form action="todo_register_act.php" method="POST" class="login-form">
    <p class="login-text">
      <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-lock fa-stack-1x"></i>
      </span>
    </p>
    <input type="text" name="user_id" class="login-username" autofocus="true" required="true" placeholder="Username" />
    <input type="text" name="password" class="login-password" required="true" placeholder="Password" />
    <input type="submit" name="Login" value="Login" class="login-submit" />
  </form>
  <a href="todo_login.php" class="login-forgot-pass">or login?</a>
  <div class="underlay-photo"></div>
  <div class="underlay-black"></div>

</body>

</html>