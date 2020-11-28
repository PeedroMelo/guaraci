<?php
    header('Content-type: application/json;');

    session_start();

    $function = isset($_POST['function']) ? $_POST['function'] : '';
    $args     = isset($_POST['args'])     ? $_POST['args']     : '';

    $product = new Product();
    echo json_encode($product->{$function}($args));

    class Product
    {
        public $productsList;

        function __construct()
        {
            $this->productsList = $_SESSION['fakeDB']['Products'];
        }

        public function listProducts()
        {
            $html = '';
            foreach ($this->productsList as $product_id => $product) {
                $html .=
                "<tr user_id='$product_id'>
                    <td>$product_id</td>
                    <td>$product[name]</td>
                    <td>R$ $product[price]</td>
                    <td style='width: 200px; display: flex;'>
                        <a href='form.php?product_id=$product_id' style='text_decoration: none;'>
                            <button class='btn btn-sm btn-success' type='button' style='display: flex; margin-right: 5px;'>
                            <!-- <span data-feather='edit' style='margin-right: 5px;'></span> -->
                            Editar
                            </button>
                        </a>

                        <button product_id='$product_id' class='btn btn-sm btn-danger excluir' type='button' style='display: flex;'>
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

        public function findProductByName($data)
        {
            foreach ($this->productsList as $product_id => $product) {
                if ($this->productsList[$product_id]['name'] == $data['product'])
                    return [
                        'product_id' => $product_id,
                        'message' => ''
                    ];
            }

            return [
                'product_id' => '',
                'message' => "Nenhum produto encontrado com o nome $data[product]"
            ];
        }

        public function createProduct($data)
        {
            foreach ($this->productsList as $product_id => $product) {
                if ($this->productsList[$product_id]['name'] == $data['name'])
                    return [
                        'message' => "$data[name] já existe na base!"
                    ];
            }

            $id = rand();
            $_SESSION['fakeDB']['Products'][$id] = [
                'name'  => $data['name'],
                'price' => $data['price'],
            ];

            return [
                'message' => "$data[name] cadastrado com sucesso!"
            ];
        }

        public function updateProduct($data)
        {
            if ($this->productList[$data['product_id']]['name'] <> $data['name']) {
                $_SESSION['fakeDB']['Products'][$data['product_id']]['name'] = $data['name'];
            }

            if ($this->productList[$data['product_id']]['price'] <> $data['price']) {
                $_SESSION['fakeDB']['Products'][$data['product_id']]['price'] = $data['price'];
            }

            return [
                'message' => 'Dados atualizados com sucesso!',
                'details' => [
                    'product_id' => $data['product_id'],
                    'name'       => $data['name'],
                    'price'      => $data['price'],
                ]
            ];
        }

        public function deleteProduct($data)
        {
            unset($_SESSION['fakeDB']['Products'][$data['product_id']]);

            return [
                'message' => 'Produto excluído com sucesso',
            ];
        }
    }
?>