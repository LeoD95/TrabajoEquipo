function llenar_lista(){
     // console.log("Se ha llenado lista");
    // preCarga(1000,4);
    $.ajax({
        url:"llenarLista.php",
        type:"POST",
        dateType:"html",
        data:{},
        success:function(respuesta){
            $("#lista").html(respuesta);
            $("#lista").slideDown("fast");
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    });	
}
function combo_personas(){
    $.ajax({
        url : 'combo_personas.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_persona").empty();
            $("#nombre_persona").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function combo_personasE(idPersona){
    // alert(idRepre);
    $.ajax({
        url : 'combo_personasE.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_personaE").empty();
            $("#nombre_personaE").html(respuesta);
            $("#nombre_personaE").val(idPersona);
            $("#nombre_personaE").select2();       
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function combo_especialidades(){
    $.ajax({
        url : 'combo_especialidades.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_especialidad").empty();
            $("#nombre_especialidad").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function combo_especialidadesE(id_especialidad){
    $.ajax({
        url : 'combo_especialidades.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_especialidadE").empty();
            $("#nombre_especialidadE").html(respuesta);
            $("#nombre_especialidadE").val(id_especialidad);
            $("#nombre_especialidadE").select2();     
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function combo_consultorios(){
    $.ajax({
        url : 'combo_consultorios.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_consultorio").empty();
            $("#nombre_consultorio").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function combo_consultoriosE(id_consultorio){
    $.ajax({
        url : 'combo_consultorios.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_consultorioE").empty();
            $("#nombre_consultorioE").html(respuesta);
            $("#nombre_consultorioE").val(id_consultorio);
            $("#nombre_consultorioE").select2();         
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

function ver_alta(){
    // preCarga(800,4);
    $("#frmAlta")[0].reset();
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#nombre").focus();
}

function ver_lista(){
    $("#alta").slideUp('low');
    $("#lista").slideDown('low');
}

$('#btnLista').on('click',function(){
    llenar_lista();
    ver_lista();
});

$("#frmAlta").submit(function(e){
    var f = $(this);
    var formData = new FormData(document.getElementById("frmAlta"));
    formData.append("dato", "valor");
    //formData.append(f.attr("name"), $(this)[0].files[0]);
    $.ajax({
      type: "POST",
      url: 'guardar.php',
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      if (res == "ok"){
        alertify.success("Registros Guardados Correctamente");
      }
      else if(res == "duplicado"){
        alertify.error("Ya Existe un Registro");
      }
      else{
        alertify.error("Ha Ocurrido un Error");
      }
    });
    // Evitar ejecutar el submit del formulario.
    return false;
});

function abrirModalEditar(idDoctor,id_persona,id_especialidad,cedula,id_consultorio){
   
    $("#frmActuliza")[0].reset();

    $("#idE").val(idDoctor);
    combo_personasE(id_persona);
    combo_especialidadesE(id_especialidad);
    combo_consultoriosE(id_consultorio);

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#nombre_personaE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var f = $(this);
    var formData = new FormData(document.getElementById("frmActuliza"));
    formData.append("dato", "valor");
    //formData.append(f.attr("name"), $(this)[0].files[0]);
    $.ajax({
      type: "POST",
      url: 'actualizar.php',
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      if (res == "ok"){
        alertify.set('notifier','position', 'bottom-right');
        alertify.success('Se ha actualizado el registro' );
        $("#frmActuliza")[0].reset();
        $("#modalEditar").modal("hide");
        llenar_lista();
      }
      else if(res == "duplicado"){
        alertify.error("Ya Existe un Registro");
      }
      else{
        alertify.error("Ha Ocurrido un Error");
      }
    });
    // Evitar ejecutar el submit del formulario.
    return false;
});

function status(concecutivo,id){
    var nomToggle = "#interruptor"+concecutivo;
    var nomBoton  = "#boton"+concecutivo;
    var numero    = "#tConsecutivo"+concecutivo;

    var nCompleto    = "#tNcompleto"+concecutivo;
    var especialidad = "#tNespecialidad"+concecutivo;
    var consultorio  = "#tNconsultorio"+concecutivo;
    var cedula       = "#tNcedula"+concecutivo;
    var nomBotonR    = "#botonR"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(nomBotonR).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(nCompleto).removeClass("desabilita");
        $(especialidad).removeClass("desabilita");
        $(consultorio).removeClass("desabilita");
        $(cedula).removeAttr("disabled");

    }else{
        // console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(nomBotonR).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(nCompleto).addClass("desabilita");
        $(especialidad).addClass("desabilita");
        $(consultorio).addClass("desabilita");
        $(cedula).attr("disabled", "disabled");
    }
    // console.log(concecutivo+' | '+id);
    $.ajax({
        url:"status.php",
        type:"POST",
        dateType:"html",
        data:{
                'valor':valor,
                'id':id
             },
        success:function(respuesta){
            // console.log(respuesta);
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}

function imprimir(){

    var titular = "Lista de Doctores";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de doctores activos";
    var link    = "pdfListaDoctores.php?";

    alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
    alertify.confirm(
        titular, 
        mensaje, 
        function(){ 
            window.open(link,'_blank');
            }, 
        function(){ 
                alertify.error('Cancelar') ; 
                // console.log('cancelado')
              }
    ).set('labels',{ok:'Generar PDF',cancel:'Cancelar'}); 
  }