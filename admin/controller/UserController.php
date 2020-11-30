<?php

require __DIR__ . '/../model/User.php';

class UserController
{
    public $userList;

    function __construct()
    {
        session_start();
        $this->userList = $_SESSION['fakeDB']['Users'];
    }

    public function listUsers()
    {
        $user = new User();
        $users = $user->list();

        foreach ($users as $user) {
            $html .=
            "<tr user_id='$user[id]'>
                <td>#$user[id]</td>
                <td>$user[name]</td>
                <td>$user[email]</td>
                <td style='width: 200px; display: flex;'>
                    <a href='form.php?user_id=$user[id]' style='text_decoration: none;'>
                        <button class='btn btn-sm btn-success' type='button' style='display: flex; margin-right: 5px;'>
                        Editar
                        </button>
                    </a>

                    <button user_id='$user[id]' class='btn btn-sm btn-danger excluir' type='button' style='display: flex;'>
                        Excluir
                    </button>
                </td>
            </tr>";
        }

        return [
            'html' => isset($html) ? $html : '',
        ];
    }

    public function findUserById($data)
    {
        $user = new User();
        $res = $user->find([
            'id' => $data['user_id']
        ]);

        return $res;
    }

    public function findUserByEmail($data)
    {
        $user = new User();
        $res = $user->find([
            'email' => $data['email']
        ]);

        if (count($res) == 0) {
            return [
                'user_id' => '',
                'message' => "Nenhum usuário encontrado com o email $data[email]"
            ];
        }

        return [
            'user_id' => $res[0]['id'],
            'message' => ''
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

        $user = new User();

        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $res = $user->create();

        return $res;
    }

    public function updateUser($data)
    {
        $user = new User();

        $user->setUserId($data['user_id']);

        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $res = $user->update();

        return $res;
    }

    public function deleteUser($data)
    {
        $user = new User();
        $user->setUserId($data['user_id']);

        $res = $user->delete();

        return $res;
    }
}