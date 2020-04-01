<!-- Main content -->
<section class="content">
    <div class="box box-success">         
        <div class="box-header with-border">
            <table>
                <tr>                  
				  <td style="width:200px">                                             

						<a href="<?php echo URL_BASE . "paineiscq/index" ?>">
							<button type="button" class="btn btn-sms btn-default btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">  Voltar para Painéis</button> 
						</a>

					</td>
				</tr> 
               
            </table>  

        </div>
    </div>
	
	
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
                                <th>MENU</th>
                                <th>OPCAO</th>
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
                                    <td><?php echo $registros->MENU ?> </td>
                                    <td><?php echo $registros->OPCAO ?></td>
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