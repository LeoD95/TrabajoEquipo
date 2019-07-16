function llenarPanel() {
  // console.log("Se debe de llenar las etiquetas");
  $.ajax({
    url: "../inicio/panel.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
        ocultarSec();
      $("#panel").html(respuesta);
      $("#panel").hide();
      $("#panel").fadeIn("slow");
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}

function llenarMisDatos() {
  // console.log("Se debe de llenar las etiquetas");
  $.ajax({
    url: "../inicio/misDatos.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
        ocultarSec();
      $("#misDatos").html(respuesta);
      $("#misDatos").hide();
      $("#misDatos").fadeIn("slow");
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}

function llenarFoto() {
  // console.log("Se debe de llenar las etiquetas");
  $.ajax({
    url: "../inicio/miFoto.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
        ocultarSec();
      $("#miFoto").html(respuesta);
      $("#miFoto").hide();
      $("#miFoto").fadeIn("slow");
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}

function ocultarSec(){
    $("#panel").hide();
    $("#misDatos").hide();
    $("#miFoto").hide();
}

function QuitarClass(){
  $("#linkMisDatos").removeClass("activo");
  $("#linkPanel").removeClass("activo");
  $("#linkMifoto").removeClass("activo");
}

$("#linkMisDatos").on("click", function() {
  llenarMisDatos();
  QuitarClass();
  $("#linkMisDatos").addClass("activo");
});

$("#linkPanel").on("click", function() {
  llenarPanel();
  QuitarClass();
  $("#linkPanel").addClass("activo");
});

$("#linkMifoto").on("click", function() {
  llenarFoto();
  QuitarClass();
  $("#linkMifoto").addClass("activo");
});
