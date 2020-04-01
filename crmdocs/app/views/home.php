 <!-- Main content -->
 <section class="content">

   <!--  INICIA COMENTARIO DOS TOTALIZADORES DE CHAMADOS 
 
         <?php  // somente usuario pode usar atualizador.
          $admin = $_SESSION["usuarioLogado"]->APELIDO;
          if ($admin == 'ADOIR') { ?>     
            <div class="row">
              <!-- /.info-box  POSICAO GERAL DOS CHAMADOS --
                 <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-download-outline"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">TOTAL DE CHAMADOS</span>
                          <span class="info-box-number"> 
                            <?php
                            foreach ($chamados as $total_chamados) {
                              echo $total_chamados;
                            } ?>
                          </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-red"><i class="ion ion-ios-upload-outline"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">CANCELADOS</span>
                        <span class="info-box-number">
                          <?php
                          foreach ($cancelados as $cancelados) {
                            echo $cancelados;
                          }

                          ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="clearfix visible-sm-block"></div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="ion-android-done-all"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">RESOLVIDOS</span>
                        <span class="info-box-number">
                          <?php
                          foreach ($resolvidos as $resolvidos) {
                            echo $resolvidos;
                          }

                          ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-red"><i class="ion ion-social-usd"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">PENDENTES</span>
                        <span class="info-box-number">
                        <?php
                        foreach ($pendentes as $pendentes) {
                          echo $pendentes;
                        }

                        ?>
                                
                              </span>
                      </div>
                    </div>
                  </div>
                 <!-- /. FECHA INFO-box             ADOIR VIANA  --
            </div>   
         <?php  } ?>
      
        FECHA COMENTARIO DOS TOTALIZADORES DE CHAMADOS  -->

   <div class="row">
     <div class="col-md-12">
       <div class="box box-success">
         <div class="box-header with-border">
           <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Fechar">
               <i class="fa fa-times"></i>
             </button>
           </div>
           <!-- Application buttons -->
           <h3 class="box-title">Opções</h3>
         </div>
         <div class="box-body">
           <p>Opções disponiveis pra você</p>

           <a href="<?php echo URL_BASE . 'rdv/index' ?>" class="btn btn-app">
             <span class="badge bg-green"></span>
             <i class="fa  fa-search"></i>Pesquisar
           </a>

           <a href="<?php echo URL_BASE . 'rdv/incluir' ?>" class="btn btn-app">
             <span class="badge bg-green"></span>
             <i class="fa fa-newspaper-o"></i>Novo RDV
           </a>

           <a href="<?php echo URL_BASE . 'projeto/index' ?>" class="btn btn-app">
             <i class="fa fa-group"></i>Projetos
           </a>

           <a href="<?php echo URL_BASE . 'agenda' ?>" class="btn btn-app">
             <i class="fa fa-calendar"></i>Agenda
           </a>

           <a href="<?php echo URL_BASE . 'paineiscq/index' ?>" class="btn btn-app">
             <i class="fa fa-bar-chart"></i>CQ
           </a>

           <a href="<?php echo URL_BASE . 'paineislib/index' ?>" class="btn btn-app">
             <i class="fa fa-thumbs-up"></i>LIBERADOR
           </a>

           <a href="<?php echo URL_BASE . 'paineiscq/pesquisa' ?>" class="btn btn-app">
             <i class="fa fa-search"></i>PSQ CQ
           </a>

<!-- 
           <?php  // somente usuario pode usar atualizador.
            //$admin = $_SESSION["usuarioLogado"]->APELIDO;
            //if ($admin == 'ADOIR') { ?>

             <a href="<?php //echo URL_BASE . 'home/atualizador' ?>" class="btn btn-app">
               <i class="fa fa-gears"></i>Atualizador
             </a>

             <a href="<?php //echo URL_BASE . 'home/vrdv' ?>" class="btn btn-app">
               <i class="fa fa-car"></i>RDV
             </a>


           <?php //} ?> -->

         </div>
         <!-- /.box-body -->
       </div>
     </div>
   </div>


 </section>