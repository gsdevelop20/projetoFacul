$(".btn").click(function(){
  $.ajax({
    type: 'post',
    url: 'data.php',
    datatype: 'html',
    data: {
        num1: $("#i1").val(), 
        num2: $("#i2").val()
     }
  }).done(function(data) {
    $("#r").append(data); 

  })

});