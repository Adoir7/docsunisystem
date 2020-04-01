<section class="content">

    <div class="box box-success">         
        <div class="box-header with-border">
            <a href="<?php echo URL_BASE . "projeto/index" ?>">
                <button type="button" class="btn btn-lg btn-success btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">
                    Voltar Para Lista
                </button></a>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Fechar">
                    <i class="fa fa-times"></i>
                </button>
            </div> 
        </div>
    </div>

    <!--      $$$$$$$$$$$$$$$          EDITE O FORMULARIO DAQUI PRA BAIXO    $$$$$$$$$$$$$$$$$$$$  -->


    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

                <!--                  CABEÇALHO DO FORM  -->
                <div class="box-header">
                    <h3 class="box-title">Editar dados do Projeto</h3>
                </div>

                <div class="box-body">
                    <div class="col-lg-12">

                        <!-- |||||||||||||||    FORMULARIO    |||||||||||||||||||||||||| -->

                        <form action="<?php echo URL_BASE . "projeto/salvar" ?>" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                            <!-- <PRIMEIRA LINHA DO FORM > -->
                            <div class="row">

                                <!-- $$$$$$$$$$$$ DAQUI PRA BAIXAO SAO OS CAMPOS DO FORMULARIO <- <- <- <- <- <-  --> 

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cliente">Cliente</label>                                    
                                        <input type="text" name="cliente" disabled="" 
                                               value="<?php
                                               foreach ($cliente as $cliente) {
                                                   echo $cliente->NOME_CLIENTE;
                                               }
                                               ?>"  class="form-control tip" id="cliente" required="required"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projeto">Projeto</label>                                    
                                        <input type="text" disabled="" name="projeto" value="<?php echo $cliente->NOME_FANTASIA; ?>"  class="form-control tip" id="projeto" required="required"  />
                                    </div>
                                </div>
                            </div>  

                            <!-- ESSA LINHA DEVE SER EDITADA DAQUI PRA CIMA -->
                    </div> <!-- ESSA DIV FECHA A LINHA 1 -->


                    <div class="row">
                        <div class="col-lg-12">

                            <!-- $$$$$$$$$$$$ DAQUI PRA BAIXAO SAO OS CAMPOS DO FORMULARIO <- <- <- <- <- <-  --> 

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="horas_projeto">Horas (hh:mm:ss) </label>                                    
                                    <input type="text" name="horas_projeto" value="<?php echo $cliente->NR_MATRICULA; ?>"  class="form-control tip" id="horas_projeto" required="required"  />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="horas_aditivo">Aditivo (Nrº inteiro)</label>                                    
                                    <input type="text" name="horas_aditivo" value="<?php echo $cliente->COD_SUFRAMA; ?>"  class="form-control tip" id="horas_aditivo"   />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Inicio do Projeto</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="data_projeto" value="<?php echo date('d/m/Y', strtotime($cliente->DATA_CADASTRO)); ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="finalizado">Projeto Finalizado</label>                                                                       
                                    <select name="finalizado" class="form-control select2 tip" id="finalizado"  required="required" style="width:100%;">
                                        <option value="S" <?php echo ($cliente->IMPRIME_INF_ADICIONAL == "S") ? "selected" : "" ?>> Sim</option>
                                        <option value="N" <?php echo ($cliente->IMPRIME_INF_ADICIONAL == "N") ? "selected" : "" ?>> Não</option>
                                    </select>
                                </div>
                            </div>
                        </div>   

                        <!-- ESSA LINHA DEVE SER EDITADA DAQUI PRA CIMA -->
                    </div> 

                    <!-- BOTOES DO RODAPÉ DO FORMULARIO = NAO MEXER  -->

                    <div class="box-footer">
                        <div class="form-group">
                            <button type="submit" name="add_purchase" value="Gravar"  class="btn btn-lg btn-success btn-flat  fa fa-download" />   Salvar </button> 
                            <button type="reset" id="reset" class="btn btn-lg bg-navy btn-flat fa fa-pencil">  Limpar</button>
                            <a href="<?php echo URL_BASE . "projeto/index" ?>">
                                <button type="button" class="btn btn-lg btn-danger btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">  Voltar Para Lista</button>
                            </a>
                        </div>
                    </div>

                    <!-- FIM DOS BOTOES  -->

                    <input type="hidden" name="seq_cliente" value="<?php echo $cliente->SEQ_PLA_CLIENTE; ?>" >



                    </form>                    
                </div>

            </div>
        </div>
    </div>
</div>
</section>
