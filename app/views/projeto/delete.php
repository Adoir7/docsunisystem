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




    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Por favor, preencha as informações abaixo</h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <form action="http://localhost/pos/purchases/add" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <input type="hidden" name="spos_token" value="6ed6145943334e6bf52a4eb86de42f94" style="display:none;" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date:</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reference">Referência</label>                                    <input type="text" name="reference" value=""  class="form-control tip" id="reference" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Pesquisa do produto por código ou nome, você pode fazer a varredura do código de barras também" id="add_item" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="poTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr class="active">
                                                    <th>Produto</th>
                                                    <th class="col-xs-2">Qtd</th>
                                                    <th class="col-xs-2">Custo Unitário</th>
                                                    <th class="col-xs-2">Subtotal</th>
                                                    <th style="width:25px;"><i class="fa fa-trash-o"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5">Adicionar o produto através de pesquisa no campo acima</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="active">
                                                    <th>Total</th>
                                                    <th class="col-xs-2"></th>
                                                    <th class="col-xs-2"></th>
                                                    <th class="col-xs-2 text-right"><span id="gtotal">0.00</span></th>
                                                    <th style="width:25px;"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier">Fornecedor</label>                                                                        <select name="supplier" class="form-control select2 tip" id="supplier"  required="required" style="width:100%;">
                                            <option value="" selected="selected">Selecione Fornecedor</option>
                                            <option value="2">thiago</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="received">Recebido</label>                                                                        <select name="received" class="form-control select2 tip" id="received"  required="required" style="width:100%;">
                                            <option value="1">Recebido</option>
                                            <option value="0">Não recebido ainda</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Imagem</label>                                    <input type="file" name="userfile" id="image" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control " disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="image" class="btn btn-default "><span class="fa fa-folder-open"></span> Choose file</label></span></div>
                            </div>
                            <div class="form-group">
                                <label for="note">Informações</label>
                                <textarea name="note" cols="40" rows="10"  class="form-control redactor" id="note"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="add_purchase" value="Gravar"  class="btn btn-lg btn-success btn-flat  fa fa-download" />   Salvar </button> 
                                <button type="reset" id="reset" class="btn btn-lg bg-navy btn-flat fa fa-pencil">  Limpar</button>
                                <a href="<?php echo URL_BASE . "categoria/index" ?>">
                                    <button type="button" class="btn btn-lg btn-danger btn-flat fa fa-reply" data-toggle="modal" data-target="#modal-success">  Voltar Para Lista</button>
                                </a>
                            </div>

                        </form>                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
