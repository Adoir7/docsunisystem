<?php

namespace app\controllers;

use app\core\Controller;
use app\models\M_login;
use app\models\m_paineislib;

class PaineislibController extends Controller {

    public function index() {

        $logado = new M_login();
        //Verifica login do usuario
        if ($logado->estaLogado() == false) {
            header("location: " . URL_BASE . "login");
        } //fim da verificação

        $paineis = new m_paineislib();
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
		
		$dados["ch_portester"] = $paineis->ch_portester();
		
        $dados["view"] = "paineislib/index";
        $this->load("template", $dados);
		
		
    }
	
	public function lista ($analista){
		
		$paineis = new m_paineislib();		
		
		
		$dados["lista_ch_aguardando"] = $paineis->lista_chamados_analista($analista);
		
		$dados["view"] = "paineislib/lista";
        $this->load("template", $dados);
		
	}


}
