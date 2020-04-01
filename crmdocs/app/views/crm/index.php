<section class="content">
       <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">

                <div class="box-body">
                    <table class="table table-bordered table-hover table-striped">

                        <thead>

                            <tr>
                                <th>SEQ_PLA_CHAMADO</th>
                                <th>SEQ_PLA_ANALISTA</th>
                                <th>SEQUENCIA</th>
                                <th>PROXIMO USUARIO</th>              
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($crm as $registros) { ?>

                                <tr role="row" class="even">
                                    <td class="sorting_1"><?php echo $registros->SEQ_PLA_CHAMADO ?></td>
                                    <td><?php echo $registros->SEQ_PLA_ANALISTA ?></td>
                                    <td><?php echo $registros->SEQUENCIA ?></td>
                                    <td><?php echo $crm->prox($registros->SEQ_PLA_CHAMADO, $registros->SEQUENCIA) ?></td>                                                        
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