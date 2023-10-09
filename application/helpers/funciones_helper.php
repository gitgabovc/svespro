<?php

function formatearFecha($fecha)
{
    /*2022-06-18 22:15:10*/
    $dia = substr($fecha, 8, 2);
    $mes = substr($fecha, 5, 2);
    $anio = substr($fecha, 0, 4);

    $hora = substr($fecha, 11, 5);
    $fechaformateada = $dia . "/" . $mes . "/" . $anio . " " . $hora;
    return $fechaformateada;
}

function estado($edad)
{
    if ($edad >= 18) {
        $estado = "Mayor de edad";
    } else {
        $estado = "Menor de edad";
    }
    return $estado;
}

function mensaje($msg)
{
    switch ($msg) {
        case '1':
            $mensaje = "Gracias por usar el sistema";
            break;
        case '2':
            $mensaje = "Usuario no identificado";
            break;
        case '3':
            $mensaje = "Acceso denegado - Favor inicie sesion";
            break;
        default:
            $mensaje = "";
    }
    return $mensaje;
}

function fotosUsuario($foto)
{


    if ($foto == "") {
?>
        <img src="<?php echo base_url(); ?>/fotos/usuarios/user.png" alt="user" class="rounded-circle" width="50px">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url(); ?>/fotos/usuarios/<?php echo $foto; ?>" alt="user" class="rounded-circle" width="50px" />
    <?php
    }
}


function fotosUsuarioModificar($foto)
{


    if ($foto == "") {
    ?>
        <img src="<?php echo base_url(); ?>/fotos/usuarios/user.png" alt="user" class="rounded-circle" width="190px">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url(); ?>/fotos/usuarios/<?php echo $foto; ?>" alt="user" class="rounded-circle" width="190px" />
    <?php
    }
}


function fotoProducto($foto, $t="50")
{


    if ($foto == "") {
    ?>
        <img src="<?php echo base_url(); ?>fotosProducto/user.png" alt="producto" class="rounded-circle" width="<?php echo $t ?>">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url('fotosProducto/' . $foto); ?>" alt="producto" class="rounded-circle" width="<?php echo $t ?>" />
    <?php
    }
}

function imgProducto($foto, $nombre)
{


    if ($foto == "") {
    ?>
        <img src="<?php echo base_url(); ?>fotosProducto/user.jpg" alt="producto" class="card-img-top" width="210px" height="180px">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url('fotosProducto/' . $foto); ?>" alt="<?php echo $nombre?>" class="card-img-top" width="210px" height="180px"/>
    <?php
    }
}

function fotoUsuario($foto, $t="50")
{


    if ($foto == "") {
    ?>
        <img src="<?php echo base_url(); ?>fotosUsuario/user.png" alt="usuario" class="rounded-circle" width="<?php echo $t ?>">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url('fotosUsuario/' . $foto); ?>" alt="usuario" class="rounded-circle" width="<?php echo $t ?>" />
    <?php
    }
}

function fotoUsuarioCircular($foto, $t="50")
{


    if ($foto == "") {
    ?>
        <img src="<?php echo base_url(); ?>fotosUsuario/user.png" alt="usuario" class="rounded-circle" width="<?php echo $t ?>" style="border-radius:50%;">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url('fotosUsuario/' . $foto); ?>" alt="usuario" class="rounded-circle" width="<?php echo $t ?>" style="border-radius:50%;"/>
    <?php
    }
}

function fotosEstudianteModificar($foto)
{


    if ($foto == "") {
    ?>
        <img src="<?php echo base_url(); ?>/fotos/estudiantes/user.png" alt="user" class="rounded-circle" width="190px">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url(); ?>/fotos/estudiantes/<?php echo $foto; ?>" alt="user" class="rounded-circle" width="190px" />
    <?php
    }
}




function imagenMaterial($imagen)
{


    if ($imagen == "") {
    ?>
        <img src="<?php echo base_url(); ?>/uploads/materiales/material.png" alt="user" class="rounded-circle" width="50px">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url(); ?>/uploads/materiales/<?php echo $imagen; ?>" alt="user" class="rounded-circle" width="50px" />
    <?php
    }
}


function imagenMaterialModificar($imagen)
{


    if ($imagen == "") {
    ?>
        <img src="<?php echo base_url(); ?>/uploads/materiales/material.png" alt="user" class="rounded-circle" width="190px">
    <?php
    } else {
    ?>
        <img src="<?php echo base_url(); ?>/uploads/materiales/<?php echo $imagen; ?>" alt="user" class="rounded-circle" width="190px" />
<?php
    }
}

function cambiarTipo($tipo)
{
    if($tipo == "adm"){
        return "Administrador";
    }else{
        return "Vendedor";
    }
}

function cambiarAcceso($acceso)
{
    if($acceso == "1"){
        return "Permitido";
    }else{
        return "No Permitido";
    }
}
?>