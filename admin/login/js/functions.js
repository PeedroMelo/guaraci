(function () {
    'use strict'
  
    window.addEventListener('load', function () {
      login()
    }, false)
}());

function login() {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation')
  // Loop over them and prevent submission
  Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      if (!form.checkValidity()) {
        event.stopPropagation()
      } else {

        if (!autenticateUser()) {
          alert('[Falha de autenticação] Usuário inválido.')
          return false;
        }

        // Go to admin page
        window.location.href = '../view/products/';
        return true;
      }
      form.classList.add('was-validated')
    }, false)
  })
  return false;
}

function autenticateUser() {
  var autenticate = false;

  var args = {
    'email'    : document.getElementById('email').value,
    'password' : document.getElementById('password').value,
  };

  $.ajax({
    url: "ajax/login.php",
    method: 'POST',
    async: false,
    data: args,
  }).done(function(res) {
    autenticate = res.autenticate;
  }).fail(function(error) {
    console.log(error);
  });

  return autenticate;
}