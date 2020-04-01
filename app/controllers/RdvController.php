<?php

namespace app\controllers;

use app\core\Controller;
use app\models\M_login;
use app\models\M_Rdv;

class RdvController extends Controller {

    public function index() {

        $logado = new M_login();
        //Verifica login do usuario
        if ($logado->estaLogado() == false) {
            header("location: " . URL_BASE . "login");
        } //fim da verificação

        $rdv = new m_rdv();
        $usuario = new M_login();


        //filtro para chamados pendentes ou resolvidos       
        $filtro_situacao = isset($_POST["txt_filtro_situacao"]) ? strip_tags(filter_input(INPUT_POST, "txt_filtro_situacao")) : 'P';
        $filtro_cliente  = isset($_POST["txt_filtro_cliente"]) ? strip_tags(filter_input(INPUT_POST, "txt_filtro_cliente")) : null;
        
        $usuariologado =  isset($_POST["txt_filtro_usuario"]) ? strip_tags(filter_input(INPUT_POST, "txt_filtro_usuario")) : $_SESSION["usuarioLogado"]->SEQ_PLA_USUARIO;

        $dados["usuario"] = $usuario->getusuarios();
        $dados["cliente"] = $rdv->getcliente();
        $dados["rdv"] = $rdv->listardv($usuariologado, $filtro_situacao, $filtro_cliente);

        $dados["view"] = "rdv/index";
        $this->load("template", $dados);
    }

    public function imprimir($seq_pla_chamado) {

        $rdv = new m_rdv();

        $dados["listachamado"] = $rdv->listachamado($seq_pla_chamado);
        $dados["atividadeschamado"] = $rdv->atividadeschamado($seq_pla_chamado);

        $this->load("rdv/impressao", $dados);
    }

    public function finalizar($seq_pla_chamado) {

        $rdv = new m_rdv();
        $rdv->finalizar($seq_pla_chamado);

        header("location: " . URL_BASE . "rdv/index/");
    }

    public function incluiratividade($seq_pla_chamado) {

        $rdv = new m_rdv();

        $dados["listachamado"] = $rdv->listachamado($seq_pla_chamado);
        $dados["atividadeschamado"] = $rdv->atividadeschamado($seq_pla_chamado);


        $dados["view"] = "rdv/atividades";
        $this->load("template", $dados);
    }

    public function incluir() {
        $rdv = new m_rdv();

        $dados["ocorrencia"] = $rdv->ocorrencia();
        $dados["solicitante"] = $rdv->solicitante();

        $dados["view"] = "rdv/create";
        $this->load("template", $dados);
    }

    public function salvar() {

        $rdv = new m_rdv();

        $txt_nr_chamado = $rdv->ultimochamado();
        $txt_nr_relatorio = $rdv->ultimochamado();

        $txt_nr_chamado = $txt_nr_chamado[0] + 1;
        $txt_nr_relatorio = $txt_nr_relatorio[0] + 1;

        $txt_data_chamado = isset($_POST["txt_data_chamado"]) ? strip_tags(filter_input(INPUT_POST, "txt_data_chamado")) : null;
        $txt_data_relatorio = isset($_POST["txt_data_relatorio"]) ? strip_tags(filter_input(INPUT_POST, "txt_data_relatorio")) : null;
        $txt_ini_am = isset($_POST["txt_ini_am"]) ? strip_tags(filter_input(INPUT_POST, "txt_ini_am")) : null;
        $txt_fim_am = isset($_POST["txt_fim_am"]) ? strip_tags(filter_input(INPUT_POST, "txt_fim_am")) : null;
        $txt_ini_pm = isset($_POST["txt_ini_pm"]) ? strip_tags(filter_input(INPUT_POST, "txt_ini_pm")) : null;
        $txt_fim_pm = isset($_POST["txt_fim_pm"]) ? strip_tags(filter_input(INPUT_POST, "txt_fim_pm")) : null;
        $txt_ocorrencia = isset($_POST["txt_ocorrencia"]) ? strip_tags(filter_input(INPUT_POST, "txt_ocorrencia")) : null;
        $txt_solicitante = isset($_POST["txt_solicitante"]) ? strip_tags(filter_input(INPUT_POST, "txt_solicitante")) : null;
        $txt_sistema = isset($_POST["txt_sistema"]) ? strip_tags(filter_input(INPUT_POST, "txt_sistema")) : null;
        $txt_desc_breve = isset($_POST["txt_desc_breve"]) ? strip_tags(filter_input(INPUT_POST, "txt_desc_breve")) : null;
        $txt_detalhes = isset($_POST["txt_detalhes"]) ? strip_tags(filter_input(INPUT_POST, "txt_detalhes")) : null;
        $txt_empresa = isset($_POST["txt_empresa"]) ? strip_tags(filter_input(INPUT_POST, "txt_empresa")) : null;
        $txt_filial = isset($_POST["txt_filial"]) ? strip_tags(filter_input(INPUT_POST, "txt_filial")) : null;
        $txt_usuariologado = isset($_POST["txt_usuariologado"]) ? strip_tags(filter_input(INPUT_POST, "txt_usuariologado")) : null;

        //echo $seq_cliente, $horas_projeto, $HORAS;
        $novo_chamado = $rdv->gravaincluir($txt_desc_breve, $txt_ocorrencia, $txt_solicitante, $txt_sistema, $txt_nr_chamado, $txt_nr_relatorio, $txt_data_chamado, $txt_data_relatorio, $txt_ini_am, $txt_fim_am, $txt_ini_pm, $txt_fim_pm, $txt_detalhes, $txt_usuariologado);

        header("location: " . URL_BASE . "rdv/incluiratividade/" . $novo_chamado->CHAMADO);
    }

