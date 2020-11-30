(function () {
  'use strict'

  window.addEventListener('load', function () {
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

function saveData() {
  
  var client_id = document.getElementById('client_id').value;

  var args = {
    'client_id': client_id,
    'name'     : document.getElementById('name').value,
    'email'    : document.getElementById('email').value,
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
    alert('oi')
    console.log(error);
  });

}