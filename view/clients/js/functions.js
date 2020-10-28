(function () {
    'use strict'
  
    window.addEventListener('load', function () {
      listClients()
    }, false)
}());

function listClients() {
    $.ajax({
        url: "ajax/Client.php",
        method: 'POST',
        data: {
            function: 'listClients',
        },
    }).done(function(res) {

        document.querySelector("div.table-responsive > table > tbody").innerHTML = res.html;
        deleteClient()

    }).fail(function(error) {
        console.log(error);
    });
}

function deleteClient() {

    var lista = document.querySelectorAll('.excluir')
    Array.from(lista).forEach((el) => {
        el.addEventListener('click', (e) => {
            client_id = el.getAttribute('client_id');

            confirm = confirm('Tem certeza que deseja excluir esse cliente?');
            if (confirm) {

                $.ajax({
                    url: "ajax/Client.php",
                    method: 'POST',
                    data: {
                        function: 'deleteClient',
                        args: { client_id: client_id }
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