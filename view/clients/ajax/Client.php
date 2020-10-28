<?php
    header('Content-type: application/json;');

    session_start();

    $function = isset($_POST['function']) ? $_POST['function'] : '';
    $args     = isset($_POST['args'])     ? $_POST['args']     : '';

    $client = new Client();
    echo json_encode($client->{$function}($args));

    class Client
    {
        public $clientList;

        function __construct()
        {
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

        public function findClientByName($data)
        {
            foreach ($this->clientList as $client_id => $client) {
                if ($this->clientList[$client_id]['name'] == $data['name'])
                    return [
                        'client_id' => $client_id,
                        'message' => ''
                    ];
            }

            return [
                'client_id' => '',
                'message' => "Nenhum usuário encontrado com o nome $data[name]"
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
?>