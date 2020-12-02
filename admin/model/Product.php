<?php

require __DIR__ . '/../includes/helpers/Connection.php'; 

class Product
{
    private $productId;
    private $name;
    private $description;
    private $value;
    private $active;
    // private $image;

    // CRUD Methods Section

    public function list()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query = "SELECT * FROM `{$db}`.Products";

        $res = $connection->run($query);

        return $res;
    }

    public function find($filter)
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $where = [];
        foreach ($filter as $field => $value) {
            $where[] = "$field = '$value'";
        }
        $where = 'WHERE ' . implode(' AND ', $where);

        $query = "SELECT * FROM `{$db}`.Products $where";

        $res = $connection->run($query);

        return $res;
    }

    public function create()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query =
        "INSERT INTO `{$db}`.Products (
            name,
            description,
            active,
            value
        ) VALUES (
            '$this->name',
            '$this->description',
            $this->active,
            $this->value
        )";

        try {
            $connection->run($query);
            $res = [
                'error'   => false,
                'message' => "Produto $this->name inserido com sucesso!",
                'details' => ''
            ];
        } catch (Exception $e) {
            $res = [
                'error'   => true,
                'message' => 'Erro ao inserir o produto no banco de dados.',
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
        "UPDATE `{$db}`.Products SET
            name = '$this->name',
            description = '$this->description',
            value = $this->value,
            active = $this->active
        WHERE id = $this->productId";

        $connection->run($query);

        return [
            'error'   => false,
            'message' => "Produto $this->name atualizado com sucesso!",
        ];
    }

    public function delete()
    {
        $connection = new Connection();
        $db = $connection::DATABASE;

        $query = "DELETE FROM `{$db}`.Products WHERE id = $this->productId";

        $connection->run($query);

        return [
            'error'   => false,
            'message' => "Produto $this->name excluído com sucesso!",
            'details' => ''
        ];
    }

    // Getters and Setters Section

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
}