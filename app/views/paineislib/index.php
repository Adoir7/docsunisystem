
<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h3><?php foreach ($totalchamadoscq as $totalchamadoscq) { echo $totalchamadoscq; }?> </h3>
          <p>SIGA CQ</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php echo URL_BASE . 'paineiscq/lista/  26456401' ?>" class="small-box-footer">
          VER CHAMADOS <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3> <?php foreach ($totalchamadoslib as $totalchamadoslib) {
                echo $totalchamadoslib;
              }
              ?></h3></h3>

          <p>LIBERADOR (TESTE-OK)</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php echo URL_BASE . "paineiscq/lista/'  47932601'" ?>" class="small-box-footer">
          VER CHAMADOS <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php foreach ($totalchamadossvf as $totalchamadossvf) {
                echo $totalchamadossvf;
              }
              ?></h3>
          <p>SIGA VERSAO FECHADA </p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php echo URL_BASE . "paineiscq/lista/'  50133201'" ?>" class="small-box-footer">
          VER CHAMADOS <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>
			<?php 
			foreach ($aguardando_ajustes as $aguardando_ajustes) {
                echo $aguardando_ajustes;
			} ?> 
		  </h3>

          <p>AGUARDANDO AJUSTES</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">
          COMPASS <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>


  <div class="row">
    <div class="col-md-3">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">TESTER
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>TESTER</th>
              <th>Quantidade</th>
            </tr>
            <?php foreach ($ch_portester as $registros) {  ?>
              <tr>
                <td><?php echo $registros->TESTER; ?></td>
                <td><?php echo $registros->QUANTIDADE; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  
      <!-- /.box -->
    <div class="col-md-3">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Aguardando fechar versão
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>Ocorrência</th>
              <th>Quantidade</th>
            </tr>
            <?php foreach ($ocorrenciaslib as $registros) {  ?>
              <tr>
                <td><?php echo $registros->OCORRENCIA; ?></td>
                <td><?php echo $registros->QUANTIDADE; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>

      <!-- /.box -->
    <div class="col-md-3">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Aguardando para entrar na versão
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>Ocorrência</th>
              <th>Quantidade</th>
            </tr>
            <?php foreach ($ocorrenciassvf as $registros) {  ?>
              <tr>
                <td><?php echo $registros->OCORRENCIA; ?></td>
                <td><?php echo $registros->QUANTIDADE; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>

      <!-- /.box -->
    <div class="col-md-3">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Por tipo de Retorno
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>Tp. Retorno</th>
              <th>Quantidade</th>
            </tr>
            <?php foreach ($aguardando_portipo as $resultado) {  ?>
              <tr>
                <td><?php echo $resultado->TIPO_RETORNO; ?></td>
                <td><?php echo $resultado->QUANTIDADE; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->


      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">

                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">

                        <thead>
                            <tr>
                                <th>CHAM</th>
                                <th>DATA</th>
                                <th>CLIENTE</th>
                                <th>SOLICITANTE</th>
                                <th>DESCRICAO_BREVE</th>
                                <th>OCORRENCIA</th>
                                <th>DT_SAICQ</th>
                                <th>TP RETORNO</th>
                                <th>ATUALMENTE</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($lista_ch_aguardando as $registros) { ?>

                                <tr role="row" class="even">
                                    <td class="sorting_1"><?php echo $registros->NR_CHAMADO ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($registros->DT_CHAMADO)) ?></td>
                                    <td><?php echo $registros->CLIENTE ?></td>
                                    <td><?php echo $registros->SOLICITANTE ?></td>
                                    <td><?php echo $registros->DESCRICAO_BREVE ?></td>
                                    <td><?php echo $registros->OCORRENCIA ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($registros->DT_SAICQ)) ?></td>
                                    <td><?php echo $registros->DESTINO ?></td>
                                    <td><?php echo $registros->DESTINO ?></td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>