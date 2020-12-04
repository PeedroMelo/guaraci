(function () {
  'use strict'

  window.addEventListener('load', function () {
    formatBirthDate()
    formatMobile()
    formatPhoneNumber()
    validateFields()
  }, false)
}());

function validateFields() {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation')
  // Loop over them and prevent submission
  Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      if (!form.checkValidity()) {
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
  document.getElementById('cellphone').addEventListener('keypress', function (e) {
    if(e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }
    var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{5})(\d{4})/);
    e.target.value = '(' + x[1] + ') ' + x[2] + '-' + x[3];
  })
}

function saveData() {
  
  var client_id = document.getElementById('client_id').value;

  var args = {
    'client_id'  : client_id,
    'first_name' : document.getElementById('first_name').value,
    'last_name'  : document.getElementById('last_name').value,
    'email'      : document.getElementById('email').value,
    'birthdate'  : document.getElementById('birthdate').value,
    'phonenumber': document.getElementById('phonenumber').value,
    'cellphone'  : document.getElementById('cellphone').value,
    'address'    : document.getElementById('address').value,
  };

  if (client_id == '') {
    func = 'createClient'
  } else {
    func = 'updateClient'
  }

  $.ajax({
    url: "ajax_router.php",
    method: 'POST',
    async: false,
    data: {
      function: func,
      args: args
    },
  }).done(function(res) {

    alert(res.message);

    window.location.href = '../clients/';
  }).fail(function(error) {
    console.log(error);
  });

}