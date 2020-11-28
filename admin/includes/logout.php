<?php
  $server_name = $_SERVER['SERVER_NAME'];
  $root_dir = explode('/', $_SERVER['REQUEST_URI'])[1];

  // Cleaning session
  session_start();

  $_SESSION['session_users'] = [];

  // Come back to login page
  header("Location: http://$server_name/$root_dir/admin/login");
?>