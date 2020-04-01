<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="<?php echo URL_BASE . "" ?>assets/dist/img/ico-user.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p><?php echo $_SESSION["usuarioLogado"]->NOME_USUARIO ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
<!-- search form -->
<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
</form>
<!-- /.search form -->
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">OPÇÕES DISPONIVEIS</li>

    <li class="active menu-open">
        <a href="<?php echo URL_BASE . "home" ?>">
            <i class="fa fa-home"></i> 
            <span>Home</span>
        </a>
    </li>

    <li class="active menu-open">
        <a href="<?php echo URL_BASE . "rdv/incluir" ?>">
            <i class="fa fa-newspaper-o"></i> 
            <span>Lançar RDV</span>
        </a>
    </li> 

    <li class="active menu-open">
        <a href="<?php echo URL_BASE . "projeto/index" ?>">
            <i class="fa fa-group"></i> 
            <span>Projetos Mosayco</span>
        </a>
    </li>

    <?php
    // somente usuario pode usar atualizador.
    $admin = $_SESSION["usuarioLogado"]->APELIDO;
    if ($admin == 'ADOIR') {
        ?>
        <li class="active menu-open">
            <a href="<?php echo URL_BASE . "index" ?>">
                <i class="fa fa-gears"></i> 
                <span>Atualizar BD </span>
            </a>
        </li>
    <?php } ?>
</ul>