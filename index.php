<?php
require_once 'includes/_db.php';
require_once 'includes/_funciones.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title></title>
      

    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'> 
    <link rel="stylesheet" type="text/css" href="lib/datatables/datatables.min.css"/>
    <link rel="stylesheet"  type="text/css" href="lib/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">      
    
  </head>
    
  <body> 

    <div class="container">
        <div class="row">
            <div class="col-lg-12">     
            <h2>Usuarios  
            <button id="btnNuevo" type="button" class="btn btn-primary" data-toggle="modal">Agregar nuevo
                <span class="fas fa-plus"></span>
            </button>
        </h2>       
              
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablausuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre completo</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Campus</th>
                                <th>Tipo de usuario</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php 
                                $usuarios = $db->select("usuarios",
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
                                foreach ($usuarios as $usuarios => $usr) {
                            ?>
                                    <tr>
                                        <td><?php echo $usr["usr_id"]; ?></td>
                                        <td><?php echo $usr["usr_nombre"]." ".$usr["usr_appat"]." ".$usr["usr_apmat"]; ?></td>
                                        <td><?php echo $usr["usr_email"]; ?></td>
                                        <td><?php echo $usr["usr_tel"]; ?></td>
                                        <td><?php echo $usr["cps_campus"]; ?></td>
                                        <td><?php echo $usr["tyu_nombre"]; ?></td>
                                        <td>
                                            <a href="#" class="editar_usuarios" data-id="<?php echo $usr["usr_id"]; ?>"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="#" class="eliminar_usuarios" data-id="<?php echo $usr["usr_id"]; ?>"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            ?>

                        </tbody>
                               
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal-->
<div class="modal fade" id="modalusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formulario" action="">    
            <div class="modal-body">
                <div class="form-group">
                <input type="number" class="form-control" id="matricula"  placeholder="Matricula">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" id="nombre"  placeholder="Nombre">
                </div>               
                <div class="form-group">
                <input type="text" class="form-control" id="paterno" placeholder="Apellido paterno">
                </div>    
                <div class="form-group">
                <input type="text" class="form-control" id="materno"  placeholder="Apellido materno:">
                </div> 
                <div class="form-group">
                   <select id="lista">
                   <option value="0">Seleccionar Campus</option>
                    <?php 
                            $campus = $db->select("campus","*"); 
                            foreach ($campus as $campus => $cps) {
                        ?>
                                <option value="<?php echo $cps["cps_id"]?>"><?php echo $cps["cps_campus"]?></option>
                        <?php
                            }
                        ?>
                   </select>
                </div>  
                <div class="form-group">
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Email">
                </div>  
                <div class="form-group">
                <input type="password" class="form-control" id="pass" placeholder="Contraseña">
                </div>
                <div class="form-group">
                <input type="number" class="form-control" id="tel" placeholder="Telefono">
                </div>    
                <div class="form-group">
                   <select id="tipo">
                   <option value="0">Seleccionar Tipo de usuario</option>
                    <?php 
                            $tipo = $db->select("tipo_usuarios","*"); 
                            foreach ($tipo as $tipo => $tyu) {
                        ?>
                                <option value="<?php echo $tyu["tyu_id"]?>"><?php echo $tyu["tyu_nombre"]?></option>
                        <?php
                            }
                        ?>
                   </select>
                </div>  
                <div class="form-group">
                <input type="text" class="form-control" id="nivel" placeholder="Nivel educativo">
                </div>  
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnGuardar" class="btn btn-success">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/datatables/datatables.min.js"></script>    
    <script type="text/javascript" src="js/main.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> 
    
    
  </body>
</html>
