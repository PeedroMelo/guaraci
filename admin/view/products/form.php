<?php
  require __DIR__ . '/../../includes/helpers/Autentication.php';
  require __DIR__ . '/../../controller/ProductController.php';

  $auth = new Autentication();
  $auth->autenticateSession();

  $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';

  $product = [];
  if ($product_id != '') {
    $productController = new ProductController();
    $product = $productController->findProductById($product_id)[0];
  }
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
		<link href="../../../assets/css/dashboard.css" rel="stylesheet">
		<link href="css/form-validation.css" rel="stylesheet">
  </head>

  <body>
    <?php include_once "../../includes/templates/header.php"; ?>

    <input type="hidden" id="product_id" value="<?= $product_id <> '' ? $product_id : '' ?>">

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
            <h1 class="h2">Produtos</h1>
          </div>

          <div class="row">
            <div class="col-md-12 order-md-1">
							<form class="needs-validation" novalidate>
								<div class="row">
									<div class="col-md-4">
										<label for="name">Nome</label>
										<input type="text" class="form-control" id="name" placeholder="" value="<?= isset($product['name']) ? $product['name'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe o <strong>nome</strong> do produto.
										</div>
									</div>
								</div>

                <div class="row">
									<div class="col-md-4">
										<label for="name">Descrição</label>
										<input type="text" class="form-control" id="description" placeholder="" value="<?= isset($product['description']) ? $product['description'] : '' ?>">
										<div class="invalid-feedback">
											Por favor, informe o <strong>nome</strong> do produto.
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4 mb-3">
										<label for="value">Preço (R$)</label>
										<input type="text" class="form-control" id="value" placeholder="" value="<?= isset($product['value']) ? $product['value'] : 0 ?>" required>
										<div class="invalid-feedback">
											Por favor, informe o <strong>preço</strong>.
										</div>
									</div>
								</div>

                <div class="row">
									<div class="col-md-4 mb-3">
										<label for="value">Ativo?</label>
                    <input type="checkbox" name="active" id="active" <?= isset($product['active']) && $product['active'] ? 'checked' : '' ?> >
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

    <?php include_once "../../includes/templates/footer.php"; ?>
		<script src="js/form-validation.js?v=32"></script>
  </body>
</html>
