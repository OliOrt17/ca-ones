<?php
    require_once '_db.php';
    global $db;
    $consultar=$db->select("usuarios",
    [
        "[>]campus"=>"cps_id",
        "[>]tipo_usuarios"=>"tyu_id"
    ],
    [
        "usuarios.usr_id",
        "usuarios.usr_nombre",
        "usuarios.usr_appat",
        "usuarios.usr_apmat",
        "usuarios.usr_email",
        "usuarios.usr_tel",
        "usuarios.usr_status",
        "campus.cps_campus",
        "tipo_usuarios.tyu_nombre"                                      
    ]); 
        
        foreach($consultar as $consulta => $c ){
            $arreglo["data"][]=$c;
            
        }
    echo json_encode( $arreglo["data"]);
    
?>