    public function salvaeditarchamado() {

        $rdv = new m_rdv();

        $txt_seq_pla_chamado = isset($_POST["txt_seq_pla_chamado"]) ? strip_tags(filter_input(INPUT_POST, "txt_seq_pla_chamado")) : null;
        $txt_ini_am = isset($_POST["txt_ini_am"]) ? strip_tags(filter_input(INPUT_POST, "txt_ini_am")) : null;
        $txt_fim_am = isset($_POST["txt_fim_am"]) ? strip_tags(filter_input(INPUT_POST, "txt_fim_am")) : null;
        $txt_ini_pm = isset($_POST["txt_ini_pm"]) ? strip_tags(filter_input(INPUT_POST, "txt_ini_pm")) : null;
        $txt_fim_pm = isset($_POST["txt_fim_pm"]) ? strip_tags(filter_input(INPUT_POST, "txt_fim_pm")) : null;

        $rdv->gravaeditarhorachamado($txt_seq_pla_chamado, $txt_ini_am, $txt_fim_am, $txt_ini_pm, $txt_fim_pm);

        header("location: " . URL_BASE . "rdv/incluiratividade/" . $txt_seq_pla_chamado);
    }

    public function salvaratividades() {

        $rdv = new m_rdv();

        $txt_seq_pla_chamado = isset($_POST["txt_seq_pla_chamado"]) ? strip_tags(filter_input(INPUT_POST, "txt_seq_pla_chamado")) : null;
        $txt_servico = isset($_POST["txt_servico"]) ? strip_tags(filter_input(INPUT_POST, "txt_servico")) : null;
        $txt_sistema = isset($_POST["txt_sistema"]) ? strip_tags(filter_input(INPUT_POST, "txt_sistema")) : null;
        $txt_hora_ini = isset($_POST["txt_hora_ini"]) ? strip_tags(filter_input(INPUT_POST, "txt_hora_ini")) : null;
        $txt_hora_fim = isset($_POST["txt_hora_fim"]) ? strip_tags(filter_input(INPUT_POST, "txt_hora_fim")) : null;
        $txt_atividade = $_POST["txt_atividade"];

        //echo $seq_cliente, $horas_projeto, $HORAS;
        $rdv->gravaincluiratividades($txt_seq_pla_chamado, $txt_servico, $txt_sistema, $txt_hora_ini, $txt_hora_fim, $txt_atividade);

        header("location: " . URL_BASE . "rdv/incluiratividade/" . $txt_seq_pla_chamado);
    }

    public function editaratividade($seq_pla_atividade_visita) {

        $rdv = new m_rdv();

        $dados["atividade"] = $rdv->getAtividadeVisita($seq_pla_atividade_visita);

        $dados["view"] = "rdv/edit";
        $this->load("template", $dados);
    }

    public function salvaeditaratividade() {

        $rdv = new m_rdv();

        $txt_hora_ini = isset($_POST["txt_hora_ini"]) ? strip_tags(filter_input(INPUT_POST, "txt_hora_ini")) : null;
        $txt_hora_fim = isset($_POST["txt_hora_fim"]) ? strip_tags(filter_input(INPUT_POST, "txt_hora_fim")) : null;
        $txt_servico = isset($_POST["txt_servico"]) ? strip_tags(filter_input(INPUT_POST, "txt_servico")) : null;
        $txt_sistema = isset($_POST["txt_sistema"]) ? strip_tags(filter_input(INPUT_POST, "txt_sistema")) : null;
        $txt_atividade = $_POST["txt_atividade"];
        $txt_seq_pla_atividade_visita = isset($_POST["seq_pla_atividade_visita"]) ? strip_tags(filter_input(INPUT_POST, "seq_pla_atividade_visita")) : null;

        $chamado = $rdv->gravaalteraratividade($txt_seq_pla_atividade_visita, $txt_servico, $txt_sistema, $txt_hora_ini, $txt_hora_fim, $txt_atividade);

        header("location: " . URL_BASE . "rdv/incluiratividade/" . $chamado->SEQ_PLA_CHAMADO);
    }

    public function delete($seq_pla_atividade_visita) {

        $rdv = new m_rdv();

        $rdv = $rdv->deleteatividade($seq_pla_atividade_visita);

        header("location: " . URL_BASE . "rdv/incluiratividade/" . $rdv->SEQ_PLA_CHAMADO);
    }

}
