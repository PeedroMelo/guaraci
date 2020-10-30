<?php
  require '../../includes/classes/Autentication.php';
  $auth = new Autentication();
  $auth->autenticateSession();

  $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
  $user = $_SESSION['fakeDB']['Users'][$user_id];
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Usuários | Guaraci Soluções Energéticas BR</title>

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

    <input type="hidden" id="user_id" value="<?= $user_id <> '' ? $user_id : '' ?>">

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
            <h1 class="h2">Usuários</h1>
          </div>

          <div class="row">
            <div class="col-md-12 order-md-1">
							<form class="needs-validation" novalidate>
								<div class="row">
									<div class="col-md-4">
										<label for="email">E-mail</label>
										<input type="text" class="form-control" id="email" placeholder="" value="<?= isset($user['email']) ? $user['email'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe seu <strong>email</strong>.
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4 mb-3">
										<label for="password">Senha </label>
										<input type="password" class="form-control" id="password" placeholder="" value="<?= isset($user['password']) ? $user['password'] : '' ?>" required>
										<div class="invalid-feedback">
											Por favor, informe sua <strong>senha</strong>.
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4 mb-3">
										<label for="confirm-password">Confirmação da Senha </label>
										<input type="password" class="form-control" id="confirm-password" placeholder="" required>
										<div class="invalid-feedback">
											Por favor, confirme sua <strong>senha</strong>.
										</div>
										<div class="invalid-password" style='display: none;'>
											Senhas não conferem.
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
		<script src="js/form-validation.js?v=3"></script>
  </body>
</html>
