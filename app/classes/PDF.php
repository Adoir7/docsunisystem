<?php

  namespace app\classes;
  use app\classes\fpdf;

class PDF extends FPDF{

		/*  Comentado por Adoir em 07/12/18 aqui define-se padrões para o tipo de documento
			porem o certo é definir no momento da impressao (relatorio), por isso foi comentado.
		public function __construct(){
		 parent::__construct("L", "pt");
		}
		*/

	// Page header
	function Header()
	{
	    // Logo obrigatório "png"
	    $logo = URL_BASE . 'assets/img/unisystem.png';	    
	    $this->Image($logo, 40, 30, 150, 50);
	    // Arial bold 15
	    $this->SetFont('Arial','B',15);
	    // Title
	    $this->Cell(540,50,utf8_decode('Gestão de Projetos Unisystem'),1,0,'C');
	    // Line break
	    $this->Ln(55);
	} 

	// Page footer
	function Footer(){
	    // Position at 1.5 cm from bottom
	    $this->SetY(-30);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(540,10,utf8_decode('Unisystem © 2018-2019 Sistema de Gerenciamento de Projetos. Todos os direitos reservados.'),1,'C');
	    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'R');
	}

	function contaLinhas($text, $maxwidth){	
		$lines=0;
		if($text==''){
			$cont = 1;
		}else{
			$cont = strlen($text);
		}
		if($cont < $maxwidth){
			$lines = 1;
		}else{
			if($cont % $maxwidth > 0){
				$lines = ($cont / $maxwidth) + 1; 
			}else{
				$lines = ($cont / $maxwidth); 
			}
		} 
		$lines = $lines + substr_count(nl2br($text),'
	');
		return $lines;
	}
	    
}


?>