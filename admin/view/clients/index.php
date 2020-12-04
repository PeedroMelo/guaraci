<?php
  require '../../includes/helpers/Autentication.php';
  $auth = new Autentication();
  $auth->autenticateSession();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Guaraci Soluções Energéticas BR</title>

    <!-- Bootstrap core CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../../../assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <?php include_once "../../includes/templates/header.php"; ?>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <?php include_once "../../includes/templates/menu.php"; ?>
            </ul>

            <ul class="nav flex-column mb-2">
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Clientes</h1>
            <div class="btn-toolbar mb-6 mb-md-0">
              <div style="display: flex; align-items: center; width: 240px;">
                <input type="text" id="client_email" name="client_email" placeholder="Digite um e-mail + [Enter]" style="height: 31px; width: 100%; margin-right: 5px;"/>
              </div>
              <div style="margin-left: 5px;">
                <a href="form.php" style="text_decoration: none;">
                  <button class="btn btn-sm btn-success btn-block" type="button">+ Novo</button>
                </a>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th style="width: 200px;">Ações</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <?php include_once "../../includes/templates/footer.php"; ?>
		<script src="js/functions.js?v=5"></script>
  </body>
</html>
