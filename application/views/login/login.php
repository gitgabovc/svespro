<?php

switch ($msg) {
    case '1':
        print_r('Error de ingreso');
        //echo "Error de ingreso";
        break;
    case '2':
        echo "Acceso no válido";
        break;
    case '3':
        echo "Gracias por usar el sistema";
        break;

    default:
        echo "";
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siriri</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/core.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?php echo base_url(); ?>Limitless/global_assets/js/plugins/loaders/pace.min.js"></script>
    <script src="<?php echo base_url(); ?>Limitless/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>Limitless/global_assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>Limitless/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script src="<?php echo base_url(); ?>Limitless/full/assets/js/app.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">Siriri</a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">
                        <i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog3"></i>
                        <span class="visible-xs-inline-block position-right"> Options</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <!-- Simple login form -->
                    <form id="formLogin">
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                <h5 class="content-group">Ingresa A Tu Cuenta <small class="display-block">Introduce tu usuario y contraseña</small></h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" id="txtUsuario" name="txtUsuario" class="form-control" placeholder="Usuario">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Contraseña">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión<i class="icon-circle-right2 position-right"></i></button>
                            </div>


                        </div>
                    </form>
                    <!-- /simple login form -->


                    <!-- Footer -->
                    <div class="footer text-muted text-center">
                        &copy; 2023. <a href="#">Siriri Web App</a> por <a href="http://themeforest.net/user/Kopyov" target="_blank">Creativa Diseño Gráfico y Web</a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

    <script>
        const formulario = document.querySelector("#formLogin");
        const usuario = document.querySelector("#txtUsuario");
        const password = document.querySelector("#txtPassword");
        formulario.addEventListener("submit", enviarFormulario);

        function enviarFormulario(e) {
            e.preventDefault();
            if ([usuario.value, password.value].includes("")) {
                console.log("Debe rellenar todos los datos");
                return;
            }
            const formData = new FormData(formulario);
            const queryString = new URLSearchParams(formData).toString();

            $.ajax({
                type: "POST",
                url: "login/validarUsuario",
                data: queryString,
                success: function(r) {
                    if (r == "true") {
                        window.location.href = "inicio";
                    } else {

                    }

                }
            });

        }
    </script>

</body>

</html>