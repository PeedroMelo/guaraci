<?php

require __DIR__ . '/../model/Product.php';

class ProductController
{
    public function listProducts()
    {
        $product = new Product();
        $products = $product->list();

        foreach ($products as $product) {
            $html .=
            "<tr user_id='$product[id]'>
                <td>#$product[id]</td>
                <td>$product[name]</td>
                <td>R$ $product[value]</td>
                <td style='width: 200px; display: flex;'>
                    <a href='form.php?product_id=$product[id]' style='text_decoration: none;'>
                        <button class='btn btn-sm btn-success' type='button' style='display: flex; margin-right: 5px;'>
                        <!-- <span data-feather='edit' style='margin-right: 5px;'></span> -->
                        Editar
                        </button>
                    </a>

                    <button product_id='$product[id]' class='btn btn-sm btn-danger excluir' type='button' style='display: flex;'>
                        <!-- <span data-feather='trash' style='margin-right: 5px;'></span> -->
                        Excluir
                    </button>
                </td>
            </tr>";
        }

        return [
            'html' => isset($html) ? $html : '',
        ];
    }

    public function findProductById($data)
    {
        $product = new Product();
        $res = $product->find([
            'id' => $data['product_id']
        ]);

        return $res;
    }

    public function findProductByName($data)
    {
        $product = new Product();
        $res = $product->find([
            'name' => $data['name']
        ]);

        if (count($res) == 0) {
            return [
                'product_id' => '',
                'message' => "Nenhum produto encontrado com o nome: $data[name]"
            ];
        }

        return [
            'product_id' => $res[0]['id'],
            'message' => ''
        ];
    }

    public function createProduct($data)
    {
        $product = new Product();

        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setValue($data['value']);
        $product->setActive($data['active']);

        $res = $product->create();

        return $res;
    }

    public function updateProduct($data)
    {
        $product = new Product();

        $product->setProductId($data['product_id']);

        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setValue($data['value']);
        $product->setActive($data['active']);

        $res = $product->update();

        return $res;
    }

    public function deleteProduct($data)
    {
        $product = new Product();
        $product->setProductId($data['product_id']);
        $product->setName($data['name']);

        $res = $product->delete();

        return $res;
    }
}

?>