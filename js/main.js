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

    //eliminar
    $(document).on("click", ".eliminar_usuarios", function(){
        id=$(this).data("id");
        $.ajax({
            url: "./includes/_funciones.php",
            type: "POST",
            dataType: "json",
            data: {
                accion: "eliminar_usuarios",
                id: id
            },
            success: function(data){
                console.log(data);
            }
        })
        location.reload();
    });

    //Editar
    $(document).on("click", ".editar_usuarios", function(){
        id=$(this).data("id");
        
        obj={
            "accion" : "consultar_usuarios",
            "id" : $(this).data("id")
        }
        $.post("./includes/_funciones.php", obj, function(data){
            $("#matricula").val(data.usr_id);
            $("#nombre").val(data.usr_nombre);
            $("#paterno").val(data.usr_appat);
            $("#materno").val(data.usr_apmat);
            $("#lista").val(data.cps_id);
            $("#correo").val(data.usr_email);
            $("#tel").val(data.usr_tel);
            $("#tipo").val(data.tyu_id);
            $("#nivel").val(data.usr_nivel);
            $("#pass").val(data.usr_password);
            
        }, "JSON");
        
       
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Usuarios"); 
        $("#btnGuardar").text("Actualizar");  
        $("#modalusuario").modal("show");  

        
    });
    
});