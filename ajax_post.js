var parametros = {
    "dato1" : "text1",
    "dato2" : "texto2"
};

$.ajax({
  data:  parametros,
  url:   'ajax.php',
  type:  'post',
  beforeSend: function () {
    $("#message").html("Processing...");
  },
  success:  function (response) {
    $("#repuesta").html(response);
  }
});
