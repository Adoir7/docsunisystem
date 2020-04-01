<?php

namespace app\controllers;

use app\core\Controller;
use app\models\M_login;
use app\models\m_paineiscq;

class PaineiscqController extends Controller
{

    public function index()
    {

        $logado = new M_login();
        //Verifica login do usuario
        if ($logado->estaLogado() == false) {
            header("location: " . URL_BASE . "login");
        } //fim da verificação

        $paineis = new m_paineiscq();
        /*/
        /*'  26456401' - CQCOMPAS
        /*'  47932601' - LIBERADOR
        /*'  50133201' - SIGA VERSAO FECHADA
        /*/
        // PASSO COMO PARAMETRO O SEQPLA DO ANALISTA PARA A CONSULTA.

        //SIGACQ
        $dados["totalchamadoscq"]  = $paineis->totalchamados('  26456401');
        $dados["ocorrenciasigacq"] = $paineis->qtd_ocorrencias('  26456401');
        //LIBERADOR
        $dados["totalchamadoslib"] = $paineis->totalchamados('  47932601');
        $dados["ocorrenciaslib"]   = $paineis->qtd_ocorrencias('  47932601');
        //SIGAVERSAO FECHADA
        $dados["totalchamadossvf"] = $paineis->totalchamados('  50133201');
        $dados["ocorrenciassvf"]   = $paineis->qtd_ocorrencias('  50133201');

        //quantidade de chamados devolvidos pelo CQ e aguardando ajustes.
        $dados["aguardando_ajustes"] = $paineis->aguardando_ajustes();
        $dados["aguardando_portipo"] = $paineis->aguardando_portiporetorno();
        //print_r($paineis->aguardando_ajustes());

        $dados["lista_ch_aguardando"] = $paineis->relacao_ch_aguardando();

        $dados["view"] = "paineiscq/index";
        $this->load("template", $dados);
    }

    public function lista($analista)
    {

        $paineis = new m_paineiscq();


        $dados["lista_ch_aguardando"] = $paineis->lista_chamados_analista($analista);

        $dados["view"] = "paineiscq/lista";
        $this->load("template", $dados);
    }

    public function pesquisa()
    {
        //chama a tela de pesquisa
        $dados["pesquisa"] = '';
        $dados["view"] = "paineiscq/pesquisa";
        $this->load("template", $dados);
    }

    public function pesquisar(){

        $paineis = new m_paineiscq();

        //filtro para chamados pendentes ou resolvidos       
        $filtro = isset($_POST["txt_text_pesquisa"]) ? strip_tags(filter_input(INPUT_POST, "txt_text_pesquisa")) : null;
        //$filtro_cliente  = isset($_POST["txt_filtro_cliente"]) ? strip_tags(filter_input(INPUT_POST, "txt_filtro_cliente")) : null;

        //$usuariologado =  isset($_POST["txt_filtro_usuario"]) ? strip_tags(filter_input(INPUT_POST, "txt_filtro_usuario")) : $_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO;

        //$dados["usuario"] = $usuario->getusuarios();
        //$dados["cliente"] = $rdv->getcliente();

        $length = (strlen($filtro));

        if ($length >3 ){ 
        $dados["pesquisa"] = $paineis->pesquisa_andamento($filtro);
        
        $dados["view"] = "paineiscq/pesquisa";
        $this->load("template", $dados);
    } else exit;



    }
}
