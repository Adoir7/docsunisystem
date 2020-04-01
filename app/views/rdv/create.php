
<section class="content">

    <!--      $$$$$$$$$$$$$$$          EDITE O FORMULARIO DAQUI PRA BAIXO    $$$$$$$$$$$$$$$$$$$$  -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

                <!--                  CABEÇALHO DO FORM  -->
                <div class="box-header">
                    <h3 class="box-title">Lançamento de Relatório de Visita</h3>
                </div>

                <div class="box-body">
                    <div class="col-lg-12">

                        <!-- |||||||||||||||    FORMULARIO    |||||||||||||||||||||||||| -->

                        <form action="<?php echo URL_BASE . "rdv/salvar" ?>" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                            <!-- $$$$$$$$$$$$ DAQUI PRA BAIXAO SAO OS CAMPOS DO FORMULARIO <- <- <- <- <- <-  --> 
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Data Relatorio</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" name="txt_data_relatorio" value="<?php echo date('d/m/Y'); ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" autofocus>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txt_ini_am">Manhã Ini</label>                                    
                                        <input type="time" name="txt_ini_am" value="<?php //echo $cliente->NR_MATRICULA;  ?>" maxlength="5" class="form-control tip" id="txt_ini_am"  />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txt_fim_am">fim </label>                                    
                                        <input type="time" name="txt_fim_am" value="<?php //echo $cliente->NR_MATRICULA;  ?>" maxlength="5" class="form-control tip" id="txt_fim_am"  />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txt_ini_pm">Tarde Ini</label>                                    
                                        <input type="time" name="txt_ini_pm" value="<?php //echo $cliente->NR_MATRICULA;  ?>" maxlength="5" class="form-control tip" id="txt_ini_pm"   />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txt_fim_pm">fim </label>                                    
                                        <input type="time" name="txt_fim_pm" value="<?php //echo $cliente->NR_MATRICULA;  ?>" maxlength="5" class="form-control tip" id="txt_fim_pm"  />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txt_ocorrencia">Ocorrência</label>                                                                       
                                        <select name="txt_ocorrencia" class="form-control select2 tip" id="txt_ocorrencia"  required="" style="width:100%;">
                                            <option selected="selected"></option>

                                            <?php
                                            foreach ($ocorrencia as $ocorrencia) {
                                                echo "<option value='$ocorrencia->SEQ_PLA_OCORRENCIA'> " . $ocorrencia->OCORRENCIA . " </option>";
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- <PRIMEIRA LINHA DO FORM > -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txt_solicitante">Solicitante/Cliente</label>                                                                       
                                        <select name="txt_solicitante" class="form-control select2 tip" id="txt_solicitante"  required="" style="width:100%;">
                                            <option selected="selected"></option>                                                    
                                            <?php
                                            foreach ($solicitante as $solicitante) {
                                                echo "<option value='$solicitante->SEQ_PLA_SOLICITANTE'> " . $solicitante->SOLICITANTE . " </option>";
                                            }
                                            ?>                                                    
                                        </select>
                                    </div>
                                    <!-- ESSA LINHA DEVE SER EDITADA DAQUI PRA CIMA -->
                                </div> <!-- ESSA DIV FECHA A LINHA 1 -->

                                <div class="row">
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_sistema">Sistema</label>                                                                       
                                        <select name="txt_sistema" class="form-control select2 tip" id="txt_sistema"  required="" style="width:100%;">
                                            <option value="01" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Financeiro</option>
                                            <option value="02" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Almoxar</option>
                                            <option value="03" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Sementes</option>
                                            <option value="04" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Grãos</option>
                                            <option value="05" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Compras</option>
                                            <option value="06" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Fiscal</option>
                                            <option value="07" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Algodão</option>
                                            <option value="08" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Patrimônio</option>
                                            <option value="09" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Pulveriza</option>
                                            <option value="10" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Sped</option>
                                            <option value="11" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> NF-e</option>
                                            <option value="12" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Compass</option>
                                            <option value="13" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Transmissão</option>
                                            <option value="14" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Crm</option>
                                            <option value="15" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Sgl</option>
                                            <option value="16" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Prestação Serviço</option>
                                            <option value="17" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Outros</option>
                                            <option value="20" <?php //echo ($cliente->IMPRIME_INF_ADICIONAL=="N") ? "selected" : ""  ?>> Pecuaria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_desc_breve">Descrição Breve </label>   
                                        <!-- Foi necessario usar a funão mb_strimwidth para limitar o campo a 30 caracteres,
                                            analistas que tem nome de usuario grande ultrapassa o limente assim não gravando o Chamado -->                                 
                                        <input type="text" maxlength="30" name="txt_desc_breve" value="<?php echo mb_strimwidth("RELATORIO DE VISITA " . $_SESSION["usuarioLogado"]->APELIDO, 0, 30,"")  ; ?>"  class="form-control tip" id="txt_desc_breve" required="required"  />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Atividades</label>
                                            <textarea name="txt_detalhes" class="form-control" rows="3">Relatório de Visita em Andamento</textarea>
                                        </div>
                                    </div>
                                </div> 

                                <!-- ESSA LINHA DEVE SER EDITADA DAQUI PRA CIMA -->

                                <!-- BOTOES DO RODAPÉ DO FORMULARIO = NAO MEXER  -->
                                <div class="box-footer">
                                    <div class="form-group">
                                        <a href="<?php echo URL_BASE . "rdv/index" ?>">
                                            <button type="button" class="btn btn-lg btn-danger btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">  Ir Para Lista</button>
                                        </a>
                                        <button type="submit" name="add_purchase" value="Gravar"  class="btn btn-lg btn-success btn-flat  fa fa-download" />   Salvar </button> 
                                    </div>
                                </div>

                                <!-- FIM DOS BOTOES  -->

                                <input type="hidden" name="seq_cliente" value="<?php //echo $cliente->SEQ_PLA_CLIENTE;  ?>" >
                                <input type="hidden" name="txt_empresa" value="<?php echo "1"; ?>" >
                                <input type="hidden" name="txt_filial" value="<?php echo "1"; ?>" >
                                <input type="hidden" name="txt_data_chamado" value="<?php echo date('d/m/Y'); ?>" >
                                <input type="hidden" name="txt_usuariologado" value="<?php echo $_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO ?>" >

                                </form>                    
                            </div>

                    </div>
                </div>
            </div>
        </div>
</section>
