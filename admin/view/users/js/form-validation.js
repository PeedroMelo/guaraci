(function () {
  'use strict'

  window.addEventListener('load', function () {
    validatePasswordOnFocusOut()
    validateFields()
  }, false)
}());

function validatePasswordOnFocusOut() {
  document.getElementById('confirm-password').addEventListener('focusout', function (e) {
    var confirm_password = e.target;
    var password = document.getElementById('password');

    if (confirm_password.value == '' && password.value == '') return;

    return validatePassword(password, confirm_password);
  });
}

function validatePassword(password = '', confirm_password = '') {
  if (password == '') {
    password = document.getElementById('password');
  }
  if (confirm_password == '') {
    confirm_password = document.getElementById('confirm-password');
  }

  if (confirm_password.value !== password.value) {
    $('.invalid-password').show();
    confirm_password.classList.remove('valid-custom-input')
    confirm_password.classList.add('invalid-custom-input')
    return false;
  }
  $('.invalid-password').hide();
  confirm_password.classList.remove('invalid-custom-input')
  confirm_password.classList.add('valid-custom-input')
  return true;
}

function validateFields() {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation')
  // Loop over them and prevent submission
  Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      if (!form.checkValidity() || !validatePassword()) {
        event.stopPropagation()
      } else {
        saveData()
        return true;
      }
      form.classList.add('was-validated')
    }, false)
  })
  return false;
}

function saveData() {
  
  var user_id = document.getElementById('user_id').value;

  var args = {
    'user_id' : user_id,
    'email'   : document.getElementById('email').value,
    'password': document.getElementById('password').value,
  };

  if (user_id == '') {
    func = 'createUser'
  } else {
    func = 'updateUser'
  }

  $.ajax({
    url: "ajax/User.php",
    method: 'POST',
    async: false,
    data: {
      function: func,
      args: args
    },
  }).done(function(res) {

    alert(res.message);

    window.location.href = '../users/';
  }).fail(function(error) {
    alert('oi')
    console.log(error);
  });

}