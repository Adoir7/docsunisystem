<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Relatoriosvisita;
use app\models\crm;
use app\models\M_login;
//use app\classes\fpdf;
use app\classes\pdf;

class CrmController extends Controller {

    public function index() {


        $crm = new crm();

        $dados["crm"] = $crm->lista_andamentos();
        $dados["prox"] = $crm->proximo_analista($seq_pla_chamado, $sequencia);
        $dados["view"] = "crm/index";
        $this->load("template", $dados);
    }


}
