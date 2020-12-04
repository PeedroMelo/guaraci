<?php

require __DIR__ . '/../includes/helpers/Connection.php'; 

class User
{
    private $userId;
    private $name;
    private $email;
    private $password;

    // CRUD Methods Section

    public function list()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query = "SELECT * FROM `{$db}`.Users";

        $res = $connection->run($query);

        return $res;
    }

    public function find($filter)
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $where = [];
        foreach ($filter as $field => $value) {
            $value = trim($value);
            $where[] = "$field = '$value'";
        }
        $where = 'WHERE ' . implode(' AND ', $where);

        $query = "SELECT * FROM `{$db}`.Users $where";

        $res = $connection->run($query);

        return $res;
    }

    public function create()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query =
        "INSERT INTO `{$db}`.Users (
            name,
            email,
            password
        ) VALUES (
            '$this->name',
            '$this->email',
            '$this->password'
        )";

        try {
            $connection->run($query);
            $res = [
                'error'   => false,
                'message' => "Usuário $this->name inserido com sucesso!",
                'details' => ''
            ];
        } catch (Exception $e) {
            $res = [
                'error'   => true,
                'message' => 'Erro ao inserir o usuário no banco de dados.',
                'details' => $e->errorMessage()
            ];
        }

        return $res;
    }

    public function update()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query = "UPDATE `{$db}`.Users SET name = '$this->name', email = '$this->email', password = '$this->password' WHERE id = $this->userId";

        $connection->run($query);

        return [
            'error'   => false,
            'message' => "Usuário $this->name atualizado com sucesso!",
        ];
    }

    public function delete()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query = "DELETE FROM `{$db}`.Users WHERE id = $this->userId";

        $connection->run($query);

        return [
            'error'   => false,
            'message' => "Usuário $this->name excluído com sucesso!",
            'details' => ''
        ];
    }

    // Getters and Setters Section

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}