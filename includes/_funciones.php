<?php  

    require_once '_db.php';
    if(isset($_POST["accion"])){
	    switch ($_POST["accion"]) {
            case 'insertar_usuarios':
            insertar_usuarios();
            break;
        }
    }

    function insertar_usuarios(){
        global $db;
        extract($_POST);

        $insertar=$db ->insert("usuarios",["usr_id" => $mac,
                                            "usr_nombre"=>$nom,
                                            "usr_appat"=>$pat,
                                            "usr_apmat"=>$mat,
                                            "usr_email"=>$cor,
                                            "usr_tel"=>$tel,
                                            "usr_password"=>$pass,
                                            "usr_nivel"=>$niv,
                                            "cps_id"=>$lista,
                                            "tyu_id"=>$tip,
                                            "usr_status"=>1
                                            ]);
        if($insertar){
            echo "Registro existoso";
        }else{
            echo "Se ocasiono un error";
	    }
    }
?>

