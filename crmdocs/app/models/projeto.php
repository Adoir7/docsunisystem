<?php

	namespace app\Models;
	use app\core\Model;

	class projeto extends Model {

		public function __construct(){
			parent:: __construct();
		}
		
		public function lista(){
			$sql = "SELECT AA.SEQ_PLA_CLIENTE,
					       AA.CLIENTE,
					       AA.DESC_SITUACAO_CLIENTE,
					       AA.INICIO_PROJETO,
					       AA.HORAS_PROJETO,
					       AA.ADITIVO,
					       TO_NUMBER((AA.MIN_TOTAL_PROJETO)/60)||':00:00' AS TOTAL_PROJETO,
					       AA.EXECUTADO,
					       AA.MIN_TOTAL_PROJETO,
					       AA.MIN_TOTAL_EXECUTATO,
					       TO_CHAR(TRUNC(((AA.MIN_TOTAL_PROJETO - AA.MIN_TOTAL_EXECUTATO) * 60) /3600),'FM9900')  ||':'||  TO_CHAR(TRUNC(MOD(((AA.MIN_TOTAL_PROJETO - AA.MIN_TOTAL_EXECUTATO) * 60),3600)/60),'FM00') ||':00' AS SALDO
					  FROM (SELECT DISTINCT CL.SEQ_PLA_CLIENTE,
					               CL.NOME_FANTASIA AS CLIENTE,
					               CS.DESC_SITUACAO_CLIENTE,
					               CL.DATA_CADASTRO INICIO_PROJETO,
					               CL.NR_MATRICULA AS HORAS_PROJETO,
					               (NVL((CL.COD_SUFRAMA),0)||':00:00') AS ADITIVO,
					               HR.EXECUTADO,
					               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),4,2)))) +  ((NVL((TO_NUMBER(TRIM(SUBSTR(CL.COD_SUFRAMA,1,3)))),0)) * 60) AS MIN_TOTAL_PROJETO,
					               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),4,2)))) AS MIN_TOTAL_EXECUTATO
					          FROM (SELECT CRS.SEQ_PLA_ENDERECO,
					                       TO_CHAR(TRUNC(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0))  -
					                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0))) +
					                                          ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0))  -
					                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60) / 3600),'FM9900') ||':'||

					                       TO_CHAR(TRUNC(MOD(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0)) -
					                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0)))+
					                                              ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0)) -
					                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60),3600) / 60),'FM00') ||':00' AS EXECUTADO
					                  FROM CRM_CHAMADOS     CHA,
					                       CRM_SOLICITANTES CRS
					                 WHERE CHA.ORIGEM='R'
					                   AND CHA.SEQ_PLA_SOLICITANTE = CRS.SEQ_PLA_SOLICITANTE
					                   AND CHA.DATA_RELATORIO     >= (SELECT C.DATA_CADASTRO FROM CLIENTES C,
					                                                                              CLIENTES_ENDERECOS E
					                                                                         WHERE E.SEQ_PLA_CLIENTE = C.SEQ_PLA_CLIENTE
					                                                                         AND   E.SEQ_PLA_ENDERECO = CRS.SEQ_PLA_ENDERECO)
					                   AND CHA.SEQ_PLA_OCORRENCIA IN (  18021201,  18021301)
					                 GROUP BY CRS.SEQ_PLA_ENDERECO) HR,

					               CLIENTES           CL,
					               CLIENTES_ENDERECOS CE,
					               CLIENTES_SITUACAO  CS

					         WHERE HR.SEQ_PLA_ENDERECO = CE.SEQ_PLA_ENDERECO
					           AND CS.SEQ_PLA_SITUACAO = CL.SEQ_PLA_SITUACAO
					           AND CE.SEQ_PLA_CLIENTE = CL.SEQ_PLA_CLIENTE
					           --AND CL.SEQ_PLA_CLIENTE IN(   5012301)
					           AND CL.NR_MATRICULA IS NOT NULL
					           -- PROJETO EM ANDAMENTO;
					           AND CL.IMPRIME_INF_ADICIONAL <> 'N'
					       ) AA";

           // Executa o SQL.
			$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
			return $sql->fetchAll(\PDO::FETCH_OBJ);
		
		}

		public function editar($seq_cliente){
			$sql = "SELECT * FROM CLIENTES WHERE seq_pla_cliente = $seq_cliente ";

           // Executa o SQL.
			$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
			return $sql->fetchAll(\PDO::FETCH_OBJ);
		
		}
        
        //$projeto_finalizado
		public function gravaeditar ($seq_cliente, $horas_projeto, $horas_aditivo, $data_projeto){

			$sql = "update CLIENTES set NR_MATRICULA =:horas_projeto, 
										COD_SUFRAMA  =:horas_aditivo,
										DATA_CADASTRO =to_date(:data_projeto, 'DD/MM/YYYY') 
							where seq_pla_cliente =:seq_cliente";
			
			// preparar o sql
			 $sql = $this->db->prepare($sql);
			// // passa parametros
			 $sql->bindValue(":horas_projeto", $horas_projeto);
			 $sql->bindValue(":horas_aditivo", $horas_aditivo);
			 $sql->bindValue(":data_projeto", $data_projeto);
			 $sql->bindValue(":seq_cliente", $seq_cliente);
			// // executa o sql
			 $sql->execute();
			 //print_r($sql->errorInfo());
		}

		public function projetos($seq_cliente){
			$sql = "SELECT AA.SEQ_PLA_CLIENTE,
					       AA.CLIENTE,
					       AA.INICIO_PROJETO,
					       AA.HORAS_PROJETO,
					       AA.ADITIVO,
					       TO_NUMBER((AA.MIN_TOTAL_PROJETO)/60)||':00:00' AS TOTAL_PROJETO,
					       AA.EXECUTADO,
					       AA.MIN_TOTAL_PROJETO,
					       AA.MIN_TOTAL_EXECUTATO,
					       TO_CHAR(TRUNC(((AA.MIN_TOTAL_PROJETO - AA.MIN_TOTAL_EXECUTATO) * 60) /3600),'FM9900')  ||':'||  TO_CHAR(TRUNC(MOD(((AA.MIN_TOTAL_PROJETO - AA.MIN_TOTAL_EXECUTATO) * 60),3600)/60),'FM00') ||':00' AS SALDO
					  FROM (SELECT DISTINCT CL.SEQ_PLA_CLIENTE,
					               CL.NOME_FANTASIA AS CLIENTE,
					               CL.DATA_CADASTRO INICIO_PROJETO,
					               CL.NR_MATRICULA AS HORAS_PROJETO,
					               (NVL((CL.COD_SUFRAMA),0)||':00:00') AS ADITIVO,
					               HR.EXECUTADO,
					               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),4,2)))) +  ((NVL((TO_NUMBER(TRIM(SUBSTR(CL.COD_SUFRAMA,1,3)))),0)) * 60) AS MIN_TOTAL_PROJETO,
					               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),4,2)))) AS MIN_TOTAL_EXECUTATO
					          FROM (SELECT CRS.SEQ_PLA_ENDERECO,
					                       TO_CHAR(TRUNC(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0))  -
					                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0))) +
					                                          ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0))  -
					                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60) / 3600),'FM9900') ||':'||

					                       TO_CHAR(TRUNC(MOD(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0)) -
					                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0)))+
					                                              ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0)) -
					                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60),3600) / 60),'FM00') ||':00' AS EXECUTADO
					                  FROM CRM_CHAMADOS     CHA,
					                       CRM_SOLICITANTES CRS
					                 WHERE CHA.ORIGEM='R'
					                   AND CHA.SEQ_PLA_SOLICITANTE = CRS.SEQ_PLA_SOLICITANTE
					                   AND CHA.DATA_RELATORIO     >= (SELECT C.DATA_CADASTRO FROM CLIENTES C,
					                                                                              CLIENTES_ENDERECOS E
					                                                                         WHERE E.SEQ_PLA_CLIENTE = C.SEQ_PLA_CLIENTE
					                                                                         AND   E.SEQ_PLA_ENDERECO = CRS.SEQ_PLA_ENDERECO)
					                   AND CHA.SEQ_PLA_OCORRENCIA IN (  18021201,  18021301)
					                 GROUP BY CRS.SEQ_PLA_ENDERECO) HR,

					               CLIENTES           CL,
					               CLIENTES_ENDERECOS CE

					         WHERE HR.SEQ_PLA_ENDERECO = CE.SEQ_PLA_ENDERECO
					           AND CE.SEQ_PLA_CLIENTE = CL.SEQ_PLA_CLIENTE
					           --AND CL.SEQ_PLA_CLIENTE IN(   5012301)
					           AND CL.NR_MATRICULA IS NOT NULL
					           -- PROJETO EM ANDAMENTO;
					           AND CL.IMPRIME_INF_ADICIONAL <> 'N') AA
					 WHERE AA.SEQ_PLA_CLIENTE = $seq_cliente";

           // Executa o SQL.
			$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
			return $sql->fetchAll(\PDO::FETCH_OBJ);
	
		}

		public function saldo(){

			$sql = "SELECT TO_CHAR(SUM(NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(IM.SALDO),7,10)),3,0))),0)),'FM9900')||':'||
       					   TO_CHAR(TRUNC(MOD(SUM(NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(IM.SALDO),4,2)),3,0))),0)*60),3600)/60),'FM00')||':'||'00' AS SALDO
  					  FROM IMPLANTACOES_MOSAYCO IM
  					 WHERE IM.SALDO >='0'";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$saldo = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $saldo;
		}

		public function saldonegativo(){

			$sql = "SELECT AA.SEQ_PLA_CLIENTE,
					       AA.CLIENTE,
					       AA.INICIO_PROJETO,
					       AA.HORAS_PROJETO,
					       AA.ADITIVO,
					       TO_NUMBER((AA.MIN_TOTAL_PROJETO)/60)||':00:00' AS TOTAL_PROJETO,
					       AA.EXECUTADO,
					       AA.MIN_TOTAL_PROJETO,
					       AA.MIN_TOTAL_EXECUTATO,
					       TO_CHAR(TRUNC(((AA.MIN_TOTAL_PROJETO - AA.MIN_TOTAL_EXECUTATO) * 60) /3600),'FM9900')  ||':'||  TO_CHAR(TRUNC(MOD(((AA.MIN_TOTAL_PROJETO - AA.MIN_TOTAL_EXECUTATO) * 60),3600)/60),'FM00') ||':00' AS SALDO
					  FROM (SELECT DISTINCT CL.SEQ_PLA_CLIENTE,
					               CL.NOME_FANTASIA AS CLIENTE,
					               CL.DATA_CADASTRO INICIO_PROJETO,
					               CL.NR_MATRICULA AS HORAS_PROJETO,
					               (NVL((CL.COD_SUFRAMA),0)||':00:00') AS ADITIVO,
					               HR.EXECUTADO,
					               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),4,2)))) +  ((NVL((TO_NUMBER(TRIM(SUBSTR(CL.COD_SUFRAMA,1,3)))),0)) * 60) AS MIN_TOTAL_PROJETO,
					               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),4,2)))) AS MIN_TOTAL_EXECUTATO
					          FROM (SELECT CRS.SEQ_PLA_ENDERECO,
					                       TO_CHAR(TRUNC(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0))  -
					                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0))) +
					                                          ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0))  -
					                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60) / 3600),'FM9900') ||':'||

					                       TO_CHAR(TRUNC(MOD(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0)) -
					                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0)))+
					                                              ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0)) -
					                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60),3600) / 60),'FM00') ||':00' AS EXECUTADO
					                  FROM CRM_CHAMADOS     CHA,
					                       CRM_SOLICITANTES CRS
					                 WHERE CHA.ORIGEM='R'
					                   AND CHA.SEQ_PLA_SOLICITANTE = CRS.SEQ_PLA_SOLICITANTE
					                   AND CHA.DATA_RELATORIO     >= (SELECT C.DATA_CADASTRO FROM CLIENTES C,
					                                                                              CLIENTES_ENDERECOS E
					                                                                         WHERE E.SEQ_PLA_CLIENTE = C.SEQ_PLA_CLIENTE
					                                                                         AND   E.SEQ_PLA_ENDERECO = CRS.SEQ_PLA_ENDERECO)
					                   AND CHA.SEQ_PLA_OCORRENCIA IN (  18021201,  18021301)
					                 GROUP BY CRS.SEQ_PLA_ENDERECO) HR,

					               CLIENTES           CL,
					               CLIENTES_ENDERECOS CE

					         WHERE HR.SEQ_PLA_ENDERECO = CE.SEQ_PLA_ENDERECO
					           AND CE.SEQ_PLA_CLIENTE = CL.SEQ_PLA_CLIENTE
					           --AND CL.SEQ_PLA_CLIENTE IN(   5012301)
					           AND CL.NR_MATRICULA IS NOT NULL
					           -- PROJETO EM ANDAMENTO;
					           AND CL.IMPRIME_INF_ADICIONAL <> 'N'
					       ) AA
  					 WHERE AA.SALDO <='0'";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$saldonegativo = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $saldonegativo;
		}

		public function projetoscomsaldo(){

			$sql = "SELECT COUNT(*)
					  FROM IMPLANTACOES_MOSAYCO IM
					  WHERE IM.SALDO >='0'";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$projetoscomsaldo = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $projetoscomsaldo;
		}

		public function projetosestourados(){

			$sql = "SELECT COUNT(*)
					  FROM IMPLANTACOES_MOSAYCO IM
					  WHERE IM.SALDO <='0'";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$projetosestourados = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $projetosestourados;
		}

		public function quantidade(){

			$sql = "SELECT COUNT(*) FROM (SELECT DISTINCT CL.SEQ_PLA_CLIENTE,
			               CL.NOME_FANTASIA AS CLIENTE,
			               CL.DATA_CADASTRO INICIO_PROJETO,
			               CL.NR_MATRICULA AS HORAS_PROJETO,
			               (NVL((CL.COD_SUFRAMA),0)||':00:00') AS ADITIVO,
			               HR.EXECUTADO,
			               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(CL.NR_MATRICULA),4,2)))) +  ((NVL((TO_NUMBER(TRIM(SUBSTR(CL.COD_SUFRAMA,1,3)))),0)) * 60) AS MIN_TOTAL_PROJETO,
			               ((NVL(TO_NUMBER(TRIM(LPAD(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),7,10)),3,0))),0)) * 60) + TO_NUMBER(TRIM(REVERSE(SUBSTR(REVERSE(HR.EXECUTADO),4,2)))) AS MIN_TOTAL_EXECUTATO
			          FROM (SELECT CRS.SEQ_PLA_ENDERECO,
			                       TO_CHAR(TRUNC(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0))  -
			                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0))) +
			                                          ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0))  -
			                                           (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60) / 3600),'FM9900') ||':'||

			                       TO_CHAR(TRUNC(MOD(SUM((((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_PM,4,5)))),0)) -
			                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_PM,4,5)))),0)))+
			                                              ((NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_FIM_AM,4,5)))),0)) -
			                                               (NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,1,2))) * 60),0) + NVL((TO_NUMBER(TRIM(SUBSTR(CHA.RV_HORA_INI_AM,4,5)))),0)))) * 60),3600) / 60),'FM00') ||':00' AS EXECUTADO
			                  FROM CRM_CHAMADOS     CHA,
			                       CRM_SOLICITANTES CRS
			                 WHERE CHA.ORIGEM='R'
			                   AND CHA.SEQ_PLA_SOLICITANTE = CRS.SEQ_PLA_SOLICITANTE
			                   AND CHA.DATA_RELATORIO     >= (SELECT C.DATA_CADASTRO FROM CLIENTES C,
			                                                                              CLIENTES_ENDERECOS E
			                                                                         WHERE E.SEQ_PLA_CLIENTE = C.SEQ_PLA_CLIENTE
			                                                                         AND   E.SEQ_PLA_ENDERECO = CRS.SEQ_PLA_ENDERECO)
			                   AND CHA.SEQ_PLA_OCORRENCIA IN (  18021201,  18021301)
			                 GROUP BY CRS.SEQ_PLA_ENDERECO) HR,

			               CLIENTES           CL,
			               CLIENTES_ENDERECOS CE

			         WHERE HR.SEQ_PLA_ENDERECO = CE.SEQ_PLA_ENDERECO
			           AND CE.SEQ_PLA_CLIENTE = CL.SEQ_PLA_CLIENTE
			           --AND CL.SEQ_PLA_CLIENTE IN(   5012301)
			           AND CL.NR_MATRICULA IS NOT NULL
			           -- PROJETO EM ANDAMENTO;
			           AND CL.IMPRIME_INF_ADICIONAL <> 'N'
			       ) AA";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$quantidade = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $quantidade;
		}



	}

?>