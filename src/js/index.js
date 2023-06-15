console.log($("#password").val());
$(".save2").click(function(){

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
            'more': 1,
        },

        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus)
        }
    }).done(function(data) {
        $("#r").append(data);
        console.log(data);
    })
});

    $(".create").click(function(){

        $.ajax({
            type: 'post',
            url: 'index.php',
            data:{
                'notes': $("#textarea1").val(),
                'titles':$("#title1").val(),
            },

            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
            }
        }).done(function(data) {
            $("#r").append(data);
            console.log(data);
        })
       // window.location.href = '../../index.php';
    });

$( document ).ready(function() {
    console.log("ready!");

    $.ajax({
        type: 'post',
        url: 'ajax.php',
        data:{
            'oi':'oi'
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus)
        }
    }).done(function (data) {
        $("#r").append(data);
        console.log('oi');
    })
})