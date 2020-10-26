<?php
  $server_name = $_SERVER['SERVER_NAME'];
  $root_dir = explode('/', $_SERVER['REQUEST_URI'])[1];

  session_start();

  if (count($_SESSION['session_users']) == 0) {
    header("Location: http://$server_name/$root_dir/admin/");
  }
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
    <link href="../assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <?php include_once "../includes/header.php"; ?>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <?php include_once "../includes/menu.php"; ?>
            </ul>

            <ul class="nav flex-column mb-2">
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Produtos</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button class="btn btn-sm btn-success btn-block" type="button">+ Novo</button>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th style="width: 200px;">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr product_id="1">
                  <td>1</td>
                  <td>Painel 60cmx60cm</td>
                  <td style="width: 200px; display: flex;">
                    <button class="btn btn-sm btn-success" type="button" style="display: flex; margin-right: 5px;">
                      <span data-feather="edit" style="margin-right: 5px;"></span>
                      Editar
                    </button>

                    <button class="btn btn-sm btn-danger" type="button" style="display: flex;">
                      <span data-feather="trash" style="margin-right: 5px;"></span>
                      Excluir
                    </button>
                  </td>
                </tr>
                <tr product_id="2">
                  <td>2</td>
                  <td>Painel 120cmx120cm</td>
                  <td style="width: 200px; display: flex;">
                    <button class="btn btn-sm btn-success" type="button" style="display: flex; margin-right: 5px;">
                      <span data-feather="edit" style="margin-right: 5px;"></span>
                      Editar
                    </button>

                    <button class="btn btn-sm btn-danger" type="button" style="display: flex;">
                      <span data-feather="trash" style="margin-right: 5px;"></span>
                      Excluir
                    </button>
                  </td>
                </tr>
                <tr product_id="3">
                  <td>3</td>
                  <td>Painel 200cmx200cm</td>
                  <td style="width: 200px; display: flex;">
                    <button class="btn btn-sm btn-success" type="button" style="display: flex; margin-right: 5px;">
                      <span data-feather="edit" style="margin-right: 5px;"></span>
                      Editar
                    </button>

                    <button class="btn btn-sm btn-danger" type="button" style="display: flex;">
                      <span data-feather="trash" style="margin-right: 5px;"></span>
                      Excluir
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <?php include_once "../includes/footer.php"; ?>
  </body>
</html>
