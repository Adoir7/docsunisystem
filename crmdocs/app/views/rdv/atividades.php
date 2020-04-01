<section class="content">

    <!--      $$$$$$$$$$$$$$$          EDITE O FORMULARIO DAQUI PRA BAIXO    $$$$$$$$$$$$$$$$$$$$  -->

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <!--                  CABEÇALHO DO FORM  -->
                <div class="box-header">
                    <h3 class="box-title">Lançamento de Atividades do Relatório de Visita</h3>
                </div>

                <div class="box-body">
                    <div class="col-sm-12">

                        <div class="row">

                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label for="txt_desc_breve">Relatório </label><br>                                    
                                    <?php
                                    foreach ($listachamado as $listachamado) {
                                        echo $listachamado->NR_CHAMADO;
                                    }
                                    ?>  
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Data Relatório</label><br>
                                    <div class="input-group">
                                    </div>
                                    <?php echo date('d/m/Y', strtotime($listachamado->DATA)); ?>
                                    <!-- /.input group -->
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="txt_ini_am">Manhã Ini</label><br>                                   
                                    <?php echo $listachamado->INI_AM; ?> 
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="txt_fim_am">fim </label><br>                                    
                                    <?php echo $listachamado->FIM_AM; ?>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="txt_ini_pm">Tarde Ini</label><br>                                    
                                    <?php echo $listachamado->INI_PM; ?>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="txt_fim_pm">fim </label><br>                                  
                                    <?php echo $listachamado->FIM_PM; ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cliente">Cliente/Projeto</label><br>                                    
                                    <?php echo $listachamado->CLIENTE; ?>
                                </div>
                            </div>  

                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="tip btn btn-danger btn-sm fa fa-edit" data-original-title="Editar" data-toggle="modal" data-target="#modal-alterar" data-whatever="<?php echo $listachamado->SEQ_PLA_CHAMADO; ?>">
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!-- <PRIMEIRA LINHA DO FORM > -->


                        <!-- |||||||||||||||    FORMULARIO    |||||||||||||||||||||||||| -->

                        <form action="<?php echo URL_BASE . "rdv/salvaratividades" ?>" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                            <!-- $$$$$$$$$$$$ DAQUI PRA BAIXAO SAO OS CAMPOS DO FORMULARIO <- <- <- <- <- <-  --> 

                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txt_servico">Serviço</label>                                                                       
                                        <select name="txt_servico" class="form-control select2 tip" id="txt_servico"  required="" style="width:100%;">
                                            <option value="IMPLANTAÇÃO"> Implantação</option>
                                            <option value="TREINAMENTO"> Treinamento</option>
                                            <option value="INSTALAÇÃO"> Instalação</option>
                                            <option value="ATUALIZAÇÃO"> Atualização</option>
                                            <option value="LEVANTAMENTO DE REQUISITOS"> Levantamento de Requisitos</option>
                                            <option value="RETREINAMENTO"> Retreinamento</option>
                                            <option value="LEVANTAMENTO DO PROCESSO ATUAL"> LPA </option>
                                            <option value="OCIOSIDADE"> OCIOSIDADE</option>                                                                                                       
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txt_sistema">Sistema</label>                                                                       
                                        <select name="txt_sistema" class="form-control select2 tip" id="txt_sistema"  required="" style="width:100%;">
                                            <option value="01"> Financeiro</option>
                                            <option value="02"> Almoxar</option>
                                            <option value="03"> Sementes</option>
                                            <option value="04"> Grãos</option>
                                            <option value="05"> Compras</option>
                                            <option value="06"> Fiscal</option>
                                            <option value="07"> Algodão</option>
                                            <option value="08"> Patrimônio</option>
                                            <option value="09"> Pulveriza</option>
                                            <option value="10"> Sped</option>
                                            <option value="11"> NF-e</option>
                                            <option value="12"> Compass</option>
                                            <option value="13"> Transmissão</option>
                                            <option value="14"> Crm</option>
                                            <option value="15"> Sgl</option>
                                            <option value="16"> Prestação Serviço</option>
                                            <option value="17"> Todos</option>
                                            <option value="20"> Pecuaria</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="txt_hora_ini">Inicío</label>                                    
                                        <input type="time" name="txt_hora_ini" value="<?php //echo $cliente->NR_MATRICULA;  ?>" maxlength="5" class="form-control tip" id="txt_hora_ini" required="" />
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="txt_hora_fim">Fim</label>                                    
                                        <input type="time" name="txt_hora_fim" value="<?php //echo $cliente->NR_MATRICULA;  ?>" maxlength="5" class="form-control tip" id="txt_hora_fim" required=""/>
                                    </div>
                                </div>
                            </div> <!-- ESSA DIV FECHA A LINHA 1 -->
                            <!-- ESSA LINHA DEVE SER EDITADA DAQUI PRA CIMA -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Atividades</label>
                                        <textarea name="txt_atividade" id="area1" class="form-control" rows="3" placeholder="Informe a Descrição das Atividades..."></textarea>
                                    </div>
                                </div>
                            </div> 


                            <div class="row">    
                                <!-- BOTOES DO RODAPÉ DO FORMULARIO = NAO MEXER  -->
                                <div class="box-footer">
                                    <div class="form-group">
                                        <a href="<?php echo URL_BASE . "rdv/index" ?>">
                                            <button type="button" class="btn btn-sm btn-danger btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">  Lista</button>
                                        </a>
                                        <button type="submit" name="add_purchase" value="Gravar"  class="btn btn-sm btn-success btn-flat  fa fa-download" />   Inserir </button> 
                                        <a href="<?php echo URL_BASE . "rdv/finalizar/" . $listachamado->SEQ_PLA_CHAMADO; ?>">
                                            <button type="button" class="btn btn-sm btn-primary btn-flat fa fa-gears" data-toggle="modal" data-target="#modal-success"> Finalizar</button>
                                        </a>
                                        <a href="<?php echo URL_BASE . "rdv/imprimir/" . $listachamado->SEQ_PLA_CHAMADO; ?>">
                                            <button type="button" class="btn btn-sm btn-primary btn-flat fa fa-print" data-toggle="modal" data-target="#modal-success"> Imprimir</button>
                                        </a>
                                    </div>
                                </div>
                                <!-- FIM DOS BOTOES  -->
                                <input type="hidden" name="txt_seq_pla_chamado" value="<?php echo $listachamado->SEQ_PLA_CHAMADO; ?>" >
                                </form>                    
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Serviço</th>
                                                <th>Sistema</th>
                                                <th>Inicio</th>
                                                <th>Fim</th>
                                                <th>Atividades</th>
                                                <th>Opções</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($atividadeschamado as $registros) { ?>

                                                <tr role="row" class="even">
                                                    <td class="sorting_1"><?php echo $registros->SERVICO ?></td>
                                                    <td><?php echo $registros->SISTEMA ?></td>
                                                    <td><?php echo $registros->HORA_INICIO ?></td>
                                                    <td><?php echo $registros->HORA_FIM ?></td>
                                                    <td><?php echo $registros->ATIVIDADE ?></td>

                                                    <td width="10%">
                                                        <div class="text-center">
                                                            <div class="btn-group">                                     
                                                                <a href="<?php echo URL_BASE . "rdv/editaratividade/" . $registros->SEQ_PLA_ATIVIDADE_VISITA; ?>" title="" class="tip btn btn-primary btn-sm" data-toggle="tooltip" data-original-title="Editar"><i class="fa fa-edit"></i></a> 
                                                                <a href="javascript:if(confirm('Confirma a Exclusão da Atividades? '+'<?php echo $registros->SEQ_PLA_ATIVIDADE_VISITA; ?>')){ location='<?php echo URL_BASE . "rdv/delete/" . $registros->SEQ_PLA_ATIVIDADE_VISITA; ?>'}" class="tip btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Excluir"><i class="fa fa-trash-o"></i></a> 
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>     


<div class="modal fade" id="modal-alterar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alterar Horario de Trabalho do Relatório: <?php echo $listachamado->NR_CHAMADO; ?> </h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo URL_BASE . "rdv/salvaeditarchamado" ?>" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txt_ini_am">Manhã Ini</label>                                    
                                <input type="time" name="txt_ini_am" value="<?php echo $listachamado->INI_AM; ?>" maxlength="5" class="form-control tip" id="txt_ini_am"  />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txt_fim_am">fim </label>                                    
                                <input type="time" name="txt_fim_am" value="<?php echo $listachamado->FIM_AM; ?>" maxlength="5" class="form-control tip" id="txt_fim_am"  />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txt_ini_pm">Tarde Ini</label>                                    
                                <input type="time" name="txt_ini_pm" value="<?php echo $listachamado->INI_PM; ?>" maxlength="5" class="form-control tip" id="txt_ini_pm"   />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="txt_fim_pm">fim </label>                                    
                                <input type="time" name="txt_fim_pm" value="<?php echo $listachamado->FIM_PM; ?>" maxlength="5" class="form-control tip" id="txt_fim_pm"  />
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="txt_seq_pla_chamado" value="<?php echo $listachamado->SEQ_PLA_CHAMADO; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-excluir">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirma a Exclusão: <?php echo $registros->SEQ_PLA_ATIVIDADE_VISITA; ?> </h4>
                </div>
                <div class="modal-body">
                    <p><?php echo $registros->SERVICO; ?> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                    <a href="<?php echo URL_BASE . "rdv/delete/" . $registros->SEQ_PLA_ATIVIDADE_VISITA; ?>" <button type="button" data- class="btn btn-primary">Confirma </button></a>
                </div>
            </div>
        </div>
    </div>



</section>