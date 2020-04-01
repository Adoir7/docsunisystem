<?php

	namespace app\Models;
	use app\core\Model;

	class relatoriosvisita extends Model {

		public function __construct(){
			parent:: __construct();
		}
		
		public function lista( $seq_cliente){
			$sql = "SELECT CL.SEQ_PLA_CLIENTE,
					       CL.NOME_FANTASIA AS PROJETO,
					       CL.DATA_CADASTRO,
					       CL.NR_MATRICULA,
					       CL.COD_SUFRAMA,
					       CHA.NR_CHAMADO         AS NR_RELATORIO,
					       CHA.DATA_RELATORIO     AS DATA_RELATORIO,
					       DECODE(CHA.RV_HORA_INI_AM,'','00:00','  :  ','00:00',CHA.RV_HORA_INI_AM) AS HORA_INI_AM ,
					       DECODE(CHA.RV_HORA_FIM_AM,'','00:00','  :  ','00:00',CHA.RV_HORA_FIM_AM) AS HORA_FIM_AM,
					       DECODE(CHA.RV_HORA_INI_PM,'','00:00','  :  ','00:00',CHA.RV_HORA_INI_PM) AS HORA_INI_PM,
					       DECODE(CHA.RV_HORA_FIM_PM,'','00:00','  :  ','00:00',CHA.RV_HORA_FIM_PM) AS HORA_FIM_PM,

					       --CALCULO DE HORAS EM CIMA DOS MINUTOS
					       TO_CHAR(TRUNC(((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0))  -
					                        (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0))) +
					                       ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0))  -
					                        (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60) / 3600),'FM9900') ||':'||
					       TO_CHAR(TRUNC(MOD(((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0)) -
					                            (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0)))+
					                           ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0)) -
					                            (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60),3600) / 60),'FM00') ||':00' AS TOTAL,

					       INITCAP(CL.NOME_CLIENTE)  AS CLIENTE,
					       INITCAP(OCO.OCORRENCIA)   AS OCORRENCIA,
					       DECODE(CHA.COD_SISTEMA,
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
					               '15', '15 - SGL')      AS SISTEMA,
					       INITCAP(NVL(USU.NOME_USUARIO,'CLIENTE'))    AS ANALISTA_ATUAL
					  FROM CRM_CHAMADOS       CHA,
					       CLIENTES           CL,
					       CLIENTES_ENDERECOS CE,
					       CIDADES            CID,
					       REGIOES            REG,
					       MENUS,
					       MENUS_OPCOES       OPCOES,
					       USUARIOS           USU,
					       CRM_ANDAMENTO      AD,
					       CRM_ANALISTAS      ANA,
					       CRM_OCORRENCIAS    OCO,
					       CRM_SOLICITANTES   SOL
					 WHERE CHA.SEQ_PLA_OCORRENCIA  = OCO.SEQ_PLA_OCORRENCIA  (+)
					   AND CHA.SEQ_PLA_SOLICITANTE = SOL.SEQ_PLA_SOLICITANTE (+)
					   AND SOL.SEQ_PLA_ENDERECO    = CE.SEQ_PLA_ENDERECO     (+)
					   AND CE.SEQ_PLA_CLIENTE      = CL.SEQ_PLA_CLIENTE      (+)
					   AND CHA.COD_SISTEMA         = MENUS.COD_SISTEMA       (+)
					   AND CHA.COD_MENU            = MENUS.COD_MENU          (+)
					   AND CHA.COD_SISTEMA         = OPCOES.COD_SISTEMA      (+)
					   AND CHA.COD_MENU            = OPCOES.COD_MENU         (+)
					   AND CHA.COD_OPCAO           = OPCOES.COD_OPCAO        (+)
					   AND FULTIMOANDAMENTO(CHA.SEQ_PLA_CHAMADO)=AD.SEQ_PLA_ANDAMENTO (+)
					   AND AD.SEQ_PLA_ANALISTA     = ANA.SEQ_PLA_ANALISTA    (+)
					   AND ANA.SEQ_PLA_USUARIO     = USU.SEQ_PLA_USUARIO     (+)
					   AND CHA.COD_SISTEMA        <> 12
					   AND CHA.DATA_RELATORIO     >= CL.DATA_CADASTRO
					   AND CE.SEQ_PLA_CIDADES      = CID.SEQ_PLA_CIDADES
					   AND CID.SEQ_PLA_REGIOES     = REG.SEQ_PLA_REGIOES
					   AND CHA.ORIGEM              = 'R'
					   AND CL.NR_MATRICULA IS NOT NULL
					   AND OCO.OCORRENCIA IN   ('IMPLANTAÇÃO','TREINAMENTO')
					   AND CL.SEQ_PLA_CLIENTE = $seq_cliente
					 ORDER BY CHA.DATA_RELATORIO  , CHA.NR_CHAMADO ";

           // Executa o SQL.
			$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
			return $sql->fetchAll(\PDO::FETCH_OBJ);
		

		}



	}

?>
