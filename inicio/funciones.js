function misDatos(idUsuario){
	// var user = idUsuario;
  var user = idUsuario;
  // alertify.success(user);
	 $.ajax({
        url: 'llenar_datos.php',
        data : {'idUsuario':idUsuario},
        type : 'POST',
        dateType : 'html',
        success : function(respuesta){
            console.log(respuesta);
                var array = eval(respuesta);
                 $("#nombre").val(array[0]);
                 $("#paterno").val(array[1]);
                 $("#materno").val(array[2]);
                 $("#direccion").val(array[3]);
                 $("#sexo").val(array[4]);
                 $("#telefono").val(array[5]);
                 $("#fecha_nac").val(array[6]);
                 $("#correo").val(array[7]);
                 $("#tipo").val(array[8]);
                 $("#persona").val(array[9]);
            
            // if (respuesta != 0) {
            //      $("#persona").val(array[1]);
            //      $("#nomCarrera").val(array[2]);
            //     $("#imagen").attr('src', array[3]);
            //            Altaregistro();
            //}           
        },
        error : function(xhr, status){
            alertify.warning(xhr);
        },
    });
}

function actualizar(){
    var nombre    = $("#nombre").val();
    var paterno   = $("#paterno").val();
    var materno   = $("#materno").val();
    var direccion = $("#direccion").val();
    var sexo      = $("#sexo").val();
    var telefono  = $("#telefono").val();
    var fecha_nac = $("#fecha_nac").val();
    var correo    = $("#correo").val();
    var tipo      = $("#tipo").val();
    var ide       = $("#persona").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'nombre':nombre,
                    'paterno':paterno,
                    'materno':materno,
                    'direccion':direccion,
                    'sexo':sexo,
                    'telefono':telefono,
                    'fecha_nac':fecha_nac,
                    'correo':correo,
                    'tipo':tipo,
                    'ide':ide
                 },
            success:function(respuesta){

            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            // $("#frmActuliza")[0].reset();
            // $("#modalEditar").modal("hide");
            // llenar_lista();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        return false;
}

function abrirModalSubir(mat){
   
    $('#mat').val(mat);
    $("#modalSubir").modal("show");
}

$(document).ready(function() {
    $(".upload").on('click', function() {

        var formData = new FormData();

        var files = $('#image')[0].files[0];
        var matricula=$('#mat').val();

        formData.append('file',files);
        formData.append('mat',matricula);

        $.ajax({
            url: 'upload.php', 
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
                   
                    $('#image').fileinput('reset').trigger('custom-event');       
                    alertify.success('La imagen ha sido cargada con exito.');
                    $("#modalSubir").modal("hide");
                     location.reload();
                   
                } else {
                    alertify.error('Formato de imagen incorrecto.');
                }
            },
            error:function(xhr,status){
                alertify.error('Error en proceso');
            },
        });
        return false;
    });
});
