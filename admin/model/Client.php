<?php

require __DIR__ . '/../includes/helpers/Connection.php'; 

class Client
{
    private $clientId;
    private $firstName;
    private $lastName;
    private $email;
    private $phonenumber;
    private $cellphone;
    private $birthdate;
    private $address;

    // CRUD Methods Section

    public function list()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query = "SELECT * FROM `{$db}`.Clients";

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

        $query = "SELECT * FROM `{$db}`.Clients $where";

        $res = $connection->run($query);

        return $res;
    }

    public function create()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query =
        "INSERT INTO `{$db}`.Clients (
            first_name,
            last_name,
            email,
            phonenumber,
            cellphone,
            birthdate,
            address
        ) VALUES (
            '{$this->firstName}',
            '{$this->lastName}',
            '{$this->email}',
            '{$this->phonenumber}',
            '{$this->cellphone}',
            '{$this->birthdate}',
            '{$this->address}'
        )";

        try {
            $connection->run($query);
            $res = [
                'error'   => false,
                'message' => "Cliente $this->firstName inserido com sucesso!",
                'details' => ''
            ];
        } catch (Exception $e) {
            $res = [
                'error'   => true,
                'message' => 'Erro ao inserir o cliente no banco de dados.',
                'details' => $e->errorMessage()
            ];
        }

        return $res;
    }

    public function update()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query =
        "UPDATE `{$db}`.Clients SET
            first_name = '$this->firstName',
            last_name = '$this->lastName',
            email = '$this->email',
            phonenumber = '$this->phonenumber',
            cellphone = '$this->cellphone',
            birthdate = '$this->birthdate',
            address = '$this->address'
        WHERE id = $this->clientId";

        $connection->run($query);

        return [
            'error'   => false,
            'message' => "Cliente $this->name atualizado com sucesso!",
        ];
    }

    public function delete()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query = "DELETE FROM `{$db}`.Clients WHERE id = $this->clientId";

        $connection->run($query);

        return [
            'error'   => false,
            'message' => "Cliente $this->name excluído com sucesso!",
            'details' => ''
        ];
    }

    // Getters and Setters Section

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

   public function getLastName()
   {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getCellphone()
    {
        return $this->cellphone;
    }

    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }

    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
