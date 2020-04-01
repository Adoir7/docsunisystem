<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Home;
use app\models\M_Rdv;
use app\models\M_login;
use app\classes\pdf;

class HomeController extends Controller {

    public function testepdf() {
        // Instanciation of inherited class
        $pdf = new PDF();
    }

    public function index() {

        $logado = new M_login();
        //Verifica login do usuario
        if ($logado->estaLogado() == false) {
            header("location: " . URL_BASE . "login");
        } //fim da verificação

        $home = new home();

        $rdv = new m_rdv(); // instancia model RDV para listar os chamados do usuario na HOME.
        //$filtro = 'P';
        $usuariologado = $_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO;
        $dados["rdv"] = $rdv->listardv($usuariologado, $filtro_situacao = 'P', null);

        $dados["chamados"] = $home->chamados();
        $dados["cancelados"] = $home->cancelados();
        $dados["resolvidos"] = $home->resolvidos();
        $dados["pendentes"] = $home->pendentes();

        $dados["view"] = "home";

        //Verifica AQUI PQ NAO ESTA OBTENDO A SESSAO 
        $this->load("template", $dados);
    }


    public function grafico() {
       
        $home = new home();
       
        $dados["grafico"] = $home->grafico();   

        $dados["view"] = "grafico";
        $this->load("template", $dados);
    }


    public function atualizador() {
        $home = new home();
        $home->atualizador();
        header("location: " . URL_BASE);
    }

}
