<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Relatoriosvisita;
use app\models\Projeto;
use app\models\M_login;
//use app\classes\fpdf;
use app\classes\pdf;

class RelatoriosvisitaController extends Controller {

    public function index($seq_cliente) {

        $logado = new M_login();
        //Verifica login do usuario
        if ($logado->estaLogado() == false) {
            header("location: " . URL_BASE . "login");
        } //fim da verificação

        $relatoriosvisita = new relatoriosvisita();
        $projeto = new projeto();

        $dados["relatoriosvisita"] = $relatoriosvisita->lista($seq_cliente);
        $dados["projetos"] = $projeto->projetos($seq_cliente);

        $dados["view"] = "relatoriosvisita/index";
        $this->load("template", $dados);
    }

    public function imprimir($seq_cliente) {

        $relatoriosvisita = new relatoriosvisita();
        $projeto = new projeto();

        $dados["relatoriosvisita"] = $relatoriosvisita->lista($seq_cliente);
        $dados["projetos"] = $projeto->projetos($seq_cliente);

        $pdf = new PDF("P", "pt", "A4");

        $pdf->AddPage();
        $pdf->AliasNbPages();

        // cabeçalho com os dados do Projeto 
        $pdf->SetFillColor(022, 80, 70);
        $pdf->SetTextColor(255);
        $pdf->SetFont('Arial', '', 10);

        // cabeçalho
        $pdf->Cell(220, 20, "Projeto", 1, 0, "C", true);
        $pdf->Cell(100, 20, "Horas de Projeto", 1, 0, "C", true);
        $pdf->Cell(100, 20, "Executadas", 1, 0, "C", true);
        $pdf->Cell(120, 20, "Saldo", 1, 0, "C", true);

        $pdf->ln();

        $pdf->SetFillColor(120, 200, 200);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 8);

        // Dados do Projeto
        $projeto = $projeto->projetos($seq_cliente);

        foreach ($projeto as $lista) {

            $pdf->Cell(220, 20, $lista->CLIENTE, 1, 0, "C", true);
            $pdf->Cell(100, 20, date($lista->TOTAL_PROJETO), 1, 0, "C", true);
            $pdf->Cell(100, 20, $lista->EXECUTADO, 1, 0, "C", true);
            $pdf->Cell(120, 20, $lista->SALDO, 1, 0, "C", true);
            $pdf->ln();
        }
        //FIm dos dados dos Dados do Projeto (Cabeçalho)

        $pdf->ln(5); //pula linha dos dados do projeto para os relatorios de visita


        /*         * *****************************************************************************
         * DAQUI PRA BAIXO IMPRIME OS RELATORIOS DE VISITA                              *
         * ***************************************************************************** */

        $pdf->SetFillColor(180, 80, 70);
        $pdf->SetTextColor(255);

        // cabeçalho
        $pdf->Cell(70, 20, utf8_decode("Relatório"), 1, 0, "C", true);
        $pdf->Cell(70, 20, "Data", 1, 0, "C", true);
        $pdf->Cell(40, 20, "Ini_AM", 1, 0, "C", true);
        $pdf->Cell(40, 20, "Fim_AM", 1, 0, "C", true);
        $pdf->Cell(40, 20, "Ini_PM", 1, 0, "C", true);
        $pdf->Cell(40, 20, "Fim_PM", 1, 0, "C", true);
        $pdf->Cell(40, 20, "Horas", 1, 0, "C", true);
        $pdf->Cell(200, 20, "Analista", 1, 0, "C", true);

        $pdf->ln();

        $pdf->SetFillColor(200, 200, 200);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 8);

        // Dados do Relatório
        $zebrado = false;
        $relatorios = $relatoriosvisita->lista($seq_cliente);

        foreach ($relatorios as $lista) {

            $pdf->Cell(70, 20, $lista->NR_RELATORIO, 1, 0, "C", $zebrado);
            //$pdf->Cell(70,20,$lista->DATA_RELATORIO,1,0,"C",$zebrado);
            $pdf->Cell(70, 20, date('d/m/Y', strtotime($lista->DATA_RELATORIO)), 1, 0, "C", $zebrado);
            $pdf->Cell(40, 20, $lista->HORA_INI_AM, 1, 0, "C", $zebrado);
            $pdf->Cell(40, 20, $lista->HORA_FIM_AM, 1, 0, "C", $zebrado);
            $pdf->Cell(40, 20, $lista->HORA_INI_PM, 1, 0, "C", $zebrado);
            $pdf->Cell(40, 20, $lista->HORA_FIM_PM, 1, 0, "C", $zebrado);
            $pdf->Cell(40, 20, $lista->TOTAL, 1, 0, "C", $zebrado);
            $pdf->Cell(200, 20, $lista->ANALISTA_ATUAL, 1, 0, "C", $zebrado);
            $pdf->ln();
            $zebrado = !$zebrado;
        }

        $nomearquivo = "Projeto " . $lista->CLIENTE . ".pdf"; //nome do arquivo que vai ser salvo.
        $pdf->Output($nomearquivo, 'I');
        //$pdf->Output();
    }

}
