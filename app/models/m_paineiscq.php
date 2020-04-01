<?php

namespace app\Models;

use app\core\Model;

class m_paineiscq extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function totalchamados($analista)
	{
		$sql = "SELECT count(ch.seq_pla_chamado) as qtde
					  FROM crm_chamados ch, 
						   crm_andamento ca, 
						   crm_ocorrencias co
					 WHERE ca.seq_pla_analista = $analista --'  26456401'
					   AND ch.seq_pla_chamado = ca.seq_pla_chamado
					   AND ca.sequencia =
						   (SELECT MAX(ca.sequencia)
							  FROM crm_andamento ca
							 WHERE ca.seq_pla_chamado = ch.seq_pla_chamado)
					   AND ch.situacao = 'P'
					   AND ch.seq_pla_ocorrencia = co.seq_pla_ocorrencia";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		$qtd_ch_cq_compass = $qry->fetch(\PDO::FETCH_OBJ);

		return $qtd_ch_cq_compass;
	}

	public function qtd_ocorrencias($analista)
	{
		$sql = "SELECT co.ocorrencia AS OCORRENCIA, 
									 COUNT(co.ocorrencia) AS QUANTIDADE
					  FROM crm_chamados ch, 
						   crm_andamento ca, 
						   crm_ocorrencias co
					 WHERE ca.seq_pla_analista = $analista --'  26456401'
					   AND ch.seq_pla_chamado = ca.seq_pla_chamado
					   AND ca.sequencia =
						   (SELECT MAX(ca.sequencia)
							  FROM crm_andamento ca
							 WHERE ca.seq_pla_chamado = ch.seq_pla_chamado)
					   AND ch.situacao = 'P'
					   AND ch.seq_pla_ocorrencia = co.seq_pla_ocorrencia
					 GROUP BY co.ocorrencia
					";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		return $qry->fetchAll(\PDO::FETCH_OBJ);
	}

	//quantidade de chamados devolvidos pelo CQ e aguardando ajustes.		
	public function aguardando_ajustes()
	{

		$sql = "SELECT COUNT(*) 
					FROM (SELECT DISTINCT SC.ULTIMO_DEPARTAMENTO,
						  SC.NR_CHAMADO      
					  FROM CRM_ANDAMENTOSAIDA_CQ SC
				 WHERE SC.ULTIMO_DEPARTAMENTO IN  ('DESENVOLVIMENTO', 'ANALISE DE SISTEMA','CONTROLE DESENVOLVIMENTO')) A";

		$qry = $this->db->prepare($sql);
		$qry->execute();

		$qtd_aguard_ajuste = $qry->fetch(\PDO::FETCH_OBJ);

		return $qtd_aguard_ajuste;
	}
	//quantidade de chamados devolvidos pelo CQ e aguardando ajustes.		
	public function aguardando_portiporetorno()
	{

		$sql = "SELECT DISTINCT COUNT(SC.NR_CHAMADO) AS QUANTIDADE,
									initcap(SC.STATUS_SAICQ) AS TIPO_RETORNO      
						FROM CRM_ANDAMENTOSAIDA_CQ SC
					WHERE SC.ULTIMO_DEPARTAMENTO IN  ('DESENVOLVIMENTO', 'ANALISE DE SISTEMA','CONTROLE DESENVOLVIMENTO')
					AND SC.SAIDACQ = (SELECT MAX(S.SAIDACQ) FROM CRM_ANDAMENTOSAIDA_CQ S WHERE S.NR_CHAMADO = SC.NR_CHAMADO)
			GROUP BY SC.STATUS_SAICQ 
			ORDER BY 2";

		$qry = $this->db->prepare($sql);
		$qry->execute();

		return $qry->fetchAll(\PDO::FETCH_OBJ);
	}
	//quantidade de chamados devolvidos pelo CQ e aguardando ajustes.		
	public function relacao_ch_aguardando()
	{

		$sql = "SELECT  SC.NR_CHAMADO,
											TRUNC(SC.DATA_CHAMADO) AS DT_CHAMADO,
											INITCAP(SC.CLIENTE) AS CLIENTE,
											INITCAP(SC.SOLICITANTE) AS SOLICITANTE,
											SC.MENU,
											SC.OPCAO,
											SC.DESCRICAO_BREVE,
											SC.ORIGEM,
											INITCAP(SC.OCORRENCIA) AS OCORRENCIA,
											TRUNC(SC.DT_SAIDACQ) AS DT_SAICQ,
											SC.ANALISTASAICQ AS ANALISTASAICQ,
											SC.ULTIMO_DEPARTAMENTO AS DEP_ATUAL,
											SC.SAIDACQ AS ANDAMENTO,
											INITCAP(SC.STATUS_SAICQ) AS DESTINO,
											INITCAP(SC.ULTIMOANALISTA) AS ULTIMOANALISTA             
						FROM CRM_ANDAMENTOSAIDA_CQ SC
					WHERE SC.ULTIMO_DEPARTAMENTO IN  ('DESENVOLVIMENTO', 'ANALISE DE SISTEMA','CONTROLE DESENVOLVIMENTO')
					AND SC.SAIDACQ = (SELECT MAX(S.SAIDACQ) FROM CRM_ANDAMENTOSAIDA_CQ S WHERE S.NR_CHAMADO = SC.NR_CHAMADO)
					ORDER BY 1";

		$qry = $this->db->prepare($sql);
		$qry->execute();

		return $qry->fetchAll(\PDO::FETCH_OBJ);
	}

	public function lista_chamados_analista($analista)
	{

		$sql = "SELECT      CH.NR_CHAMADO,
						  TRUNC(CH.DATA_CHAMADO) AS DT_CHAMADO,
						  INITCAP(CL.NOME_CLIENTE) AS CLIENTE,
						  INITCAP(SL.NOME_SOLICITANTE) AS SOLICITANTE,
						  
						  DECODE(CH.COD_SISTEMA,
						   '01', '01 - FINANCEIRO',
						   '02', '02 - ALMOXAR',
						   '03', '03 - SEMENTES',
						   '04', '04 - GRAOS',
						   '05', '05 - COMPRAS',
						   '06', '06 - FISCAL',
						   '07', '07 - ALGODAO',
						   '08', '08 - PATRIMONIO',
						   '09', '09 - PULVERIZA',
						   '10', '10 - PED',
						   '11', '11 - NFE',
						   '12', '12 - COMPASS',
						   '13', '13 - TRANSMISSAO',
						   '14', '14 - CRM',
						   '15', '15 - SGL',
						   '16', '16 - PRESTAÇÃO SERVIÇOS',
						   '20', '20 - PECUARIA',
						   'OUTRO') as SISTEMA,
					   CH.COD_MENU,
					   REPLACE(MENUS.NOME_MENU,'&','') as MENU,
					   CH.COD_OPCAO,
					   REPLACE(OPCOES.NOME_OPCAO,'&','') as OPCAO, 

						  CH.DESCRICAO_BREVE,
						  CH.ORIGEM,
						  INITCAP(CO.OCORRENCIA) AS OCORRENCIA,
						  '' AS DT_SAICQ,
						  '' AS ANALISTASAICQ,
						  '' AS DEP_ATUAL,
						  '' AS ANDAMENTO,
						  '' AS DESTINO 

						  FROM crm_chamados ch, 
							 crm_andamento ca, 
							 crm_ocorrencias co,
							 crm_solicitantes sl,
							 clientes         cl,
							 clientes_enderecos ce,
							  MENUS,
							  MENUS_OPCOES OPCOES
						   WHERE ca.seq_pla_analista = $analista --'  26456401'
						   AND ce.seq_pla_cliente = cl.seq_pla_cliente
						   AND CH.COD_SISTEMA         = MENUS.COD_SISTEMA (+)
						   AND CH.COD_MENU            = MENUS.COD_MENU (+)
						   AND CH.COD_SISTEMA         = OPCOES.COD_SISTEMA (+)
						   AND CH.COD_MENU            = OPCOES.COD_MENU (+)
						   AND CH.COD_OPCAO           = OPCOES.COD_OPCAO (+)
						   AND sl.seq_pla_endereco = ce.seq_pla_endereco
						   AND ch.seq_pla_solicitante = sl.seq_pla_solicitante
						   AND ch.seq_pla_chamado = ca.seq_pla_chamado
						   AND ca.sequencia =
							 (SELECT MAX(ca.sequencia)
							FROM crm_andamento ca
							 WHERE ca.seq_pla_chamado = ch.seq_pla_chamado)
						   AND ch.situacao = 'P'
						   AND ch.seq_pla_ocorrencia = co.seq_pla_ocorrencia";

		$qry = $this->db->prepare($sql);
		$qry->execute();

		return $qry->fetchAll(\PDO::FETCH_OBJ);
	}

	public function pesquisa_andamento($filtro)
	{

		$condicoes = "";

		$sql = "SELECT * FROM CRM_DETALHAMENTOS_CQ S WHERE S.DETALHAMENTO LIKE '%$filtro%' ";
		
		$condicoes .= "order by 1 desc";
		// Executa o SQL e adiciona as condicoes.
		$sql = $this->db->query($sql . $condicoes);

		//print_r($sql);
		//print_r($sql->errorInfo());
		// Transforma o resultado em um objeto.
		return $sql->fetchAll(\PDO::FETCH_OBJ);
	}
}
