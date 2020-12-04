<?php

require __DIR__ . '/../../controller/ClientController.php';

header('Content-type: application/json;');

$function = isset($_POST['function']) ? $_POST['function'] : '';
$args     = isset($_POST['args'])     ? $_POST['args']     : '';

$client = new ClientController();
echo json_encode($client->{$function}($args));

?>