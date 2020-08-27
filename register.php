<?php
include_once "php/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
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
            <form action="register.php" method="POST">

              <div class="field">
                <label class="label">Name</label>
                <div class="field-body">
                  <div class="field">
                    <p class="control has-icons-left">
                      <input type="text" class="input" placeholder="First Name" id="first_name">
                      <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control">
                      <input type="text" class="input" placeholder="Last Name" id="last_name">
                    </p>
                  </div>
                </div>
              </div>

              <div class="field">
                <label class="label">Email</label>
                <p class="control has-icons-left">
                  <input type="email" class="input" placeholder="example@gmail.com" id="email">
                  <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                  </span>
                </p>
              </div>

              <div class="field">
                <label class="label">Telephone Number</label>
                <p class="control has-icons-left">
                  <input type="tel" class="input" placeholder="01234567890" id="phone_number">
                  <span class="icon is-small is-left">
                    <i class="fas fa-phone"></i>
                  </span>
                </p>
              </div>

              <div class="field">
                <label class="label">Password</label>
                <p class="control has-icons-left">
                  <input type="password" class="input" placeholder="Password" id="password">
                  <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                  </span>
                </p>
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