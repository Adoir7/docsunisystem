<!-- INICIO DA VALIDA SESSÃO --> 
<?php
if (!isset($_SESSION["usuarioLogado"]->NOME_USUARIO)) {
    header("location: " . URL_BASE);
} else {
    ?>

    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>

            @media print {
                .no-print,
                .no-print * {
                    display: none!important
                }
            }

            table { page-break-inside:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }

            .footer {
                /* position: fixed;*/
                bottom: 10;
            }

            body {
                font-family: arial;
                background-color: #fff;
                font-size: .7em
            }

            .left {
                margin: auto;
                /*width: 216mm*/
            }

            .document {
                margin: auto;
                /* width: 216mm*/
            }

            .headerBtn {
                margin: auto;
                width: 216mm;
                background-color: #fff;
                display: none
            }

            table {
                width: 100%;
                position: relative;
                border-collapse: collapse
            }

            .boletoNumber {
                width: 66%;
                font-weight: 700;
                font-size: .9em
            }

            .center {
                text-align: center
            }

            .right {
                text-align: right;
                right: 20px
            }

            td {
                position: relative
            }

            .title {
                position: absolute;
                left: 0;
                top: 0;
                font-size: .65em;
                font-weight: 700
            }

            .text {
                font-size: .9em
            }

            p.content {
                padding: 0;
                width: 100%;
                margin: 0;
                font-size: .7em
            }

            .sideBorders {
                border-left: 1px solid #000;
                border-right: 1px solid #000
            }

            hr {
                size: 1;
                border: 1px dashed;
                /*width: 216mm;*/
                margin-top: 9mm;
                margin-bottom: 9mm
            }

            br {
                content: " ";
                display: block;
                margin: 12px 0;
                line-height: 12px
            }

            .print {
                background-color: #4d90fe;
                background-image: linear-gradient(to bottom, rgb(77, 144, 254), rgb(71, 135, 237));
                border: 1px solid #3079ed;
                color: #fff;
                text-shadow: 0 1px #0000001a
            }

            .btnDefault {
                font-kerning: none;
                font-weight: 700
            }

            .btnDefault:not(:focus):not(:disabled) {
                border-color: gray
            }

            button {
                border: 1px;
                padding: 5px;
                line-height: 20px
            }

            span.iconFont {
                font-size: 20px
            }

            span.align {
                display: inline-block;
                vertical-align: middle
            }

            label {
                -moz-user-select: -moz-none;
                -khtml-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
                user-select: none
            }

            i[class*=icss-] {
                position: relative;
                display: inline-block;
                font-style: normal;
                background-color: currentColor;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                vertical-align: middle
            }

            i[class*=icss-]:after,
            i[class*=icss-]:before {
                content: "";
                border-width: 0;
                position: absolute;
                -webkit-box-sizing: border-box;
                box-sizing: border-box
            }

            i.icss-print {
                width: .68em;
                height: 1em;
                border-style: solid;
                border-color: currentcolor;
                border-width: .07em;
                -webkit-border-radius: .05em;
                border-radius: .05em;
                background-color: #0000;
                margin: 0 .17em
            }

            i.icss-print:before {
                width: 1em;
                height: .4em;
                border-width: .07em .21em 0;
                border-style: solid;
                border-color: currentColor currentcolor #0000;
                -webkit-border-radius: .05em .05em 0 0;
                border-radius: .05em .05em 0 0;
                top: .25em;
                left: 50%;
                -webkit-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                transform: translateX(-50%);
                background-image: -webkit-gradient(linear, left top, left bottom, color-stop(20%, transparent), color-stop(20%, currentcolor), color-stop(60%, currentcolor), color-stop(60%, transparent));
                background-image: -webkit-linear-gradient(transparent 20%, currentcolor 20%, currentcolor 60%, transparent 60%);
                background-image: -o-linear-gradient(transparent 20%, currentcolor 20%, currentcolor 60%, transparent 60%);
                background-image: linear-gradient(transparent 20%, currentcolor 20%, currentcolor 60%, transparent 60%)
            }

            i.icss-print:after {
                width: .45em;
                height: .065em;
                background-color: currentColor;
                left: 50%;
                -webkit-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                transform: translateX(-50%);
                top: .6em;
                -webkit-box-shadow: 0 .12em, -.1em -.28em 0 .05em;
                box-shadow: 0 .12em, -.1em -.28em 0 .05em
            }

            i.icss-files {
                width: .75em;
                height: .95em;
                background-color: #0000;
                border: .05em solid #0000;
                border-width: 0 .05em .05em 0;
                -webkit-box-shadow: inset 0 0 0 .065em, .13em .11em 0 -.05em;
                box-shadow: inset 0 0 0 .065em, .13em .11em 0 -.05em;
                -webkit-border-radius: 0 .3em 0 0;
                border-radius: 0 .3em 0 0;
                margin: 0 .17em .05em .1em
            }

            i.icss-files:before {
                border-style: solid;
                border-width: .2em;
                top: .037em;
                left: .25em;
                -webkit-border-radius: .1em;
                border-radius: .1em;
                border-color: #0000 currentColor #0000 #0000;
                -webkit-transform: rotate(-45deg);
                -ms-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }

            .logo {
                border-radius: .1em;
                border-color: #0000 currentColor #0000 #0000;

            }

        </style>

        <script>
            window.onload = function
            getUrlParams() {
                var url_string = window.location.href;
                var url = new URL(url_string);
                var fmt = url.searchParams.get("fmt");
                if (fmt === "html") {
                    document.getElementById("headerBtn").style.display = "block";
                }
            }
        </script>
        <body>

            <input type="hidden" name="SEQ_PLA_CHAMADO" value="<?php
            foreach ($listachamado as $listachamado) {
                echo $listachamado->SEQ_PLA_CHAMADO;
            }
            ?>" >  

        </head>
        <br>
        <div class="headerBtn" id="headerBtn" style="display: block;">
            <div style="text-align:right">

                <?php    //verifica se o usuario usuario que esta imprimindo é o mesmo que incluiu as atividas 
                        // se for ao cancelar volta para atividade senão volta para lista de chamados.

                if ($_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO == $listachamado->SEQ_PLA_USUARIO) { ?>

                    <button class="no-print btnDefault print " onclick="window.location = '<?php echo URL_BASE . "rdv/incluiratividade/" . $listachamado->SEQ_PLA_CHAMADO ?>'"> 
                        <i class="icss-files"></i><span class="align">&nbsp;Cancelar</span>
                    </button> 

                <?php }else {  ?>

                    <button class="no-print btnDefault print " onclick="window.location = '<?php echo URL_BASE . "rdv/index" ?>'"> 
                        <i class="icss-files"></i><span class="align">&nbsp;Cancelar</span>
                    </button> 

                <?php }  ?>

                <button class="no-print btnDefault print" onclick="window.print()"> 
                    <i class="icss-print"></i>
                    <span class="align">&nbsp;Imprimir</span>
                </button>
            </div>
        </div>
        <br>
        <!-- INICIO DO RELATORIO  -->
        <div class="document">
            <table cellspacing="3" cellpadding="3" border="1">
                <tbody>
                    <tr>
                        <td width="5%" colspan="2">
                            <img src="<?php echo URL_BASE . "" ?>assets/img/unisystem.jpg" width="244" height="74" class="Logo">
                        </td>
                        <td>
                            <table border="0" style="border:none">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>RELATÓRIO DE VISITA</b>
                                        </td>

                                        <td>
                                            <b>NR°:  
                                                <?php echo $listachamado->NR_CHAMADO; ?>  
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            &nbsp;
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <span class="text" id="buyer_document"><b>Cliente:</b> &nbsp;<?php echo $listachamado->CLIENTE; ?></spa>
                                            </td>
                                            <td align="left">
                                                <br>
                                                <span class="text" id="buyer_document">
                                                    <b>Data: 
                                                        <?php echo date('d/m/Y', strtotime($listachamado->DATA)); ?></b></span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        <table cellspacing="0" cellpadding="8" border="1">
                            <tbody>
                                <tr style="font-size:90%">
                                    <th width="24.5%" align="left">Período Trabalhado:</th>
                                    <th  align="left">

                                        <?php
                                        if ($listachamado->INI_AM != null) {
                                            echo "&nbsp;" . $listachamado->INI_AM . " ÀS " . $listachamado->FIM_AM;
                                        } else
                                        null;

                                        if ($listachamado->INI_AM != null & $listachamado->INI_PM != null) {
                                            echo "  ...   ";
                                        }

                                        if ($listachamado->INI_PM != null) {
                                            echo $listachamado->INI_PM . " ÀS " . $listachamado->FIM_PM;
                                        } else
                                        null;
                                        ?>


                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <br>

                        <table cellspacing="0" cellpadding="0" border="1">
                            <tbody><tr>
                                <th width="2.5%" align="left">Serviço</th>
                                <th width="4.2%" align="left">Módulo</th>
                                <th width="1%">Hora Inicio</th>
                                <th width="1%">Hora Fim</th>
                                <th width="30%">Descrição</th>
                                <th width="7%">Aceite</th>         
                            </tr>

                            <?php foreach ($atividadeschamado as $registros) { ?>

                                <tr style="font-size:90%">

                                    <td><?php echo $registros->SERVICO ?></td>
                                    <td align="left"><?php echo "&nbsp;" . $registros->SISTEMA ?></td>
                                    <td align="center"><?php echo $registros->HORA_INICIO ?></td>
                                    <td align="center"><?php echo $registros->HORA_FIM ?></td>
                                    <td><?php echo "&nbsp;" . $registros->ATIVIDADE ?> </td>
                                    <td></td>
                                </tr> 
                            <?php } ?> 
                        </tbody>
                    </table>

                    <br>

                    <div class="footer"> <!-- DESCOMENTAR PARA AS ASSINATURAS SAIREM NO RODAPE DA TELA -->
                        <table cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td width="50%">Analista:
                                    <hr align="left" width="80%">
                                </td> 
                                <td>
                                    &nbsp; 
                                </td>             
                                <td width="50%">Cliente/Gestor:
                                    <hr align="left" width="80%">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr style="font-size:70%">
                                <td>
                                    © 2018-<?php echo date('Y'); ?> Sistema de Gestão de Adiantamentos de Viagem</a>.</strong> Desenvolvido por: <strong> <a href="#"> Adoir Viana.</a></strong>
                                </td>
                                <td align="right">
                                    Versão 1.1.0
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--  DESCOMENTAR PARA AS ASSINATURAS SAIREM NO RODAPE DA TELA -->
                </div>

            </body>
        <?php } ?> 
        <!-- FIM DA VALIDA SESSÃO --> 
        </html>