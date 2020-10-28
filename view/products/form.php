<?php
  $server_name = $_SERVER['SERVER_NAME'];
  $root_dir = explode('/', $_SERVER['REQUEST_URI'])[1];

  session_start();

  if (count($_SESSION['session_users']) == 0) {
    header("Location: http://$server_name/$root_dir/admin/");
  }

  $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
  $products = $_SESSION['fakeDB']['Products'][$product_id];
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Produtos | Guaraci Soluções Energéticas BR</title>

    <!-- Bootstrap core CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">

    <!-- Custom styles -->
		<link href="../../assets/css/dashboard.css" rel="stylesheet">
		<link href="css/form-validation.css" rel="stylesheet">
  </head>

  <body>
    <?php include_once "../../includes/header.php"; ?>

    <input type="hidden" id="product_id" value="<?= $product_id <> '' ? $product_id : '' ?>">

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <?php include_once "../../includes/menu.php"; ?>
            </ul>

            <ul class="nav flex-column mb-2">
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Produtos</h1>
          </div>

          <div class="row">
            <div class="col-md-12 order-md-1">
							<form class="needs-validation" novalidate>
								<div class="row">
									<div class="col-md-4">
										<label for="name">Nome</label>
										<input type="text" class="form-control" id="name" placeholder="" value="<?= isset($products['name']) ? $products['name'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe o <strong>nome</strong> do produto.
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4 mb-3">
										<label for="price">Preço (R$)</label>
										<input type="text" class="form-control" id="price" placeholder="" value="<?= isset($products['price']) ? $products['price'] : 0 ?>" required>
										<div class="invalid-feedback">
											Por favor, informe o <strong>preço</strong>.
										</div>
									</div>
								</div>

								<a href="./" style="text_decoration: none;">
									<button class="btn btn-sm btn-danger" type="button">Cancelar</button>
								</a>
								<button class="btn btn-sm btn-success" type="submit">Salvar</button>
							</form>
            </div>
          </div>
        </main>
      </div>
		</div>

    <?php include_once "../../includes/footer.php"; ?>
		<script src="js/form-validation.js?v=2"></script>
  </body>
</html>
