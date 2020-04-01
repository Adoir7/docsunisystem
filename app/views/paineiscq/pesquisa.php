<section class="content">
  <div class="box box-success">
    <div class="box-header with-border">
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Fechar">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>

    <div class="box-body">
      <form method="POST" action="<?php echo URL_BASE . "paineiscq/pesquisar" ?>">
        <div class="row">
          <div class="col-xs-4">
            <input type="text" name="txt_text_pesquisa" class="form-control" placeholder="Digite aqui oque deseja procurar nos andamentos dos chamados" required="" minlength="4">
          </div>
          <!-- 
            <div class="col-xs-2">
              <select name="txt_filtro_usuario" class="form-control select2 tip" id="txt_filtro_usuario" style="width:100%;">
                <option value="<?php echo $_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO ?>"> <?php echo $_SESSION["usuarioLogado"]->APELIDO ?> </option>
                <?php
                foreach ($usuario as $registros) {
                  echo "<option value='$registros->SEQ_PLA_USUARIO'> " . $registros->APELIDO . " </option>";
                }
                ?>
                <option value="TODOS">TODOS</option>
              </select>
            </div>        
            
            <div class="col-xs-7">
              <input type="text" class="form-control" placeholder="Digite aqui oque deseja procurar">
            </div> 
          -->
          <div class="col-xs-2">
            <button type="subimit" class="btn btn-lg  btn-flat bg-purple fa fa-search"> Pesquisar </button>
          </div>
        </div>
      </form>
    </div>


  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">

        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">

              <thead>
                <tr>
                  <th>CHAM</th>
                  <th>DATA</th>
                  <th>CLIENTE</th>
                  <th>SOLICITANTE</th>
                  <th>DESCRICAO_BREVE</th>
                  <th>OCORRENCIA</th>
                  <th>MENU</th>
                  <th>OPCAO</th>
                </tr>
              </thead>

              <tbody>

                <?php   //verifico se existe uma pesquisa para carregar os dados.
                if ($pesquisa) {
                  foreach ($pesquisa as $registros) { ?>

                    <tr role="row" class="even">
                      <td class="sorting_1"><?php echo $registros->NR_CHAMADO ?></td>
                      <td><?php echo date('d/m/Y', strtotime($registros->DATA_CHAMADO)) ?></td>
                      <td><?php echo $registros->CLIENTE ?></td>
                      <td><?php echo $registros->SOLICITANTE ?></td>
                      <td><?php echo $registros->DESCRICAO_BREVE ?></td>
                      <td><?php echo $registros->OCORRENCIA ?></td>
                      <td><?php echo $registros->MENU ?> </td>
                      <td><?php echo $registros->OPCAO ?></td>
                    </tr>

                <?php } //finaliza o if 
                } else null //se nao exisitir pesquisa recebe null 
                ?>

              </tbody>
            </table>
          </div>
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