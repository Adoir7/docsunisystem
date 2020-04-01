<!-- Logo -->
<a href="<?php echo URL_BASE . "home" ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>C</b>RM</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>UNISYSTEM</b></span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less -->

            <!-- Tasks: style can be found in dropdown.less -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo URL_BASE . "" ?>assets/img/ico-user.png" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $_SESSION["usuarioLogado"]->NOME_SOLICITANTE ?></span>
                </a>

            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="<?php echo URL_BASE ?>login/logout" class="glyphicon glyphicon-log-in" data-toggle="tooltip" data-original-title="Sair"></a>
            </li>
        </ul>
    </div>

</nav>