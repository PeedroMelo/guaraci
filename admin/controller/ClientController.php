<?php

require __DIR__ . '/../model/Client.php';

class ClientController
{
    public function listClients()
    {
        $client = new Client();
        $clients = $client->list();

        foreach ($clients as $client) {
            $html .=
            "<tr client_id='$client[id]'>
                <td>#$client[id]</td>
                <td>$client[first_name] $client[last_name]</td>
                <td>$client[email]</td>
                <td style='width: 200px; display: flex;'>
                    <a href='form.php?client_id=$client[id]' style='text_decoration: none;'>
                        <button class='btn btn-sm btn-success' type='button' style='display: flex; margin-right: 5px;'>
                        Editar
                        </button>
                    </a>

                    <button client_id='$client[id]' class='btn btn-sm btn-danger excluir' type='button' style='display: flex;'>
                        Excluir
                    </button>
                </td>
            </tr>";
        }

        return [
            'html' => isset($html) ? $html : '',
        ];
    }

    public function findClientById($data)
    {
        $client = new Client();
        $res = $client->find([
            'id' => $data['client_id']
        ]);

        return $res;
    }

    public function findClientByNameOrEmail($data)
    {
        $client = new Client();
        $res = $client->find([
            'email' => $data['email']
        ]);

        return $res[0];
    }

    public function createClient($data)
    {
        $client = new Client();

        $nascimento = new DateTime($data['birthdate']);
        $nascimento = $nascimento->format('Y-m-d');
        
        $client->setFirstName($data['first_name']);
        $client->setLastName($data['last_name']);
        $client->setEmail($data['email']);
        $client->setBirthdate($nascimento);
        $client->setPhonenumber($data['phonenumber']);
        $client->setCellphone($data['cellphone']);
        $client->setAddress($data['address']);

        $res = $client->create();

        return $res;
    }

    public function updateClient($data)
    {
        $client = new Client();

        $nascimento = new DateTime($data['birthdate']);
        $nascimento = $nascimento->format('Y-m-d');

        $client->setClientId($data['client_id']);

        $client->setFirstName($data['first_name']);
        $client->setLastName($data['last_name']);
        $client->setEmail($data['email']);
        $client->setBirthdate($nascimento);
        $client->setPhonenumber($data['phonenumber']);
        $client->setCellphone($data['cellphone']);
        $client->setAddress($data['address']);

        $res = $client->update();

        return $res;
    }

    public function deleteClient($data)
    {
        $client = new Client();
        $client->setClientId($data['client_id']);
        $client->setFirstName($data['first_name']);

        $res = $client->delete();

        return $res;
    }
}