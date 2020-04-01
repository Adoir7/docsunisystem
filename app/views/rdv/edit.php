<section class="content">

    <!--      $$$$$$$$$$$$$$$          EDITE O FORMULARIO DAQUI PRA BAIXO    $$$$$$$$$$$$$$$$$$$$  -->

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <!--                  CABEÇALHO DO FORM  -->
                <div class="box-header">
                    <h3 class="box-title">Alterar Atividades do Relatório de Visita  </h3>
                </div>

                <div class="box-body">
                    <div class="col-sm-12">

                        <div class="row">


                            <!-- |||||||||||||||    FORMULARIO    |||||||||||||||||||||||||| -->

                            <form action="<?php echo URL_BASE . "rdv/salvaeditaratividade" ?>" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                                <!-- $$$$$$$$$$$$ DAQUI PRA BAIXAO SAO OS CAMPOS DO FORMULARIO <- <- <- <- <- <-  --> 

                                <?php foreach ($atividade as $atividades) {
                                    
                                } ?>  

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="txt_hora_ini">Inicío</label>                                    
                                            <input type="time" name="txt_hora_ini" value="<?php echo $atividades->HORA_INICIO; ?>" maxlength="5" class="form-control tip" id="txt_hora_ini" required="" />
                                        </div>
                                    </div>  


                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="txt_hora_fim">Fim</label>                                    
                                            <input type="time" name="txt_hora_fim" value="<?php echo $atividades->HORA_FIM; ?>" maxlength="5" class="form-control tip" id="txt_hora_fim" required=""/>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="txt_servico">Serviço</label>                                                                       
                                            <select name="txt_servico" class="form-control select2 tip" id="txt_servico"  required="required" style="width:100%;">
                                                <option value="IMPLANTAÇÃO"<?php echo ($atividades->SERVICO == "IMPLANTAÇÃO") ? "selected" : "" ?>> Implantação</option>
                                                <option value="TREINAMENTO"<?php echo ($atividades->SERVICO == "TREINAMENTO") ? "selected" : "" ?>> Treinamento</option>
                                                <option value="INSTALAÇÃO"<?php echo ($atividades->SERVICO == "INSTALAÇÃO") ? "selected" : "" ?>> Instalação</option>
                                                <option value="ATUALIZAÇÃO"<?php echo ($atividades->SERVICO == "ATUALIZAÇÃO") ? "selected" : "" ?>> Atualização</option>
                                                <option value="LEVANTAMENTO DE REQUISITOS"<?php echo ($atividades->SERVICO == "LEVANTAMENTO DE REQUISITOS") ? "selected" : "" ?>> Levantamento de Requisitos</option>
                                                <option value="RETREINAMENTO"<?php echo ($atividades->SERVICO == "RETREINAMENTO") ? "selected" : "" ?>> Retreinamento</option>
                                                <option value="LEVANTAMENTO DO PROCESSO ATUAL"<?php echo ($atividades->SERVICO == "LEVANTAMENTO DO PROCESSO ATUAL") ? "selected" : "" ?>> LPA </option>
                                                <option value="OCIOSIDADE"<?php echo ($atividades->SERVICO == "OCIOSIDADE") ? "selected" : "" ?>> OCIOSIDADE</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="txt_sistema">Sistema</label>                                                                       
                                            <select name="txt_sistema" class="form-control select2 tip" id="txt_sistema"  required="required" style="width:100%;">
                                                <option value="01" <?php echo ($atividades->COD_SISTEMA == "01") ? "selected" : "" ?>> Financeiro</option>
                                                <option value="02" <?php echo ($atividades->COD_SISTEMA == "02") ? "selected" : "" ?>> Almoxar</option>
                                                <option value="03" <?php echo ($atividades->COD_SISTEMA == "03") ? "selected" : "" ?>> Sementes</option>
                                                <option value="04" <?php echo ($atividades->COD_SISTEMA == "04") ? "selected" : "" ?>> Grãos</option>
                                                <option value="05" <?php echo ($atividades->COD_SISTEMA == "05") ? "selected" : "" ?>> Compras</option>
                                                <option value="06" <?php echo ($atividades->COD_SISTEMA == "06") ? "selected" : "" ?>> Fiscal</option>
                                                <option value="07" <?php echo ($atividades->COD_SISTEMA == "07") ? "selected" : "" ?>> Algodão</option>
                                                <option value="08" <?php echo ($atividades->COD_SISTEMA == "08") ? "selected" : "" ?>> Patrimônio</option>
                                                <option value="09" <?php echo ($atividades->COD_SISTEMA == "09") ? "selected" : "" ?>> Pulveriza</option>
                                                <option value="10" <?php echo ($atividades->COD_SISTEMA == "10") ? "selected" : "" ?>> Sped</option>
                                                <option value="11" <?php echo ($atividades->COD_SISTEMA == "11") ? "selected" : "" ?>> NF-e</option>
                                                <option value="12" <?php echo ($atividades->COD_SISTEMA == "12") ? "selected" : "" ?>> Compass</option>
                                                <option value="13" <?php echo ($atividades->COD_SISTEMA == "13") ? "selected" : "" ?>> Transmissão</option>
                                                <option value="14" <?php echo ($atividades->COD_SISTEMA == "14") ? "selected" : "" ?>> Crm</option>
                                                <option value="15" <?php echo ($atividades->COD_SISTEMA == "15") ? "selected" : "" ?>> Sgl</option>
                                                <option value="16" <?php echo ($atividades->COD_SISTEMA == "16") ? "selected" : "" ?>> Prestação Serviço</option>
                                                <option value="17" <?php echo ($atividades->COD_SISTEMA == "17") ? "selected" : "" ?>> Todos</option>
                                                <option value="20" <?php echo ($atividades->COD_SISTEMA == "20") ? "selected" : "" ?>> Pecuaria</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- ESSA DIV FECHA A LINHA 1 -->
                                <!-- ESSA LINHA DEVE SER EDITADA DAQUI PRA CIMA -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Atividades</label>
                                            <textarea name="txt_atividade" id="area1" class="form-control" rows="3"> <?php echo $atividades->ATIVIDADE; ?> </textarea>
                                        </div>
                                    </div>
                                </div> 


                                <!-- BOTOES DO RODAPÉ DO FORMULARIO = NAO MEXER  -->
                                <div class="box-footer">
                                    <div class="form-group">                                        
                                        <button type="button" onclick='history.go(-1)' class="btn btn-sm btn-danger btn-flat fa fa-close" data-toggle="modal" data-target="#modal-success">  Cancela</button>
                                        <button type="submit" name="add_purchase" value="Gravar"  class="btn btn-sm btn-success btn-flat fa fa-check" />   Gravar </button> 
                                    </div>
                                </div>
                                <!-- FIM DOS BOTOES  -->
                                <input type="hidden" name="seq_pla_atividade_visita" value="<?php echo $atividades->SEQ_PLA_ATIVIDADE_VISITA; ?>" >
                            </form>                    
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div> 

</section>