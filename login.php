<?php
session_start();
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
  header("location: dashboard.php");
  exit;
}

include_once 'php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if password blank
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  }
  // Check if email blank
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter an email.";
  }

  if (empty($password_err) && empty($email_err)) {
    $sql = "SELECT user_id, first_name, last_name, password, is_admin FROM users WHERE email = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = trim($_POST["email"]);
    if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $user_id, $first_name, $last_name, $password, $is_admin);
        mysqli_stmt_fetch($stmt);
        if ($password == $_POST["password"]) {
          session_start();
          $_SESSION["logged_in"] = true;
          $_SESSION["user_id"] = $user_id;
          $_SESSION["full_name"] = $first_name." ".$last_name;
          $_SESSION["is_admin"] = $is_admin ? true : false;
          header('location: dashboard.php');
        } else {
          $password_err = "Invalid password.";
        }
      } else {
        $email_err = "Invalid email.";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <!--Bulma CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css" integrity="sha512-ADrqa2PY1TZtb/MoLZIZu/Z/LlPaWQeDMBV73EMwjGam43/JJ5fqW38Rq8LJOVGCDfrJeOMS3Q/wRUVzW5DkjQ==" crossorigin="anonymous" />
  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
  <!--Custom CSS-->
  <link rel="stylesheet" href="css/login.css">
  <title>Moviebook | Login</title>
</head>

<body>
  <div class="container">
    <!--Columns-->
    <div class="columns is-centered">
      <div class="column is-half">

        <!--Card-->
        <div class="card">
          <div class="card-header">
            <h1 class="card-header-title is-centered">Login</h1>
          </div>
          <div class="card-content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

              <div class="field">
                <label class="label">Email</label>
                <p class="control has-icons-left">
                  <input type="email" class="input <?php echo (!empty($email_err)) ? 'is-danger' : ''; ?>" placeholder="example@gmail.com" name="email" id="email" value="<?php echo isset($_POST["email"]) ? $_POST['email'] : ''; ?>">
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                </p>
                <p class="help <?php echo (!empty($email_err)) ? 'is-danger' : ''; ?>"><?php echo isset($email_err) ? $email_err : '' ?></p>
              </div>

              <div class="field">
                <label class="label">Password</label>
                <p class="control has-icons-left">
                  <input type="password" class="input <?php echo (!empty($password_err)) ? 'is-danger' : ''; ?>" placeholder="Password" name="password" id="password">
                  <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                  </span>
                </p>
                <p class="help <?php echo (!empty($password_err)) ? 'is-danger' : ''; ?>"><?php echo isset($password_err) ? $password_err : '' ?></p>
              </div>

              <div class="field">
                <div class="control">
                  <div class="buttons is-centered">
                    <input type="submit" class="button is-success" value="Login">
                  </div>
                </div>
              </div>

            </form>
          </div>
          <div class="card-footer">
            <a class="card-footer-item" href="./register.php">Don't have an account yet?</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>