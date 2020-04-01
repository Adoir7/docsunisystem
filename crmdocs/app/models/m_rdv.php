<?php

namespace app\Models;
use app\core\Model;

class M_rdv extends Model {

	public function __construct(){
		parent:: __construct();
	}

	public function listardv($usuariologado, $filtro_situacao, $filtro_cliente){

		$condicoes = "";

		$sql = "SELECT cc.seq_pla_chamado,
						cc.nr_chamado,
						cc.seq_pla_usuario,
						trunc(cc.data_chamado) as data,
						cc.relatorio_visita,
						cc.data_relatorio,
						cc.descricao_breve,
						co.ocorrencia,
						cc.situacao,
						cc.rv_hora_ini_am as ini_am,
						cc.rv_hora_fim_am as fim_am,
						cc.rv_hora_ini_pm as ini_pm,
						cc.rv_hora_fim_pm as fim_pm,
						cl.nome_fantasia as cliente,
						u.apelido,
						so.nome_solicitante as solicitante
		from crm_chamados        cc,
			crm_solicitantes    so,
			clientes            cl,
			clientes_enderecos  ce,
			crm_ocorrencias     co,
			usuarios            u
		where ce.seq_pla_cliente 	 = cl.seq_pla_cliente
		and   so.seq_pla_endereco 	 = ce.seq_pla_endereco
		and   cc.seq_pla_solicitante = so.seq_pla_solicitante
		and   co.seq_pla_ocorrencia  = cc.seq_pla_ocorrencia
		and   cc.seq_pla_usuario     = u.seq_pla_usuario
		and   cc.origem 			 ='R' ";
		

		if ($usuariologado != 'TODOS') {
			$condicoes .= "and cc.SEQ_PLA_USUARIO = '$usuariologado'";
		}

		
		if ($filtro_situacao !='T') {			
			$condicoes .= "and cc.situacao = '$filtro_situacao' ";
		}

		if ($filtro_cliente != null) {
			$condicoes .="AND  CL.SEQ_PLA_CLIENTE = '$filtro_cliente' ";
		}

		$condicoes .="order by data_relatorio desc";
           // Executa o SQL e adiciona as condicoes.
		$sql = $this->db->query($sql . $condicoes);
			// Transforma o resultado em um objeto.
		return $sql->fetchAll(\PDO::FETCH_OBJ);		
	}


	public function ocorrencia() {
		$sql = "SELECT * from crm_ocorrencias co 
		where co.seq_pla_ocorrencia in (528129,  41235701,  18021201,  18021301)";
           // Executa o SQL.
		$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
		return $sql->fetchAll(\PDO::FETCH_OBJ);	
	}


	public function getcliente() {
		$sql = "SELECT C.NOME_CLIENTE AS CLIENTE,
		CE.SEQ_PLA_ENDERECO,
		C.seq_pla_cliente
		from CLIENTES_ENDERECOS CE, 
		CLIENTES C
		where CE.SEQ_PLA_CLIENTE = C.SEQ_PLA_CLIENTE
		and CE.ATIVO <>'N'
		order by 1";
           // Executa o SQL.
		$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
		return $sql->fetchAll(\PDO::FETCH_OBJ);	
	}

	public function solicitante() {
		$sql = "SELECT SOL.NOME_SOLICITANTE ||' || - || '||C.NOME_CLIENTE AS SOLICITANTE,						   
		CE.SEQ_PLA_ENDERECO,
		SOL.SEQ_PLA_SOLICITANTE, 
		c.seq_pla_cliente
		from CRM_SOLICITANTES SOL, 
		CLIENTES_ENDERECOS CE, 
		CLIENTES C
		where SOL.SEQ_PLA_ENDERECO = CE.SEQ_PLA_ENDERECO(+)
		and CE.SEQ_PLA_CLIENTE = C.SEQ_PLA_CLIENTE
		and sol.inativo <>'S'
		order by 1";
           // Executa o SQL.
		$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
		return $sql->fetchAll(\PDO::FETCH_OBJ);	
	}


