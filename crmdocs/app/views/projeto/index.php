<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PROJETOS EM ANDAMENTO</span>
                    <span class="info-box-number"> 
                        <?php
                        foreach ($quantidade as $quantidade) {
                            echo $quantidade;
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-checkmark-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">COM SALDO POSITIVO</span>
                    <span class="info-box-number">
                        <?php
                        foreach ($andamento as $andamento) {
                            echo $andamento;
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red color-palette"><i class="ion ion-ios-information-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">COM SALDO NEGATIVO</span>
                    <span class="info-box-number">
                        <?php
                        foreach ($estourado as $estourado) {
                            echo $estourado;
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-light-blue"><i class="ion ion-ios-clock-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">SALDO DE HORAS</span>
                    <span class="info-box-number">
                        <?php
                        foreach ($saldo as $saldo) {
                            echo $saldo;
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">

                        <thead>
                            <tr>
                                <th>PROJETO</th>
                                <th>SISTEMA</th>
                                <th>INICIO</th>
                                <th>HORAS</th>
                                <th>ADITIVO</th>
                                <th>TOTAL HORAS</th>
                                <th>EXECUTADAS</th>
                                <th>SALDO</th>
                                <th class="text-center sorting_disabled">Opções</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($projetos as $registros) { ?>

                                <tr role="row" class="even">
                                    <td class="sorting_1"><?php echo $registros->CLIENTE ?></td>
                                    <td><?php echo $registros->DESC_SITUACAO_CLIENTE ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($registros->INICIO_PROJETO)) ?></td>
                                    <td><?php echo $registros->HORAS_PROJETO ?></td>
                                    <td><?php echo $registros->ADITIVO ?></td>
                                    <td><?php echo $registros->TOTAL_PROJETO ?></td>
                                    <td><?php echo $registros->EXECUTADO ?></td>
                                    <td><?php echo $registros->SALDO ?></td>

                                    <td class="">
                                        <div class="text-center">
                                            <div class="btn-group">

                                                <a href="<?php echo URL_BASE . "projeto/edit/" . $registros->SEQ_PLA_CLIENTE; ?>" title="" class="tip btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Editar"><i class="fa fa-edit"></i></a> 
                                                <a href="<?php echo URL_BASE . "relatoriosvisita/index/" . $registros->SEQ_PLA_CLIENTE; ?>" class="tip btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Visualizar"><i class="fa  fa-search-plus"></i></a>                                    

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                    <input type="hidden" name="seq_cliente" value="<?php echo $registros->SEQ_PLA_CLIENTE; ?>" >
                    <!-- <input type="hidden" name="projeto" value="<?php echo $registros->CLIENTE ?>" >
                    <input type="hidden" name="horas" value="<?php echo $registros->TOTAL_PROJETO ?>" >
                    <input type="hidden" name="executadas" value="<?php echo $registros->EXECUTADO ?>" >
                    <input type="hidden" name="saldo" value="<?php echo $registros->SALDO ?>" >
                    -->
                </div>
            </div>
        </div>
    </div>

</section>