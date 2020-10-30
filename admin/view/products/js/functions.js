(function () {
    'use strict'
  
    window.addEventListener('load', function () {
      listProducts()
      findProduct()
    }, false)
}());

function listProducts() {
    $.ajax({
        url: "ajax/Product.php",
        method: 'POST',
        data: {
            function: 'listProducts',
        },
    }).done(function(res) {

        document.querySelector("div.table-responsive > table > tbody").innerHTML = res.html;
        deleteProduct()

    }).fail(function(error) {
        console.log(error);
    });
}

function deleteProduct() {

    var lista = document.querySelectorAll('.excluir')
    Array.from(lista).forEach((el) => {
        el.addEventListener('click', (e) => {
            product_id = el.getAttribute('product_id');

            confirm = confirm('Tem certeza que deseja excluir esse usuário?');
            if (confirm) {

                $.ajax({
                    url: "ajax/Product.php",
                    method: 'POST',
                    data: {
                        function: 'deleteProduct',
                        args: { product_id: product_id }
                    },
                }).done(function(res) {

                    alert(res.message)
                    location.reload();
            
                }).fail(function(error) {
                    console.log(error);
                });
            }
        })
    });
}

function findProduct() {

    var product_name = document.getElementById('product');
    product_name.addEventListener('keypress', (e) => {
        if (e.which === 13) {
            
            var product = product_name.value;
            
            $.ajax({
                url: "ajax/Product.php",
                method: 'POST',
                data: {
                    function: 'findProductByName',
                    args: { product: product }
                },
            }).done(function(res) {
        
                if (res.product_id === '') {
                    alert(res.message);
                    document.getElementById('product').value = '';
                    return false;
                }

                window.location.href = `./form.php?product_id=${res.product_id}`;
                return true;
        
            }).fail(function(error) {
                console.log(error);
            });
        }
    });
}