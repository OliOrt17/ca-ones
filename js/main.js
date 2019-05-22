$(document).ready(function(){
    //inicializar el plugin de datatable
    tablausuario=$("#tablausuario").DataTable({
       
        
        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
    //inicializar accion del boton para mostrar el modal
    $("#btnNuevo").click(function(){    
        $("#formulario").trigger("reset");
        $(".modal-header").css("background-color","#28a745"); 
        $(".modal-header").css("color","white"); 
        $(".modal-title").text("Agregar usuario");  
        $("#modalusuario").modal("show");   
    });
    //Obtener los parametros
    $("#btnGuardar").click(function(){
        console.log("en formulario")
        ///e.preventDefault();
        mac=$("#matricula").val();
        nom=$("#nombre").val();
        pat=$("#paterno").val();
        mat=$("#materno").val();
        lista=$("#lista").val();
        cor=$("#correo").val();
        tel=$("#tel").val();
        tip=$("#tipo").val();
        niv=$("#nivel").val();
        pass=$("#pass").val();
        //console.log("matricula", mac)
        $.ajax({
            url: "./includes/_funciones.php",
            type: "POST",
            dataType: "json",
            data: {
                accion: "insertar_usuarios",
                mac: mac,
                nom: nom,
                pat: pat,
                mat: mat,
                lista: lista,
                cor: cor,
                tel: tel,
                tip: tip,
                pass,
                niv: niv
            },
            success: function(data){
                console.log(data);
            }
        })
        $("#modalusuario").modal("hide");
        location.reload();
    });


    //Obtener los parametros
    /*$("#formulario").submit(function(){
        console.log("en formulario")
        e.preventDefault();
        mac=$trim($("#matricula").val());
        nom=$trim($("#nombre").val());
        pat=$trim($("#paterno").val());
        mat=$trim($("#materno").val());
        lista=$trim($("#lista").val());
        cor=$trim($("#correo").val());
        tel=$trim($("#tel").val());
        tip=$trim($("#tipo").val());
        niv=$trim($("#nivel").val());

        $.ajax({
            url: "../includes/_funciones.php",
            type: "POST",
            dataType: "json",
            data: {
                accion: "insertar_usuarios",
                mac: mac,
                nom: nom,
                pat: pat,
                mat: mat,
                lista: lista,
                cor: cor,
                tel: tel,
                tip: tip,
                niv: niv
            },
            success: function(data){
                console.log(data);
            }
        })
        $("#modalusuario"),modal("hide");
    });*/
    
});