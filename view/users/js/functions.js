(function () {
    'use strict'
  
    window.addEventListener('load', function () {
      listUsers()
    }, false)
}());

function listUsers() {
    $.ajax({
        url: "ajax/User.php",
        method: 'POST',
        data: {
            function: 'listUsers',
        },
    }).done(function(res) {

        document.querySelector("div.table-responsive > table > tbody").innerHTML = res.html;
        deleteUser()

    }).fail(function(error) {
        console.log(error);
    });
}

function deleteUser() {

    var lista = document.querySelectorAll('.excluir')
    Array.from(lista).forEach((el) => {
        el.addEventListener('click', (e) => {
            user_id = el.getAttribute('user_id');

            confirm = confirm('Tem certeza que deseja excluir esse usuário?');
            if (confirm) {

                $.ajax({
                    url: "ajax/User.php",
                    method: 'POST',
                    data: {
                        function: 'deleteUser',
                        args: { user_id: user_id }
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