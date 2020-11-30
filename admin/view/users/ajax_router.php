<?php

require __DIR__ . '/../../controller/UserController.php';

header('Content-type: application/json;');

$function = isset($_POST['function']) ? $_POST['function'] : '';
$args     = isset($_POST['args'])     ? $_POST['args']     : '';

$user = new UserController();
echo json_encode($user->{$function}($args));

?>