<section class="content">

    <div class="box box-success">         
        <div class="box-header with-border">
            <a href="<?php echo URL_BASE . "categoria/index" ?>">
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
                    <h3 class="box-title">Por favor, preencha as informações abaixo</h3>
                </div>

                <div class="box-body">
                    <div class="col-lg-12">

                        <!-- |||||||||||||||    FORMULARIO    |||||||||||||||||||||||||| -->

                        <form action="<?php echo URL_BASE . "categoria/salvar" ?>" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                            <!-- <PRIMEIRA LINHA DO FORM > -->
                            <div class="row">

                                <!-- $$$$$$$$$$$$ DAQUI PRA BAIXAO SAO OS CAMPOS DO FORMULARIO <- <- <- <- <- <-  --> 

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc_categoria">Categoria</label>                                    
                                        <input type="text" name="desc_categoria" value="<?php echo $categoria->categoria; ?>"  class="form-control tip" id="desc_categoria" required="required"  />
                                    </div>
                                </div>

                                <!-- ESSA LINHA DEVE SER EDITADA DAQUI PRA CIMA -->
                            </div> <!-- ESSA DIV FECHA A LINHA 1 -->

                            <!-- <FIM DA PRIMEIRA LINHA> -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_ativo">Ativo</label>
                                        <select name="txt_ativo" class="form-control select2 tip" id="txt_ativo"  required="required" style="width:100%;">
                                            <option value="S" <?php echo ($categoria->ativo_categoria == "S") ? "selected" : "" ?>> Sim</option>
                                            <option value="N" <?php echo ($categoria->ativo_categoria == "N") ? "selected" : "" ?>> Não</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_mostrar_menu">Mostrar no menu</label>                                                                       
                                        <select name="txt_mostrar_menu" class="form-control select2 tip" id="txt_mostrar_menu"  required="required" style="width:100%;">
                                            <option value="S" <?php echo ($categoria->mostrar_no_menu == "S") ? "selected" : "" ?>> Sim</option>
                                            <option value="N" <?php echo ($categoria->mostrar_no_menu == "N") ? "selected" : "" ?>> Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- BOTOES DO RODAPÉ DO FORMULARIO = NAO MEXER  -->

                            <div class="box-footer">
                                <div class="form-group">
                                    <button type="submit" name="add_purchase" value="Gravar"  class="btn btn-lg btn-success btn-flat  fa fa-download" />   Salvar </button> 
                                    <button type="reset" id="reset" class="btn btn-lg bg-navy btn-flat fa fa-pencil">  Limpar</button>
                                    <a href="<?php echo URL_BASE . "categoria/index" ?>">
                                        <button type="button" class="btn btn-lg btn-danger btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">  Voltar Para Lista</button>
                                    </a>
                                </div>
                            </div>

                            <!-- FIM DOS BOTOES  -->

                            <input type="hidden" name="id_categoria" value="<?php echo $categoria->id_categoria ?>" >



                        </form>                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