	public function ultimochamado(){
		$sql = "SELECT MAX(C.NR_CHAMADO) FROM CRM_CHAMADOS C";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$ultimochamado = $qry->fetch();			
		return $ultimochamado;
	}


	public function gravaincluir($txt_desc_breve,$txt_ocorrencia, $txt_solicitante, $txt_sistema, $txt_nr_chamado, 
		$txt_nr_relatorio, $txt_data_chamado, $txt_data_relatorio, $txt_ini_am, $txt_fim_am,
		$txt_ini_pm, $txt_fim_pm, $txt_detalhes, $txt_usuariologado) {

			//pega o seq_pla_do novo chamado 
		$sql2 = "SELECT LPAD(TO_CHAR(SEQUENCIA_PLANILHA.NEXTVAL+1)||LPAD(TO_CHAR(COD_IDENTIFICACAO),2,'0'),10,' ') AS CHAMADO
		FROM IDENTIFICADOR_FILIAL";
		$sql2 = $this->db->prepare($sql2);
		$sql2->execute();

		$sql = "INSERT INTO CRM_CHAMADOS (SEQ_PLA_CHAMADO,
		COD_EMPRESA,
		COD_FILIAL,
		SEQ_PLA_SOLICITANTE,
		NR_CHAMADO,
		ORIGEM,
		RELATORIO_VISITA,
		DATA_CHAMADO,
		DESCRICAO_BREVE,
		COD_SISTEMA,
		SEQ_PLA_OCORRENCIA,
		RV_HORA_INI_AM,
		RV_HORA_FIM_AM,
		RV_HORA_INI_PM,
		RV_HORA_FIM_PM,
		SITUACAO,
		DESCRICAO_DETALHADA,
		DATA_RELATORIO,
		SEQ_PLA_USUARIO)
		VALUES
		(To_Char(fretornaseqplanilha),
		'1',
		'1',
		:txt_solicitante,
		:txt_nr_chamado,
		'R',
		:txt_nr_relatorio,
		to_date(:txt_data_chamado, 'DD/MM/YYYY'),
		UPPER(:txt_desc_breve),
		:txt_sistema,
		:txt_ocorrencia,
		:txt_ini_am,
		:txt_fim_am,
		:txt_ini_pm,
		:txt_fim_pm,
		'P',
		:txt_detalhes,
		to_date(:txt_data_relatorio, 'DD/MM/YYYY'),
		:txt_usuariologado
	)";
											   //echo $sql;											   				
			// preparar o sql
	$sql = $this->db->prepare($sql);
			// // passa parametros
	$sql->bindValue(":txt_desc_breve", $txt_desc_breve);
	$sql->bindValue(":txt_ocorrencia", $txt_ocorrencia);
	$sql->bindValue(":txt_solicitante", $txt_solicitante);
	$sql->bindValue(":txt_sistema", $txt_sistema);
	$sql->bindValue(":txt_nr_chamado", $txt_nr_chamado);
	$sql->bindValue(":txt_nr_relatorio", $txt_nr_relatorio);
	$sql->bindValue(":txt_data_chamado", $txt_data_chamado);
	$sql->bindValue(":txt_data_relatorio", $txt_data_relatorio);
	$sql->bindValue(":txt_ini_am", $txt_ini_am);
	$sql->bindValue(":txt_fim_am", $txt_fim_am);
	$sql->bindValue(":txt_ini_pm", $txt_ini_pm);
	$sql->bindValue(":txt_fim_pm", $txt_fim_pm);
	$sql->bindValue(":txt_detalhes", $txt_detalhes);
	$sql->bindValue(":txt_usuariologado", $txt_usuariologado);

			// $sql->bindValue(":seq_cliente", $seq_cliente);
			// // executa o sql
	$sql->execute();
			 //$sql->fetchAll(\PDO::FETCH_OBJ);

