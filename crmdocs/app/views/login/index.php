<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL_BASE . "" ?>assets/img/favicon.ico">
        <title>Crm Unisystem</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body background="<?php echo URL_BASE . "" ?>assets/img/background-azul.gif">
        <section class="content">
            <div class="login-box">
                <div class="login-logo">
                    <a href="<?php echo URL_BASE ?>"><b>Gestão de Projetos</b></a>
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body">
                    <p class="login-box-msg">Usuario e Senha do CRM</p>

                    <?php
                    if (isset($erro) && !empty($erro)) {
                        echo "<div class='alert alert-warning alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <h4><i class='icon fa fa-warning'></i> Atenção</h4>" . $erro;
                        echo "</div>";
                    }
                    ?>

                    <form action="<?php echo URL_BASE . "login" ?>" method="post">
                        <div class="form-group has-feedback">
                            <input type="text" name="usuario" class="form-control" required="" placeholder="Usuario">
                            <span class="fa fa-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="senha" class="form-control" required="" placeholder="Senha">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->
        </section>

        <!-- jQuery 3 -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/iCheck/icheck.min.js"></script>
    </body>
</html>
