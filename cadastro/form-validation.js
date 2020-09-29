(function () {
  'use strict'

  window.addEventListener('load', function () {
    formatBirthDate()
    formatMobile()
    formatPhoneNumber()
    validateEmailOnFocusOut()
    validatePasswordOnFocusOut()
    validateFields()
  }, false)
}());

function formatBirthDate() {
  document.getElementById('birthdate').addEventListener('keypress', function (e) {
    if(e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }
    var len = document.getElementById('birthdate').value.length;

    if(len !== 1 || len !== 3) {
      if(e.keyCode == 47) {
        e.preventDefault();
      }
    }

    if(len === 2) {
      document.getElementById('birthdate').value += '/';
    }

    if(len === 5) {
      document.getElementById('birthdate').value += '/';
    }
  })
}

function formatPhoneNumber() {
  document.getElementById('phonenumber').addEventListener('keypress', function (e) {
    if(e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }
    var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{4})(\d{4})/);
    e.target.value = '(' + x[1] + ') ' + x[2] + '-' + x[3];
  })
}

function formatMobile() {
  document.getElementById('mobile').addEventListener('keypress', function (e) {
    if(e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }
    var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{5})(\d{4})/);
    e.target.value = '(' + x[1] + ') ' + x[2] + '-' + x[3];
  })
}

function validateEmailOnFocusOut() {
  document.getElementById('confirm-email').addEventListener('focusout', function (e) {
    var confirm_email = e.target;
    var email = document.getElementById('email');

    if (confirm_email.value == '' && email.value == '') return;

    return validateEmail(email, confirm_email);
  });
}

function validatePasswordOnFocusOut() {
  document.getElementById('confirm-password').addEventListener('focusout', function (e) {
    var confirm_password = e.target;
    var password = document.getElementById('password');

    if (confirm_password.value == '' && password.value == '') return;

    return validatePassword(password, confirm_password);
  });
}

function validateEmail(email = '', confirm_email = '') {
  if (email == '') {
    email = document.getElementById('email');
  }
  if (confirm_email == '') {
    confirm_email = document.getElementById('confirm-email');
  }

  if (confirm_email.value !== email.value) {
    $('.invalid-email').show();
    confirm_email.classList.remove('valid-custom-input')
    confirm_email.classList.add('invalid-custom-input')
    return false;
  }
  $('.invalid-email').hide();
  confirm_email.classList.remove('invalid-custom-input')
  confirm_email.classList.add('valid-custom-input')
  return true;
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

      if (!form.checkValidity() || !validatePassword() || !validateEmail()) {
        event.stopPropagation()
      } else {
        cadastrarUsuario()
        return true;
      }
      form.classList.add('was-validated')
    }, false)
  })
  return false;
}

function cadastrarUsuario() {

  var nome      = document.getElementById('firstName').value;
  var sobrenome = document.getElementById('lastName').value;
  var email     = document.getElementById('email').value;
  var birthdate = document.getElementById('birthdate').value;
  var gender    = document.getElementById('gender').value;
  var phonenumber = document.getElementById('phonenumber').value;
  var mobile  = document.getElementById('mobile').value;
  var address   = document.getElementById('address').value;

  document.querySelector('#success .firstname').innerHTML = nome;
  document.querySelector('#success .lastname').innerHTML  = sobrenome;
  document.querySelector('#success .email').innerHTML     = email;
  document.querySelector('#success .birthdate').innerHTML = birthdate;
  document.querySelector('#success .gender').innerHTML    = gender;
  document.querySelector('#success .phonenumber').innerHTML = phonenumber;
  document.querySelector('#success .mobile').innerHTML  = mobile;
  document.querySelector('#success .address').innerHTML   = address;

  document.getElementById('success').style.display = 'block';
  document.getElementById('sign-in-form').style.display = 'none';
}