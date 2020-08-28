<?php
session_start();
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
  header("location: dashboard.php");
  exit;
}

include_once "php/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name_err = $last_name_err = $password_err = $phone_number_err = $email_err = "";
  // Check if first name blank
  if (empty(trim($_POST["first_name"]))) {
    $first_name_err = "Please enter your first name.";
  }
  // Check if last name blank
  if (empty(trim($_POST["last_name"]))) {
    $last_name_err = "Please enter your last name.";
  }
  // Check if password blank
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  }
  // Check if phone number blank
  if (empty(trim($_POST["phone_number"]))) {
    $phone_number_err = "Please enter your phone number.";
  }
  // Check if email is taken or blank
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter an email.";
  } else {
    $sql = "SELECT user_id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = trim($_POST["email"]);
    if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      if (mysqli_stmt_num_rows($stmt) == 1) {
        $email_err = "This email is already taken.";
      }
    }
    mysqli_stmt_close($stmt);
  }

  if (empty($first_name_err) && empty($last_name_err) && empty($password_err) && empty($email_err) && empty($phone_number_err)) {
    $sql = "INSERT INTO users (first_name, last_name, email, password, phone_number) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $email, $password, $phone_number);
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $phone_number = trim($_POST["phone_number"]);

    if (mysqli_stmt_execute($stmt)) {
      header("location:login.php?new=true");
    } else {
      echo "Something went wrong. Please try again later.";
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
  <link rel="stylesheet" href="css/register.css">
  <title>Moviebook | Register</title>
</head>

<body>
  <div class="container">
    <!--Columns-->
    <div class="columns is-centered">
      <div class="column is-half">

        <!--Card-->
        <div class="card">
          <div class="card-header">
            <h1 class="card-header-title is-centered">Register</h1>
          </div>
          <div class="card-content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

              <div class="field">
                <label class="label">Name</label>
                <div class="field-body">
                  <div class="field">
                    <p class="control has-icons-left">
                      <input type="text" class="input <?php echo (!empty($first_name_err)) ? 'is-danger' : ''; ?>" placeholder="First Name" name="first_name" id="first_name" value="<?php echo isset($_POST["first_name"]) ? $_POST['first_name'] : ''; ?>">
                      <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                      </span>
                    </p>
                    <p class="help <?php echo (!empty($first_name_err)) ? 'is-danger' : ''; ?>"><?php echo isset($first_name_err) ? $first_name_err : '' ?></p>
                  </div>
                  <div class="field">
                    <p class="control">
                      <input type="text" class="input <?php echo (!empty($last_name_err)) ? 'is-danger' : ''; ?>" placeholder="Last Name" name="last_name" id="last_name" value="<?php echo isset($_POST["last_name"]) ? $_POST['last_name'] : ''; ?>">
                    </p>
                    <p class="help <?php echo (!empty($last_name_err)) ? 'is-danger' : ''; ?>"><?php echo isset($last_name_err) ? $last_name_err : '' ?></p>
                  </div>
                </div>
              </div>

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
                <label class="label">Telephone Number</label>
                <p class="control has-icons-left">
                  <input type="tel" class="input <?php echo (!empty($phone_number_err)) ? 'is-danger' : ''; ?>" placeholder="01234567890" name="phone_number" id="phone_number" value="<?php echo isset($_POST["phone_number"]) ? $_POST['phone_number'] : ''; ?>">
                  <span class="icon is-small is-left">
                    <i class="fas fa-phone"></i>
                  </span>
                </p>
                <p class="help <?php echo (!empty($phone_number_err)) ? 'is-danger' : ''; ?>"><?php echo isset($phone_number_err) ? $phone_number_err : '' ?></p>
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
                    <input type="submit" class="button is-success">
                    <input type="reset" class="button is-danger">
                  </div>
                </div>
              </div>

            </form>
          </div>
          <div class="card-footer">
            <a class="card-footer-item" href="./login.php">Already have an account?</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>