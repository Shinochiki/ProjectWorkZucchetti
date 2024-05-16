<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>MyClassHub-Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css" />

</head>

<body class="light">
  <div class="mode" id="mode">
    <div class="img_mode" id="photo"></div>
  </div>

  <div class="cover yes" id="all">
    <div class="cover__content">
      <div class="img_logo"></div>
      <form onsubmit="call(event)">
        <div class="user_text acceso" id="user_text1">
          <h4>USER</h4>
        </div>
        <input type="text" name="Username" id="user" class="on" placeholder="USERNAME" required />
        <div class="user_text acceso" id="user_text2">
          <h4>PASSWORD</h4>
        </div>
        <input type="password" name="Password" id="password" class="on" placeholder="PASSWORD" required />

        <!-- ---------------------------- INIZIO CHAPTHA ---------------------------- -->

        <?php
        session_start();

        function generateRandomString($length = 6)
        {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
        }

        $captcha_code = generateRandomString();
        $_SESSION['captcha_code'] = $captcha_code;

        echo "<br>";
        echo $captcha_code;
        ?>

        <input type="text" name="CaptchaInput" id="captchaInput" required>

        <!-- ---------------------------- FINE CHAPTHA ---------------------------- -->

        <input type="submit" class="invio si oui" id="invio" value="ACCEDI" />
      </form>

      <script>
        var accettazione = 0;
        function call(event) {
          event.preventDefault();
          var username = document.getElementById('user').value;
          var password = document.getElementById('password').value;
          var captchaInput = document.getElementById('captchaInput').value;


          ajaxLogin(username, password, captchaInput);
        }

        function ajaxLogin(user, pass, capt) {
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                console.log(xhr.responseText);
                accettazione = xhr.responseText;
              } else {
                console.error('Request failed with status:', xhr.status);
              }
            }
          };
          xhr.open('POST', 'funzioniPHP/login.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.send('user=' + user + '&pass=' + pass + '&capt=' + capt + '&method=' + 'averageGrade');

          redirect();
        }

        function redirect() {
          console.log("accettazione: " + accettazione);
          if (accettazione == 1) {
            window.location.href = "studente.php";
          } else if (accettazione == 2) {
            window.location.href = "professore.php"
          } else {
            console.log("HAI CANNATO PASWORD")
          }
        }
      </script>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#mode").on("click", function() {
        $("body").toggleClass("light");
        $("body").toggleClass("night");
        $("#photo").toggleClass("img_mode");
        $("#photo").toggleClass("luce");
        $("#mode").toggleClass("mode");
        $("#mode").toggleClass("modalità");
        $("#user_text1").toggleClass("acceso");
        $("#user_text1").toggleClass("spento");
        $("#user_text2").toggleClass("acceso");
        $("#user_text2").toggleClass("spento");
        $("#user").toggleClass("on");
        $("#user").toggleClass("off");
        $("#password").toggleClass("on");
        $("#password").toggleClass("off");
        $("#invio").toggleClass("si");
        $("#invio").toggleClass("no");
        $("#invio").toggleClass("oui");
        $("#invio").toggleClass("nop");
        $("#all").toggleClass("yes");
        $("#all").toggleClass("nu");
      });
    });
  </script>
</body>

</html>