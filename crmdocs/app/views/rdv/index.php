<section class="content">
    <div class="box box-success">         
        <div class="box-header with-border">
            <table>
                <tr>
                    <td>
                        <a href="<?php echo URL_BASE . "home" ?>">
                            <button type="button" class="btn btn-sms btn-default btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">
                                Voltar 
                            </button>
                        </a>

                        <a href="<?php echo URL_BASE . "rdv/incluir" ?>">
                            <button type="button" class="btn btn-sms bg-navy btn-flat fa fa-pencil" data-toggle="modal" data-target="#modal-success">
                                INCLUIR RDV 
                            </button>
                        </a>
                    </td>
                </tr> 

            </table>  

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Fechar">
                    <i class="fa fa-times"></i>
                </button>
            </div>     
        </div>

        <div class="box-body">  
            <form method="POST" action="<?php echo URL_BASE . "rdv/index" ?>">
                <div class="row">
                    <div class="col-xs-2">
                        <select name="txt_filtro_situacao" class="form-control select2 tip" id="txt_filtro_situacao"  required="required" style="width:100%;">
                            <option value="P">Pendentes</option>
                            <option value="R">Resolvidos</option>
                            <option value="T">Todos</option>
                        </select>
                    </div>
                    <div class="col-xs-4">
                        <select name="txt_filtro_cliente" class="form-control select2 tip" id="txt_filtro_cliente"   style="width:100%;">
                            <option value="">Selecione um Cliente</option>
                            <?php
                            foreach ($cliente as $registros){
                                echo "<option value='$registros->SEQ_PLA_CLIENTE'> " . $registros->CLIENTE . " </option>";
                            }
                            ?>  
                        </select>
                    </div>

                    <div class="col-xs-2">
                        <select name="txt_filtro_usuario" class="form-control select2 tip" id="txt_filtro_usuario"   style="width:100%;">
                            <option value="<?php echo $_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO ?>"> <?php echo $_SESSION["usuarioLogado"]->APELIDO ?>  </option>
                            <?php
                            foreach ($usuario as $registros){
                                echo "<option value='$registros->SEQ_PLA_USUARIO'> " . $registros->APELIDO . " </option>";
                            }
                            ?>  
                            <option value="TODOS">TODOS</option>
                        </select>
                    </div>

                    <!-- 
                    <div class="col-xs-7">
                      <input type="text" class="form-control" placeholder="Digite aqui oque deseja procurar">
                  </div> -->
                  <div class="col-xs-2">                      
                    <button type="subimit" class="btn btn-lg  btn-flat bg-purple fa fa-search"> Filtrar </button>
                </div>
            </div>  
        </form>
    </div>


</div>


<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">

            <div class="box-body">
                <table id="relatorio" class="table table-bordered table-hover table-striped">

                    <thead>

                        <tr>
                            <th>RDV</th>
                            <th>DATA RDV</th>
                            <th>INI_AM</th>
                            <th>FIM_AM</th>
                            <th>INI_PM</th>
                            <th>FIM_PM</th>
                            <th>CLIENTE</th>
                            <th>DESC. BREVE</th>
                            <th>SIT</th>
                            <th>ANALISTA</th>
                            <th class="text-center sorting_disabled">Opções</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($rdv as $registros) { ?>

                            <tr role="row" class="even">
                                <td class="sorting_1"><?php echo $registros->NR_CHAMADO ?></td>
                                <td><?php echo date('d/m/Y', strtotime($registros->DATA_RELATORIO)) ?></td>
                                <td><?php echo $registros->INI_AM ?></td>
                                <td><?php echo $registros->FIM_AM ?></td>
                                <td><?php echo $registros->INI_PM ?></td>
                                <td><?php echo $registros->FIM_PM ?></td>
                                <td><?php echo $registros->CLIENTE ?></td>
                                <td><?php echo $registros->DESCRICAO_BREVE ?></td>   
                                <td><?php echo $registros->SITUACAO ?></td>   
                                <td><?php echo $registros->APELIDO ?></td>   

                                <td class="text-center">

                                 <?php  

                                 if ($_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO == $registros->SEQ_PLA_USUARIO) { ?>

                                     <a href="<?php echo URL_BASE . "rdv/incluiratividade/". $registros->SEQ_PLA_CHAMADO; ?>">
                                         <button type="button" class="tip btn btn-success btn-sm"> Atividades </button>
                                     </a>

                                     <button type="button" class="tip btn btn-danger btn-sm" data-original-title="Editar" data-toggle="modal" data-target="#modal-excluir" data-whatever=""> Excluir  </button>

                                 <?php }  ?>


                                 <a href="<?php echo URL_BASE . "rdv/imprimir/" . $registros->SEQ_PLA_CHAMADO; ?>">
                                    <button type="button" class="tip btn btn-primary btn-sm"> Imprimir </button>
                                </a>
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>
            </table>

            <input type="hidden" name="seq_pla_chamado" value="<?php //echo $registros->SEQ_PLA_CHAMADO  ?>" >

        </div>
    </div>
</div>
</div>


<div class="modal fade" id="modal-excluir">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Alerta: </h4>
                </div>
                <div class="modal-body">
                    <p> Você deve Excluir pelo CRM Desktop </p>
                    <p> Exclua primeiro As Atividades e andamentos do Chamado </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">OK!!</button>
                </div>
            </div>
        </div>
    </div>

</section>