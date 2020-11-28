<?php

class Autentication
{
    public function autenticateSession()
    {
        $server_name = $_SERVER['SERVER_NAME'];
        $root_dir = explode('/', $_SERVER['REQUEST_URI'])[1];

        session_start();

        if (count($_SESSION['session_users']) == 0) {
            header("Location: http://$server_name/$root_dir/admin/login");
        }
    }
}
?>