			//retorna o seq_pla do novo chamado.
		 	return $sql2->fetch(\PDO::FETCH_OBJ); // RETORNO DE $sql2	

		 }  


		 public function gravaeditarhorachamado($txt_seq_pla_chamado, $txt_ini_am, $txt_fim_am, $txt_ini_pm, $txt_fim_pm){

		 	$sql = "UPDATE CRM_CHAMADOS
		 	SET RV_HORA_INI_AM = :txt_ini_am,
		 	RV_HORA_FIM_AM = :txt_fim_am,
		 	RV_HORA_INI_PM = :txt_ini_pm,
		 	RV_HORA_FIM_PM = :txt_fim_pm
		 	WHERE SEQ_PLA_CHAMADO = :txt_seq_pla_chamado";
			// preparar o sql
		 	$sql = $this->db->prepare($sql);
			// // passa parametros
		 	$sql->bindValue(":txt_seq_pla_chamado", $txt_seq_pla_chamado);
		 	$sql->bindValue(":txt_ini_am", $txt_ini_am);
		 	$sql->bindValue(":txt_fim_am", $txt_fim_am);
		 	$sql->bindValue(":txt_ini_pm", $txt_ini_pm);
		 	$sql->bindValue(":txt_fim_pm", $txt_fim_pm);

		 	$sql->execute();
			 //print_r($sql);
			 //print_r($sql->errorInfo());
		 }


		 public function listachamado($seq_pla_chamado){
		 	$sql = "SELECT cc.seq_pla_chamado,
		 	cc.nr_chamado,
		 	cc.seq_pla_usuario,
		 	trunc(cc.data_relatorio) as data,
		 	cc.relatorio_visita,
		 	cc.data_relatorio,
		 	cc.descricao_breve,
		 	co.ocorrencia,
		 	cc.rv_hora_ini_am as ini_am,
		 	cc.rv_hora_fim_am as fim_am,
		 	cc.rv_hora_ini_pm as ini_pm,
		 	cc.rv_hora_fim_pm as fim_pm,
		 	cl.nome_fantasia as cliente,
		 	so.nome_solicitante as solicitante
		 	from crm_chamados        cc,
		 	crm_solicitantes    so,
		 	clientes            cl,
		 	clientes_enderecos  ce,
		 	crm_ocorrencias     co
		 	where ce.seq_pla_cliente = cl.seq_pla_cliente
		 	and   so.seq_pla_endereco = ce.seq_pla_endereco
		 	and   cc.seq_pla_solicitante = so.seq_pla_solicitante
		 	and   co.seq_pla_ocorrencia  = cc.seq_pla_ocorrencia
		 	and   cc.origem ='R'
					        --and   cc.situacao='P'
					        and   cc.SEQ_PLA_CHAMADO = $seq_pla_chamado";
           // Executa o SQL.
					        $sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
					        return $sql->fetchAll(\PDO::FETCH_OBJ);		
					    }      


					    public function getAtividadeVisita($seq_pla_atividade_visita){

					    	$sql = "SELECT * from CRM_ATIVIDADES_VISITA where seq_pla_atividade_visita = $seq_pla_atividade_visita";
           // Executa o SQL.
					    	$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
					    	return $sql->fetchAll(\PDO::FETCH_OBJ);	
					    }



					    public function atividadeschamado($seq_pla_chamado){
					    	$sql = " SELECT V.SEQ_PLA_ATIVIDADE_VISITA,
					    	V.SEQ_PLA_CHAMADO,
					    	V.SERVICO,
					    	V.COD_SISTEMA,     
					    	DECODE(V.COD_SISTEMA,
					    	'01', '01 - FINANCEIRO',
					    	'02', '02 - ALMOXAR',
					    	'03', '03 - SEMENTES',
					    	'04', '04 - GRÃOS',
					    	'05', '05 - COMPRAS',
					    	'06', '06 - FISCAL',
					    	'07', '07 - ALGODÃO',
					    	'08', '08 - PATRIMÔNIO',
					    	'09', '09 - PULVERIZA',
					    	'10', '10 - SPED',
					    	'11', '11 - NF-E',
					    	'13', '13 - TRANSMISSÃO',
					    	'14', '14 - CRM',
					    	'15', '15 - SGL',
					    	'16', '16 - PRESTAÇÃO DE SERVICO',
					    	'17', '17 - TODOS')  AS SISTEMA,
					    	V.HORA_INICIO,
					    	V.HORA_FIM,
					    	V.ATIVIDADE
					    	FROM  CRM_ATIVIDADES_VISITA V 
					    	WHERE V.SEQ_PLA_CHAMADO = $seq_pla_chamado
					    	ORDER BY V.SEQ_PLA_ATIVIDADE_VISITA,V.HORA_INICIO";
           // Executa o SQL.
					    	$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
					    	return $sql->fetchAll(\PDO::FETCH_OBJ);		

					    }  


					    public function alterar_atividade($seq_pla_atividade_visita){
					    	$sql = " SELECT V.SEQ_PLA_ATIVIDADE_VISITA,
					    	V.SEQ_PLA_CHAMADO,
					    	V.SERVICO,
					    	V.COD_SISTEMA,     
					    	DECODE(V.COD_SISTEMA,
					    	'01', '01 - FINANCEIRO',
					    	'02', '02 - ALMOXAR',
					    	'03', '03 - SEMENTES',
					    	'04', '04 - GRÃOS',
					    	'05', '05 - COMPRAS',
					    	'06', '06 - FISCAL',
					    	'07', '07 - ALGODÃO',
					    	'08', '08 - PATRIMÔNIO',
					    	'09', '09 - PULVERIZA',
					    	'10', '10 - SPED',
					    	'11', '11 - NF-E',
					    	'13', '13 - TRANSMISSÃO',
					    	'14', '14 - CRM',
					    	'15', '15 - SGL',
					    	'16', '16 - PRESTAÇÃO DE SERVICO',			               
					    	'17', '17 - TODOS')  AS SISTEMA,
					    	V.HORA_INICIO,
					    	V.HORA_FIM,
					    	V.ATIVIDADE
					    	FROM  CRM_ATIVIDADES_VISITA V 
					    	WHERE V.SEQ_PLA_ATIVIDADE_VISITA = $seq_pla_atividade_visita";
           // Executa o SQL.
					    	$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
					    	return $sql->fetchAll(\PDO::FETCH_OBJ);		

					    }      

					    public function gravaincluiratividades($txt_seq_pla_chamado,  $txt_servico, $txt_sistema, $txt_hora_ini, $txt_hora_fim,
					    	$txt_atividade) {
					    	$sql = "INSERT INTO CRM_ATIVIDADES_VISITA (SEQ_PLA_ATIVIDADE_VISITA,
					    	SEQ_PLA_CHAMADO,
					    	SERVICO,
					    	COD_SISTEMA,
					    	HORA_INICIO,
					    	HORA_FIM,
					    	ATIVIDADE)
					    	VALUES
					    	(To_Char(fretornaseqplanilha),
					    	:txt_seq_pla_chamado,
					    	:txt_servico,
					    	:txt_sistema,
					    	:txt_hora_ini,
					    	:txt_hora_fim,
					    	:txt_atividade
					    )";
			// preparar o sql
					    $sql = $this->db->prepare($sql);
			// // passa parametros
					    $sql->bindValue(":txt_seq_pla_chamado", $txt_seq_pla_chamado);
					    $sql->bindValue(":txt_servico", $txt_servico);
					    $sql->bindValue(":txt_sistema", $txt_sistema);
					    $sql->bindValue(":txt_hora_ini", $txt_hora_ini);
					    $sql->bindValue(":txt_hora_fim", $txt_hora_fim);
					    $sql->bindValue(":txt_atividade", $txt_atividade);

					    $sql->execute();
			 //print_r($sql);
			 //print_r($sql->errorInfo());
					}

					public function gravaalteraratividade($txt_seq_pla_atividade_visita,  $txt_servico, $txt_sistema, $txt_hora_ini, $txt_hora_fim,
						$txt_atividade) {

			// $sql2 utilizado para retornar o seq_pla_chamado que foi excluido pra tela de incluir atividade.
						$sql2 = "SELECT SEQ_PLA_CHAMADO from CRM_ATIVIDADES_VISITA where seq_pla_atividade_visita =:seq_pla_atividade_visita";
						$sql2 = $this->db->prepare($sql2);
						$sql2->bindValue(":seq_pla_atividade_visita", $txt_seq_pla_atividade_visita);
						$sql2->execute();

			// atualiza informações.
						$sql = "UPDATE CRM_ATIVIDADES_VISITA
						SET  SERVICO 	= :txt_servico,
						COD_SISTEMA = :txt_sistema,
						HORA_INICIO = :txt_hora_ini,
						HORA_FIM 	= :txt_hora_fim,
						ATIVIDADE 	= :txt_atividade
						WHERE SEQ_PLA_ATIVIDADE_VISITA = :txt_seq_pla_atividade_visita";
			// preparar o sql
						$sql = $this->db->prepare($sql);
			// // passa parametros
						$sql->bindValue(":txt_seq_pla_atividade_visita", $txt_seq_pla_atividade_visita);
						$sql->bindValue(":txt_servico", $txt_servico);
						$sql->bindValue(":txt_sistema", $txt_sistema);
						$sql->bindValue(":txt_hora_ini", $txt_hora_ini);
						$sql->bindValue(":txt_hora_fim", $txt_hora_fim);
						$sql->bindValue(":txt_atividade", $txt_atividade);

						$sql->execute();
			 //print_r($sql);
			 //print_r($sql->errorInfo());

			 return $sql2->fetch(\PDO::FETCH_OBJ); // RETORNO DE $sql2
			}

			public function finalizar($seq_pla_chamado) {
			//echo $seq_pla_chamado;
				$sql = "UPDATE CRM_CHAMADOS C SET C.SITUACAO='R', C.DESCRICAO_DETALHADA = (
				SELECT WM_CONCAT('RELATÓRIO DE VISITA: '||C.NR_CHAMADO||CHR(10)||
				'HORARIO: '||V.HORA_INICIO ||' ÀS '|| V.HORA_FIM ||' - '||
				'SERVIÇO: '||V.SERVICO||' - '||
				'MÓDULO:'||' - '|| DECODE(V.COD_SISTEMA,
				'01', '01 - FINANCEIRO',
				'02', '02 - ALMOXAR',
				'03', '03 - SEMENTES',
				'04', '04 - GRÃOS',
				'05', '05 - COMPRAS',
				'06', '06 - FISCAL',
				'07', '07 - ALGODÃO',
				'08', '08 - PATRIMÔNIO',
				'09', '09 - PULVERIZA',
				'10', '10 - SPED',
				'11', '11 - NF-E',
				'13', '13 - TRANSMISSÃO',
				'14', '14 - CRM',
				'15', '15 - SGL',
				'17', '17 - TODOS')||CHR(10)||'-'||
				V.ATIVIDADE || CHR(10)) AS ATIVIDADE
				FROM CRM_ATIVIDADES_VISITA V
				WHERE V.SEQ_PLA_CHAMADO = C.SEQ_PLA_CHAMADO)
				WHERE C.SEQ_PLA_CHAMADO = $seq_pla_chamado";
				        //echo $sql;
			// preparar o sql
				$sql = $this->db->prepare($sql);

				$sql->execute();
			 //print_r($sql);
			 //print_r($sql->errorInfo());
			}

			public function deleteatividade ($seq_pla_atividade_visita){

			// $sql2 utilizado para retornar o seq_pla_chamado que foi excluido pra tela de incluir atividade.
				$sql2 = "SELECT SEQ_PLA_CHAMADO from CRM_ATIVIDADES_VISITA where seq_pla_atividade_visita =:seq_pla_atividade_visita";
				$sql2 = $this->db->prepare($sql2);
				$sql2->bindValue(":seq_pla_atividade_visita", $seq_pla_atividade_visita);
				$sql2->execute();

			//procedimento que exclui a atividade.
				$sql = "delete from CRM_ATIVIDADES_VISITA where seq_pla_atividade_visita =:seq_pla_atividade_visita";
			// preparar o sql
				$sql = $this->db->prepare($sql);
			// // passa parametros
				$sql->bindValue(":seq_pla_atividade_visita", $seq_pla_atividade_visita);
			// // executa o sql
				$sql->execute();

			 return $sql2->fetch(\PDO::FETCH_OBJ); // RETORNO DE $sql2

			}


		}
