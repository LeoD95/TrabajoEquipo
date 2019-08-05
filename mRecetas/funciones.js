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
            llenar_paciente();
            llenar_doctor();
            llenar_medicamento();
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    });	
}

function ver_alta(){
    // preCarga(800,4);
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#nombre").focus();
    $("#codigo").val("");
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
  
    var idPaciente = $("#idPaciente").val();
    var idDoctor = $("#idDoctor").val();
    var descripcion = $("#descripcion").val();
    var idMedicamento = $("#idMedicamento").val();
    var cantidad   = $("#cantidad").val();

    // validacion para no meter id de persona en 0
    if(idPaciente==0){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar el dato de una persona.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    // validacion para no meter id de persona en 0
    if(idDoctor==0){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar el dato de un doctor.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    // validacion para no meter id de persona en 0
    if(idMedicamento==0){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar el dato de un medicamento.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }


        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'idPaciente':idPaciente,
                    'idDoctor':idDoctor,
                    'descripcion':descripcion,
                    'idMedicamento':idMedicamento,
                    'cantidad':cantidad
                 },
            success:function(respuesta){
              
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha guardado el registro' );
            $("#frmAlta")[0].reset();
            llenar_paciente();
            llenar_doctor();
            llenar_medicamento();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(idPaciente,idDoctor,descripcion,idMedicamento,cantidad,codigo,idReceta){

    $("#frmActuliza")[0].reset();
  
    llenar_pacienteR(idPaciente);
    llenar_doctorR(idDoctor);
    llenar_medicamentoR(idMedicamento);
    $("#descripcionE").val(descripcion);
    $("#cantidadE").val(cantidad);
    $("#codigoE").val(codigo);
    $("#idE").val(idReceta);

    $(".select2").select2();

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#idPacienteE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var idPaciente    = $("#idPacienteE").val();
    var idDoctor   = $("#idDoctorE").val();
    var descripcion   = $("#descripcionE").val();
    var idMedicamento = $("#idMedicamentoE").val();
    var cantidad      = $("#cantidadE").val();
    var codigo  = $("#codigoE").val();
    var ide       = $("#idE").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'idPaciente':idPaciente,
                    'idDoctor':idDoctor,
                    'descripcion':descripcion,
                    'idMedicamento ':idMedicamento,
                    'cantidad':cantidad,
                    'codigo':codigo,
                    'ide':ide
                 },
            success:function(respuesta){

            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            $("#frmActuliza")[0].reset();
            $("#modalEditar").modal("hide");
         
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function status(concecutivo,id){
    var nomToggle = "#interruptor"+concecutivo;
    var nomBoton  = "#boton"+concecutivo;
    var numero    = "#tConsecutivo"+concecutivo;
    var idPaciente   = "#tidPaciente"+concecutivo;
    var idDoctor    = "#tidDoctor"+concecutivo;
    var descripcion  = "#tdescripcion"+concecutivo;
    var idMedicamento      = "#tidMedicamento"+concecutivo;
    var cantidad      = "#tcantidad"+concecutivo;
    var codigo_receta      = "#tcodigo_receta"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(idPaciente).removeClass("desabilita");
        $(idDoctor).removeClass("desabilita");
        $(descripcion).removeClass("desabilita");
        $(idMedicamento).removeClass("desabilita");
        $(cantidad).removeClass("desabilita");
        $(codigo_receta).removeClass("desabilita");
    }else{
        console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(idPaciente).removeClass("desabilita");
        $(idDoctor).removeClass("desabilita");
        $(descripcion).removeClass("desabilita");
        $(idMedicamento).removeClass("desabilita");
        $(cantidad).removeClass("desabilita");
        $(codigo_receta).removeClass("desabilita");
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

    var titular = "Lista de Carreras";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de carreras activos";
    // var link    = "pdfListaPersona.php?id="+idPersona+"&datos="+datos;
    var link    = "pdf/index.php?";

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
  function llenar_medicamento()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboMedicamentos.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idMedicamento").empty();
            $("#idMedicamento").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function llenar_doctor()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboDoctores.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idDoctor").empty();
            $("#idDoctor").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function llenar_pacienteR(idPaciente)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboPacientesR.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idPacienteE").empty();
            $("#idPacienteE").html(respuesta);
            $("#idPacienteE").val(idPaciente);
            $("#idPacienteE").select2();       
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function llenar_doctorR(idDoctor)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboDoctorR.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idDoctorE").empty();
            $("#idDoctorE").html(respuesta);
            $("#idDoctorE").val(idDoctor);
            $("#idDoctorE").select2();       
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function llenar_medicamentoR(idMedicamento)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboMedicamentoR.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idMedicamentoE").empty();
            $("#idMedicamentoE").html(respuesta);
            $("#idMedicamentoE").val(idMedicamento);
            $("#idMedicamentoE").select2();       
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function llenar_paciente()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboPacientes.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idPaciente").empty();
            $("#idPaciente").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}