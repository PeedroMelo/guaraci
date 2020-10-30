<?php
    header('Content-type: application/json;');

    session_start();

    $function = isset($_POST['function']) ? $_POST['function'] : '';
    $args     = isset($_POST['args'])     ? $_POST['args']     : '';

    $user = new User();
    echo json_encode($user->{$function}($args));

    class User
    {
        public $userList;

        function __construct()
        {
            $this->userList = $_SESSION['fakeDB']['Users'];
        }

        public function listUsers()
        {
            $html = '';
            foreach ($this->userList as $user_id => $user) {
                $html .=
                "<tr user_id='$user_id'>
                    <td>$user_id</td>
                    <td>$user[email]</td>
                    <td style='width: 200px; display: flex;'>
                        <a href='form.php?user_id=$user_id' style='text_decoration: none;'>
                            <button class='btn btn-sm btn-success' type='button' style='display: flex; margin-right: 5px;'>
                            <!-- <span data-feather='edit' style='margin-right: 5px;'></span> -->
                            Editar
                            </button>
                        </a>

                        <button user_id='$user_id' class='btn btn-sm btn-danger excluir' type='button' style='display: flex;'>
                            <!-- <span data-feather='trash' style='margin-right: 5px;'></span> -->
                            Excluir
                        </button>
                    </td>
                </tr>";
            }

            return [
                'html' => $html
            ];
        }

        public function findUserByEmail($data)
        {
            foreach ($this->userList as $user_id => $user) {
                if ($this->userList[$user_id]['email'] == $data['email'])
                    return [
                        'user_id' => $user_id,
                        'message' => ''
                    ];
            }

            return [
                'user_id' => '',
                'message' => "Nenhum usuário encontrado com o email $data[email]"
            ];
        }

        public function createUser($data)
        {
            foreach ($this->userList as $user_id => $user) {
                if ($this->userList[$user_id]['email'] == $data['email'])
                    return [
                        'message' => "$data[email] já existe na base!"
                    ];
            }

            $id = rand();
            $_SESSION['fakeDB']['Users'][$id] = [
                'email' => $data['email'],
                'password' => $data['password'],
            ];

            return [
                'message' => "$data[email] cadastrado com sucesso!"
            ];
        }

        public function updateUser($data)
        {
            if ($this->userList[$data['user_id']]['email'] <> $data['email']) {
                $_SESSION['fakeDB']['Users'][$data['user_id']]['email'] = $data['email'];
            }

            if ($this->userList[$data['user_id']]['password'] <> $data['password']) {
                $_SESSION['fakeDB']['Users'][$data['user_id']]['password'] = $data['password'];
            }

            return [
                'message' => 'Dados atualizados com sucesso!',
                'details' => [
                    'user_id'  => $data['user_id'],
                    'email'    => $data['email'],
                ]
            ];
        }

        public function deleteUser($data)
        {
            if ($_SESSION['fakeDB']['Users'][$data['user_id']]['email'] == 'admin@gmail.com') {
                return [
                    'message' => 'Impossível excluir o e-mail padrão',
                ];
            }

            unset($_SESSION['fakeDB']['Users'][$data['user_id']]);

            return [
                'message' => 'Usuário excluído com sucesso',
            ];
        }
    }
?>