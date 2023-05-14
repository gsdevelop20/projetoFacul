console.log($("#password").val());
$(".btn").click(function(e){
    e.preventDefault();
    console.log($("#password").val());
  $.ajax({
    type: 'post',
    url: 'login.php',
    datatype: 'html',
    data: {
        email: $("#email").val(),
        password: $("#password").val()
     }
  }).done(function(data) {
    $("#r").append(data);
      console.log(data);
  })

});
