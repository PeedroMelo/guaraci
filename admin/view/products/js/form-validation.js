(function () {
  'use strict'

  window.addEventListener('load', function () {
    validateFields()
  }, false)
}());

function formatPrice() {
  document.getElementById('price').addEventListener('keypress', function (e) {
    if(e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }
    var price = document.getElementById('price');
    var valor = price.value;
    
    valor = valor + '';
    valor = parseInt(valor.replace(/[\D]+/g,''));
    valor = valor + '';
    valor = valor.replace(/([0-9]{2})$/g, ",$1");
  
    if (valor.length > 6) {
      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }
  
    price.value = valor;
  })
}

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
  
  var product_id = document.getElementById('product_id').value;

  var args = {
    'product_id': product_id,
    'name'      : document.getElementById('name').value,
    'price'     : document.getElementById('price').value,
  };

  if (product_id == '') {
    func = 'createProduct'
  } else {
    func = 'updateProduct'
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

    window.location.href = '../products/';
  }).fail(function(error) {
    console.log(error);
  });

}