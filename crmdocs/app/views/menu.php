<!-- Sidebar user panel -->
<div class="user-panel">
  <div class="pull-left image">
    <img src="<?php echo URL_BASE . "" ?>assets/dist/img/ico-user.png" class="img-circle" alt="User Image">
  </div>
  <div class="pull-left info">
    <p><?php echo $_SESSION["usuarioLogado"]->NOME_SOLICITANTE ?></p>
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>
<!-- search form -->
<hr>
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
</ul>