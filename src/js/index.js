console.log($("#password").val());
$(".btn").click(function(){

  $.ajax({
    type: 'post',
    url: 'index.php',
    data:{
        'note': $("#textarea").val(),
        'title':$("#title").val(),
    },

      error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus)
      }
  }).done(function(data) {
    $("#r").append(data);
      console.log(data);
  })

});

$("#more").click(function(){

    $.ajax({
        type: 'post',
        url: 'index.php',
        data:{
            'more': 'create'
        },

        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus)
        }
    }).done(function(data) {
        $("#r").append(data);
        console.log(data);
    })

});
