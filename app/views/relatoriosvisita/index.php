<section class="content">
    <div class="box box-success">         
        <div class="box-header with-border">
            <table>
                <tr>
                    <?php foreach ($projetos as $registros) { ?>

                        <td style="width:400px"><?php echo "<b>" . "PROJETO: </b>" . $registros->CLIENTE ?></td>
                        <td style="width:200px"><?php echo "<b>" . "HORAS: </b>" . $registros->TOTAL_PROJETO ?> </td>
                        <td style="width:200px"><?php echo "<b>" . "EXECUTADAS: </b>" . $registros->EXECUTADO ?></td>
                        <td style="width:300px"><?php echo "<b>" . "SALDO: </b>" . $registros->SALDO ?></td>
                        <td style="width:200px">                                                   

                            <a href="<?php echo URL_BASE . "projeto/index" ?>">
                                <button type="button" class="btn btn-sms btn-danger btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success"></button>
                            </a>

                            <a href="<?php echo URL_BASE . "relatoriosvisita/imprimir/" . $registros->SEQ_PLA_CLIENTE; ?>">
                                <button type="button" class="btn btn-sms bg-primary btn-flat fa fa-print" data-toggle="modal" data-target="#modal-success"></button>

                                <a href="<?php echo URL_BASE . "rdv/incluir" ?>">
                                    <button type="button" class="btn btn-sms bg-navy btn-flat fa fa-pencil" data-toggle="modal" data-target="#modal-success">
                                        RDV 
                                    </button>
                                </a>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Fechar">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>  

                            </a>

                        </td>
                    </tr> 
                <?php } ?>
            </table>  

        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">

                <div class="box-body">
                    <table class="table table-bordered table-hover table-striped">

                        <thead>

                            <tr>
                                <th>RDV</th>
                                <th>DATA</th>
                                <th>INI_AM</th>
                                <th>FIM_AM</th>
                                <th>INI_PM</th>
                                <th>FIM_PM</th>
                                <th>TOTAL</th>
                                <th>ANALISTA</th>
                                <th class="text-center sorting_disabled">Cliente</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($relatoriosvisita as $registros) { ?>

                                <tr role="row" class="even">
                                    <td class="sorting_1"><?php echo $registros->NR_RELATORIO ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($registros->DATA_RELATORIO)) ?></td>
                                    <td><?php echo $registros->HORA_INI_AM ?></td>
                                    <td><?php echo $registros->HORA_FIM_AM ?></td>
                                    <td><?php echo $registros->HORA_INI_PM ?></td>
                                    <td><?php echo $registros->HORA_FIM_PM ?></td>
                                    <td><?php echo $registros->TOTAL ?></td>
                                    <td><?php echo $registros->ANALISTA_ATUAL ?></td>
                                    <td><?php echo $registros->CLIENTE ?></td>                                
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                    <input type="hidden" name="id_categoria" value="<?php //echo $registros->COD_EMPRESA  ?>" >

                </div>
            </div>
        </div>
    </div>

</section>