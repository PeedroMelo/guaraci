<?php
  require __DIR__ . '/../../includes/helpers/Autentication.php';
  require __DIR__ . '/../../controller/ClientController.php';

  $auth = new Autentication();
  $auth->autenticateSession();

  $client_id = isset($_GET['client_id']) ? $_GET['client_id'] : '';

  $clients = [];
  if ($client_id != '') {
    $clientController = new ClientController();
    $client = $clientController->findClientById($client_id)[0];
  }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Clientes | Guaraci Soluções Energéticas BR</title>

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

    <input type="hidden" id="client_id" value="<?= $client_id <> '' ? $client_id : '' ?>">

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
          </div>

          <div class="row">
            <div class="col-md-12 order-md-1">
							<form class="needs-validation" novalidate>

                <div class="row">
									<div class="col-md-4">
										<label for="name">Nome</label>
										<input type="text" class="form-control" id="first_name" placeholder="" value="<?= isset($client['first_name']) ? $client['first_name'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe seu <strong>Nome</strong>.
										</div>
									</div>
								</div>

                <div class="row">
									<div class="col-md-4">
										<label for="name">Sobrenome</label>
										<input type="text" class="form-control" id="last_name" placeholder="" value="<?= isset($client['last_name']) ? $client['last_name'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe seu <strong>Sobrenome</strong>.
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<label for="email">E-mail</label>
										<input type="text" class="form-control" id="email" placeholder="" value="<?= isset($client['email']) ? $client['email'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe seu <strong>email</strong>.
										</div>
									</div>
								</div>

                <div class="row">
									<div class="col-md-4">
										<label for="name">Nascimento</label>
										<input type="text" class="form-control" id="birthdate" placeholder="01/01/1900" maxlength="10" value="<?= isset($client['birthdate']) ? $client['birthdate'] : '' ?>">
										<div class="invalid-feedback">
											Por favor, informe seu <strong>nascimento</strong>.
										</div>
									</div>
								</div>

                <div class="row">
									<div class="col-md-4">
										<label for="email">Telefone</label>
										<input type="text" class="form-control" id="phonenumber" placeholder="" value="<?= isset($client['phonenumber']) ? $client['phonenumber'] : '' ?>">
										<div class="invalid-feedback">
											Por favor, informe seu <strong>telefone</strong>.
										</div>
									</div>
								</div>

                <div class="row">
									<div class="col-md-4">
										<label for="email">Celular</label>
										<input type="text" class="form-control" id="cellphone" placeholder="" value="<?= isset($client['cellphone']) ? $client['cellphone'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe seu <strong>celular</strong>.
										</div>
									</div>
								</div>

                <div class="row">
									<div class="col-md-4">
										<label for="email">Endereço completo</label>
										<input type="text" class="form-control" id="address" placeholder="" value="<?= isset($client['address']) ? $client['address'] : '' ?>">
										<div class="invalid-feedback">
											Por favor, informe seu <strong>endereço</strong>.
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

    <?php include_once "../../includes/templates/footer.php"; ?>
		<script src="js/form-validation.js?v=42"></script>
  </body>
</html>
