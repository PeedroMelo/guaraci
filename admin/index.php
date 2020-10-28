<?php
  $server_name = $_SERVER['SERVER_NAME'];
  $root_dir = explode('/', $_SERVER['REQUEST_URI'])[1];

  session_start();

  if (count($_SESSION['session_users'])) {
    header("Location: http://$server_name/$root_dir/view/products/");
  }

  require '../config/Config.php';
  $config = new Config();
  $config->init();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title>ENTRAR | Guaraci - Levando energia sustentável para todos.</title>

    <!-- Bootstrap core CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="../assets/css/styles.css?v=2" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>

  <body class="text-center">

    <main>
      <div id="login-form" class="container">

        <img class="mb-4" src="../assets/img/test.png" alt="">
        <div class="py-5 text-center">
          <h3>Entre com seus dados abaixo:</h3>
        </div>

        <form class="needs-validation" novalidate>
          <div class="row" style="margin-bottom: 10px;">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" placeholder="email@exemplo.com" required autofocus>
            <div class="invalid-feedback">
              Por favor, informe seu <strong>e-mail</strong>.
            </div>
          </div>

          <div class="row" style="margin-bottom: 20px;">
            <label for="inputPassword">Senha</label>
            <input type="password" id="password" class="form-control" placeholder="********" required>
            <div class="invalid-feedback">
              Por favor, informe sua <strong>senha</strong>.
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-2">
              <a href="../index.html">
               <button class="btn btn-lg btn-primary btn-block" type="button">Voltar</button>
              </a>
            </div>
            <div class="col-md-6 mb-4">
              <div class="mb-2">
                <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
              </div>
            </div>
          </div>
        </form>

      </div>
    </main>

    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="js/functions.js?v=<?php echo 4; ?>"></script>
  </body>
</html>
