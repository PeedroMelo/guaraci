<?php

require __DIR__ . '/../includes/helpers/Connection.php';

class ClientController
{
    public $clientList;

    function __construct()
    {
        session_start();
        $this->clientList = $_SESSION['fakeDB']['Clients'];
    }

    public function listClients()
    {
        $html = '';
        foreach ($this->clientList as $client_id => $client) {
            $html .=
            "<tr client_id='$client_id'>
                <td>$client_id</td>
                <td>$client[name]</td>
                <td>$client[email]</td>
                <td style='width: 200px; display: flex;'>
                    <a href='form.php?client_id=$client_id' style='text_decoration: none;'>
                        <button class='btn btn-sm btn-success' type='button' style='display: flex; margin-right: 5px;'>
                        <!-- <span data-feather='edit' style='margin-right: 5px;'></span> -->
                        Editar
                        </button>
                    </a>

                    <button client_id='$client_id' class='btn btn-sm btn-danger excluir' type='button' style='display: flex;'>
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

    public function findClientByNameOrEmail($data)
    {
        foreach ($this->clientList as $client_id => $client) {
            if ($this->clientList[$client_id]['name'] == $data['name_email'] ||
                $this->clientList[$client_id]['email'] == $data['name_email'])
                return [
                    'client_id' => $client_id,
                    'message' => ''
                ];
        }

        return [
            'client_id' => '',
            'message' => "Nenhum cliente encontrado com o dado $data[name_email]"
        ];
    }

    public function createClient($data)
    {
        foreach ($this->clientList as $client_id => $client) {
            if ($this->clientList[$client_id]['email'] == $data['email'])
                return [
                    'message' => "$data[email] já existe na base!"
                ];
        }

        $id = rand();
        $_SESSION['fakeDB']['Clients'][$id] = [
            'name'  => $data['name'],
            'email' => $data['email'],
        ];

        return [
            'message' => "Cliente cadastrado com sucesso!"
        ];
    }

    public function updateClient($data)
    {
        if ($this->clientList[$data['client_id']]['name'] <> $data['name']) {
            $_SESSION['fakeDB']['Clients'][$data['client_id']]['name'] = $data['name'];
        }

        if ($this->clientList[$data['client_id']]['email'] <> $data['email']) {
            $_SESSION['fakeDB']['Clients'][$data['client_id']]['email'] = $data['email'];
        }

        return [
            'message' => 'Dados atualizados com sucesso!',
            'details' => [
                'client_id'  => $data['client_id'],
                'name'    => $data['name'],
                'email'    => $data['email'],
            ]
        ];
    }

    public function deleteClient($data)
    {
        unset($_SESSION['fakeDB']['Clients'][$data['client_id']]);

        return [
            'message' => 'Cliente excluído com sucesso',
        ];
    }
}