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
            llenar_medicamento();
            llenar_codigo();
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
  
    var codigo = $("#codigo").val();
    var idMedicamento = $("#idMedicamento").val();
    var cantidad = $("#cantidad").val();

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
                    'codigo':codigo,
                    'idMedicamento':idMedicamento,
                    'cantidad':cantidad
                 },
            success:function(respuesta){
              
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha guardado el registro' );
            $("#frmAlta")[0].reset();
            llenar_codigo();
            llenar_medicamento();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(idReceta,idMedicamento,cantidad,idDetalle){

    $("#frmActuliza")[0].reset();
  
    llenar_codigoD(idReceta);
    llenar_medicamentoD(idMedicamento)
    $("#cantidadE").val(cantidad);
    $("#idE").val(idDetalle);

    $(".select2").select2();

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#codigoE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var idReceta    = $("#codigoE").val();
    var idMedicamento   = $("#idMedicamentoE").val();
    var cantidad   = $("#cantidadE").val();
    var idDetalle       = $("#idE").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'idReceta':idReceta,
                    'idMedicamento':idMedicamento,
                    'cantidad':cantidad,
                    'ide':idDetalle
                 },
            success:function(respuesta){

            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            $("#frmActuliza")[0].reset();
            $("#modalEditar").modal("hide");
          llenar_codigo();
          llenar_medicamento();
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
    var idReceta = "#tidReceta"+concecutivo;
    var codigo   = "#tcodigo"+concecutivo;
    var idMedicamento    = "#tidMedicamento"+concecutivo;
    var cantidad  = "#tcantidad"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(idReceta).removeClass("desabilita");
        $(codigo).removeClass("desabilita");
        $(idMedicamento).removeClass("desabilita");
        $(cantidad).removeClass("desabilita");
    }else{
        console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(idReceta).removeClass("desabilita");
        $(codigo).removeClass("desabilita");
        $(idMedicamento).removeClass("desabilita");
        $(cantidad).removeClass("desabilita");
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

    var titular = "Lista de personas";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de personas activas";
    // var link    = "pdfListaPersona.php?id="+idPersona+"&datos="+datos;
    var link    = "pdfListaPersona.php?";

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
function llenar_codigo()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboCodigo.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#codigo").empty();
            $("#codigo").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function llenar_codigoD(idReceta)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboCodigoD.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#codigoE").empty();
            $("#codigoE").html(respuesta);
            $("#codigoE").val(idReceta);
            $("#codigoE").select2();       
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}function llenar_medicamentoD(idMedicamento)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboMedicamentosD.php',
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