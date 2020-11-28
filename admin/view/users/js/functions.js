(function () {
    'use strict'
  
    window.addEventListener('load', function () {
      listUsers()
      findUser()
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

function findUser() {

    var user_email = document.getElementById('user-email');
    user_email.addEventListener('keypress', (e) => {
        if (e.which === 13) {
            
            var email = user_email.value;
            
            $.ajax({
                url: "ajax/User.php",
                method: 'POST',
                data: {
                    function: 'findUserByEmail',
                    args: { email: email }
                },
            }).done(function(res) {
        
                if (res.user_id === '') {
                    alert(res.message);
                    document.getElementById('user-email').value = '';
                    return false;
                }

                window.location.href = `./form.php?user_id=${res.user_id}`;
                return true;
        
            }).fail(function(error) {
                console.log(error);
            });
        }
    });
}