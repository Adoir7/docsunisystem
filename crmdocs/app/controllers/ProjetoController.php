<?php

namespace app\controllers;

use app\core\Controller;
use app\models\M_login;
use app\models\Projeto;
use app\classes\fpdf;

class ProjetoController extends Controller {

    public function index() {

        $logado = new M_login();
        //Verifica login do usuario
        if ($logado->estaLogado() == false) {
            header("location: " . URL_BASE . "login");
        } //fim da verificação

        $projeto = new projeto();

        $dados["quantidade"] = $projeto->quantidade();
        $dados["andamento"] = $projeto->projetoscomsaldo();
        $dados["estourado"] = $projeto->projetosestourados();
        $dados["saldo"] = $projeto->saldo();

        $dados["projetos"] = $projeto->lista();
        $dados["view"] = "projeto/index";
        $this->load("template", $dados);
    }

    public function edit($seq_cliente) {

        $projeto = new projeto();

        $dados["cliente"] = $projeto->editar($seq_cliente);

        $dados["view"] = "projeto/edit";
        $this->load("template", $dados);
    }

    public function salvar() {

        $projeto = new projeto(); //Aqui instancia o models categoria que foi declarado acima.

        $seq_cliente = isset($_POST["seq_cliente"]) ? strip_tags(filter_input(INPUT_POST, "seq_cliente")) : null;
        $horas_projeto = isset($_POST["horas_projeto"]) ? strip_tags(filter_input(INPUT_POST, "horas_projeto")) : null;
        $horas_aditivo = isset($_POST["horas_aditivo"]) ? strip_tags(filter_input(INPUT_POST, "horas_aditivo")) : null;
        $data_projeto = isset($_POST["data_projeto"]) ? strip_tags(filter_input(INPUT_POST, "data_projeto")) : null;
        $projeto_finalizado = isset($_POST["projeto_finalizado"]) ? strip_tags(filter_input(INPUT_POST, "projeto_finalizado")) : null;

        //echo $seq_cliente, $horas_projeto, $HORAS;
        $projeto->gravaeditar($seq_cliente, $horas_projeto, $horas_aditivo, $data_projeto);

        header("location: " . URL_BASE . "projeto");
    }

}
