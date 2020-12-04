<?php

require __DIR__ . '/../../controller/ProductController.php';

header('Content-type: application/json;');

$function = isset($_POST['function']) ? $_POST['function'] : '';
$args     = isset($_POST['args'])     ? $_POST['args']     : '';

$product = new ProductController();
echo json_encode($product->{$function}($args));

?>