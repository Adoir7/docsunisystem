<?php

	namespace app\Models;
	use app\core\Model;

	class home extends Model {

		public function __construct(){
			parent:: __construct();
		}


		public function chamados(){

			$sql = "select count(*) from crm_chamados";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$num_chamados = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $num_chamados;
		}

		public function cancelados(){

			$sql = "select count(*) from crm_chamados c where c.situacao='C'";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$cancelados = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $cancelados;
		}

		public function resolvidos(){

			$sql = "select count(*) from crm_chamados c where c.situacao='R'";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$resolvidos = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $resolvidos;
		}

		public function pendentes(){

			$sql = "select count(*) from crm_chamados c where c.situacao='P'";
			$qry = $this->db->prepare($sql);
			$qry->execute();

			$pendentes = $qry->fetch(\PDO::FETCH_OBJ);
			
			return $pendentes;
		}

		public function grafico(){

			$sql = "SELECT decode((to_char(cc.data_relatorio, 'mm')), 01,'Janeiro', 02, 'Fevereiro', 05, 'Maio', 12, 'Dezembro' )           
						  from crm_chamados       cc,
						       crm_solicitantes   so,
						       clientes           cl,
						       clientes_enderecos ce,
						       crm_ocorrencias    co,
						       usuarios           u
						 where ce.seq_pla_cliente = cl.seq_pla_cliente
						   and so.seq_pla_endereco = ce.seq_pla_endereco
						   and cc.seq_pla_solicitante = so.seq_pla_solicitante
						   and co.seq_pla_ocorrencia = cc.seq_pla_ocorrencia
						   and cc.seq_pla_usuario = u.seq_pla_usuario
						   and cc.situacao<>'C'   
						   group by  u.apelido, to_char(cc.data_relatorio, 'mm')
						   order by  to_char(cc.data_relatorio, 'mm'), u.apelido ";
			
			$sql = $this->db->query($sql);
			// Transforma o resultado em um objeto.
		    return $sql->fetchAll(\PDO::FETCH_OBJ);	
		    //return json_encode($grafico_meses);
		}


		public function atualizador() {
			
			//adiciona SEQ_PLA_USUARIO Na tabela CRM_CHAMADOS.
			$sql = "alter table CRM_CHAMADOS add SEQ_PLA_USUARIO VARCHAR2(10)";	
			$sql = $this->db->prepare($sql);		
			$sql->execute();

			//Cria FK SEQ_PLA_USUARIO Na tabela CRM_CHAMADOS.
			$sql1 = "alter table CRM_CHAMADOS
					 add constraint FK_RDV_SEQ_PLA_USUARIO foreign key (SEQ_PLA_USUARIO)
					 references usuarios (SEQ_PLA_USUARIO)";	
			$sql1 = $this->db->prepare($sql1);		
			$sql1->execute();

			//Cria tabela para lançamento das atividades da visita.
			$sql2 = "create table CRM_ATIVIDADES_VISITA (
					  SEQ_PLA_ATIVIDADE_VISITA    VARCHAR2(10) not null,
					  SEQ_PLA_CHAMADO   VARCHAR2(10),
					  SERVICO           VARCHAR2(40),
					  COD_SISTEMA       VARCHAR2(2),
					  HORA_INICIO       VARCHAR2(5),
					  HORA_FIM          VARCHAR2(5),
					  ATIVIDADE         VARCHAR2(4000) )";	
			$sql2 = $this->db->prepare($sql2);		
			$sql2->execute();

			//adiciona chave primaria na tabela de atividade de visita.
			$sql3 = "alter table CRM_ATIVIDADES_VISITA
  				    add constraint PK_SEQ_PLA_ATIVIDADE_VISITA primary key (SEQ_PLA_ATIVIDADE_VISITA)";
			$sql3 = $this->db->prepare($sql3);
			$sql3->execute();

			//adiciona o CHAMADO como Chave Estrangeira na tabela de atividade de visita.
			$sql4 = "alter table CRM_ATIVIDADES_VISITA
					 add constraint FK_RDV_SEQ_PLA_CHAMADO foreign key (SEQ_PLA_CHAMADO)
					 references CRM_CHAMADOS (SEQ_PLA_CHAMADO) ";
			$sql4 = $this->db->prepare($sql4);
			$sql4->execute();
			
			//Cria Função WM_CONCAT utilizada para Finalizar Atividades de Visita.
			//Parte 1 de 5
			$sql5 = "CREATE OR REPLACE TYPE t_string_agg AS OBJECT (   g_string  VARCHAR2(32767), STATIC FUNCTION ODCIAggregateInitialize(sctx  IN OUT  t_string_agg) RETURN NUMBER,   MEMBER FUNCTION ODCIAggregateIterate(self   IN OUT  t_string_agg, value  IN      VARCHAR2 )  RETURN NUMBER,   MEMBER FUNCTION ODCIAggregateTerminate(self   IN   t_string_agg,   returnValue  OUT  VARCHAR2,  flags  IN   NUMBER)     RETURN NUMBER,   MEMBER FUNCTION ODCIAggregateMerge(self  IN OUT  t_string_agg,  ctx2  IN      t_string_agg)     RETURN NUMBER);";	
			$sql5 = $this->db->prepare($sql5);		
			$sql5->execute();



			//Cria Função WM_CONCAT utilizada para Finalizar Atividades de Visita.
			//Parte 2 de 5
			$sql6 = "CREATE OR REPLACE TYPE BODY t_string_agg IS   STATIC FUNCTION ODCIAggregateInitialize(sctx  IN OUT  t_string_agg)     RETURN NUMBER IS   BEGIN     sctx := t_string_agg(NULL);     RETURN ODCIConst.Success;   END;    MEMBER FUNCTION ODCIAggregateIterate(self   IN OUT  t_string_agg,                                        value  IN      VARCHAR2 )     RETURN NUMBER IS   BEGIN     SELF.g_string := self.g_string || ',' || value;     RETURN ODCIConst.Success;   END;    MEMBER FUNCTION ODCIAggregateTerminate(self         IN   t_string_agg,                                          returnValue  OUT  VARCHAR2,                                          flags        IN   NUMBER)     RETURN NUMBER IS   BEGIN     returnValue := RTRIM(LTRIM(SELF.g_string, ','), ',');     RETURN ODCIConst.Success;   END;    MEMBER FUNCTION ODCIAggregateMerge(self  IN OUT  t_string_agg,                                      ctx2  IN      t_string_agg)     RETURN NUMBER IS   BEGIN     SELF.g_string := SELF.g_string || ',' || ctx2.g_string;     RETURN ODCIConst.Success;   END; END;";	
			$sql6 = $this->db->prepare($sql6);
			$sql6->execute();



			//Cria Função WM_CONCAT utilizada para Finalizar Atividades de Visita.
			//Parte 3 de 5
			$sql7 = "CREATE OR REPLACE FUNCTION wm_concat (p_input VARCHAR2) RETURN VARCHAR2 PARALLEL_ENABLE AGGREGATE USING t_string_agg; ";	
			$sql7 = $this->db->prepare($sql7);		
			$sql7->execute();



			//Cria Função WM_CONCAT utilizada para Finalizar Atividades de Visita.
			//Parte 4 de 5
			$sql8 = "create or replace public synonym WM_CONCAT for SYS.WM_CONCAT;";	
			$sql8 = $this->db->prepare($sql8);
			$sql8->execute();



			//Cria Função WM_CONCAT utilizada para Finalizar Atividades de Visita.
			//Parte 5 de 5
			$sql9 = "grant execute on wm_concat to public";	
			$sql9 = $this->db->prepare($sql9);
			$sql9->execute();

			//Ajusta Trigger que gera gerenciado dos chamados incluidos pelo relatorio web
			$sql10 = "CREATE Or Replace Trigger CRM_TRIAGEM_EX After Insert or update on Crm_Chamados for each row
											
						Declare
												mSeq_Analista Char(10);
												mSeq_AnalistaAnd Char(10);
												mSeq_Andamento Varchar2(10);
											Begin
											If Inserting Then
											If ((:New.Origem='T') or (:New.Origem='E'))then
												Insert Into Crm_Andamento (Seq_Pla_Andamento, Seq_Pla_Chamado, Detalhamento, Sequencia, Status, Interno, Customizacao, Data)
												Values ((To_Char(Sequencia_Planilha.Nextval)), :New.Seq_Pla_Chamado, 'Analista, Segue Chamado. Att', '  1', '02', 'S', 'N', SysDate);
											End if;
											-- gerenciador do RDV Online
											if ((:New.Origem='R') and (:New.Seq_Pla_Usuario is not null)) then
												Insert Into Gerenciador (Data, Cod_Empresa, Cod_Filial, Operacao, Cod_Filial2, Seq_Planilha, Id_Filial, Codigo_Tabela, Seq_Pla_Usuario, Nome_Form)
												Values (SysDate, '1', '1', 'I', '0', :New.Seq_Pla_Chamado, '01', '256', :New.Seq_Pla_Usuario,'Relatório de Visita Web');
												End if;
											
											If ((:New.Origem='R') And (:New.Seq_Pla_Ocorrencia <> '528129')) then
												Insert Into Crm_Andamento (Seq_Pla_Andamento, Seq_Pla_Chamado, Detalhamento, Sequencia, Status, Interno, Customizacao, Data)
												Values ((To_Char(Sequencia_Planilha.Nextval)), :New.Seq_Pla_Chamado, 'Analista, Segue Chamado. Att', '  1', '02', 'S', 'N', SysDate);
												Select ca.Seq_Pla_Andamento
														Into mSeq_Andamento
														From Crm_Andamento ca
													Where ca.Seq_Pla_Chamado =:New.Seq_Pla_Chamado;
												Insert Into Gerenciador (Data, Cod_Empresa, Cod_Filial, Operacao, Cod_Filial2, Seq_Planilha, Id_Filial, Codigo_Tabela, Seq_Pla_Usuario)
												Values (SysDate, '1', '1', 'I', '0', mSeq_Andamento, '01', '260','  57408401');
												End If;
											End if;
											If Updating then
											Begin
												Select ca.Seq_Pla_Analista
													Into mSeq_Analista
													From Gerenciador gr, Crm_Analistas ca
												Where gr.Seq_Planilha    = :Old.Seq_Pla_Chamado
													And gr.Seq_Pla_Usuario = ca.Seq_pla_Usuario
													And gr.Operacao='I';
													Exception
													When no_data_found Then null;
												End;
											If ((:Old.Origem='T') or (:Old.Origem='E')or(:Old.Origem='R')) then
												Select ca.Seq_Pla_Andamento,
														ca.Seq_Pla_Analista
														Into mSeq_Andamento,
															mSeq_AnalistaAnd
														From Crm_Andamento ca
													Where ca.Sequencia='  1'
													And   ca.Seq_Pla_Chamado =:Old.Seq_Pla_Chamado;
											If (mSeq_Andamento Is Not Null And mSeq_AnalistaAnd Is Null) then
												Update Crm_Andamento Set Seq_Pla_Analista = mSeq_Analista Where Seq_Pla_Andamento= mSeq_Andamento;
												Insert Into Gerenciador (Data, Cod_Empresa, Cod_Filial, Operacao, Cod_Filial2, Seq_Planilha, Id_Filial, Codigo_Tabela, Seq_Pla_Usuario)
												Values (SysDate, '1', '1', 'I', '0', mSeq_Andamento, '01', '260','  57408401');
											End if;
											End If;
											End if;
											End;";	
			$sql10 = $this->db->prepare($sql10);
			$sql10->execute();


			 //print_r($sql);
			 //print_r($sql->errorInfo());

			
			//adiciona o CHAMADO como Chave Estrangeira na tabela de atividade de visita.
			$sql11 = "CREATE OR REPLACE VIEW CRM_ANDAMENTOSAIDA_CQ AS
						SELECT CH.SEQ_PLA_CHAMADO,
							CA.SEQ_PLA_ANALISTA,
							U.APELIDO AS ANALISTA,
							CH.NR_CHAMADO,
							CH.DATA_CHAMADO as DATA_CHAMADO,
							CL.NOME_CLIENTE AS CLIENTE,
							SO.NOME_SOLICITANTE AS SOLICITANTE,
							CA.DETALHAMENTO,
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
							DECODE(CH.ORIGEM,
								'T', 'TELEFONE',
								'E', 'E-MAIL',
								'R', 'RELATORIO DE VISITA',
								'W', 'WEB') as ORIGEM,
							CO.OCORRENCIA,
							
						-- DAQUI PRA BAIXO. POSTERIOR AO CQ
							CA.SEQUENCIA AS ENTRADACQ,
							CA.DATA as DT_ENTRADACQ,
							CRM2.SEQUENCIA AS SAIDACQ,
							CRM2.DATA_ANDAMENTO AS DT_SAIDACQ,
							CRM2.APELIDO AS ANALISTASAICQ,
							CRM2.STATUS_SAICQ AS STATUS_SAICQ,
							CRM2.SAIDACQ AS DEP_SAICQ,
							(SELECT MAX(AN.SEQUENCIA) FROM CRM_ANDAMENTO AN WHERE AN.SEQ_PLA_CHAMADO = CH.SEQ_PLA_CHAMADO ) AS ULTIMOANDAMENTO,
							(SELECT CASE WHEN X.DEPARTAMENTO=01 THEN 'CONTROLE DE ATENDIMENTO'
												WHEN X.DEPARTAMENTO=02 THEN 'ANALISTA DE SUPORTE'
												WHEN X.DEPARTAMENTO=03 THEN 'ANALISE DE SISTEMA'
												WHEN X.DEPARTAMENTO=04 THEN 'CONTROLE DESENVOLVIMENTO'
												WHEN X.DEPARTAMENTO=05 THEN 'DESENVOLVIMENTO'
												WHEN X.DEPARTAMENTO=06 THEN 'CONTROLE DE CQ'
												WHEN X.DEPARTAMENTO=07 THEN 'CONTROLE DE QUALIDADE'
												WHEN X.DEPARTAMENTO=08 THEN 'COMERCIAL'
												WHEN X.DEPARTAMENTO=09 THEN 'FINANCEIRO'
												WHEN X.DEPARTAMENTO IS NULL THEN 'CLIENTE' END
										FROM CRM_ANDAMENTO B,
												CRM_ANALISTAS X
										WHERE B.SEQ_PLA_CHAMADO = CA.SEQ_PLA_CHAMADO
										AND B.SEQ_PLA_ANALISTA = X.SEQ_PLA_ANALISTA(+)
										AND B.SEQUENCIA = (SELECT MAX(Y.SEQUENCIA) FROM CRM_ANDAMENTO Y WHERE B.SEQ_PLA_CHAMADO = Y.SEQ_PLA_CHAMADO )) AS ULTIMO_DEPARTAMENTO,
							DECODE(CH.SITUACAO,
								'P', 'PENDENTE',
								'R', 'RESOLVIDO',
								'C', 'CANCELADO',
								'------') AS SITUACAO
						FROM CRM_CHAMADOS CH,
							CRM_ANDAMENTO CA,
							CRM_ANALISTAS A,
							USUARIOS      U,
								--ADOIR 28/12/19
							CRM_SOLICITANTES SO,
							CLIENTES_ENDERECOS CE,
							CLIENTES  CL,
							CRM_OCORRENCIAS CO,
							MENUS,
							MENUS_OPCOES OPCOES,
							-- fim
							(SELECT CH.SEQ_PLA_CHAMADO,
									CH.NR_CHAMADO,
									CA.DATA as DATA_ANDAMENTO,
									CH.DATA_CHAMADO as DATA_CHAMADO,
									CA.SEQUENCIA,
									U2.APELIDO,
									UPPER(fdescstatus(CA.STATUS)) AS STATUS_SAICQ,
									CASE WHEN A.DEPARTAMENTO=01 THEN 'CONTROLE DE ATENDIMENTO'
												WHEN A.DEPARTAMENTO=02 THEN 'ANALISTA DE SUPORTE'
												WHEN A.DEPARTAMENTO=03 THEN 'ANALISE DE SISTEMA'
												WHEN A.DEPARTAMENTO=04 THEN 'CONTROLE DESENVOLVIMENTO'
												WHEN A.DEPARTAMENTO=05 THEN 'DESENVOLVIMENTO'
												WHEN A.DEPARTAMENTO=06 THEN 'CONTROLE DE CQ'
												WHEN A.DEPARTAMENTO=07 THEN 'CONTROLE DE QUALIDADE'
												WHEN A.DEPARTAMENTO=08 THEN 'COMERCIAL'
												WHEN A.DEPARTAMENTO=09 THEN 'FINANCEIRO'
												WHEN A.DEPARTAMENTO IS NULL THEN 'CLIENTE' END AS SAIDACQ,
									CA.SEQ_PLA_ANALISTA,
									CH.COD_OPCAO,
									CH.COD_MENU,
									CH.DESCRICAO_BREVE,
									CH.ORIGEM
								FROM CRM_CHAMADOS CH,
									CRM_ANDAMENTO CA,
									CRM_ANALISTAS A,
									USUARIOS      U2
								WHERE CA.SEQ_PLA_CHAMADO  = CH.SEQ_PLA_CHAMADO
								AND A.SEQ_PLA_USUARIO   = U2.SEQ_PLA_USUARIO
								AND CA.SEQ_PLA_ANALISTA = A.SEQ_PLA_ANALISTA) CRM2

						WHERE SO.SEQ_PLA_ENDERECO    = CE.SEQ_PLA_ENDERECO
						AND CE.SEQ_PLA_CLIENTE     = CL.SEQ_PLA_CLIENTE
						AND A.SEQ_PLA_USUARIO      = U.SEQ_PLA_USUARIO
						AND CH.COD_SISTEMA         = MENUS.COD_SISTEMA (+)
						AND CH.COD_MENU            = MENUS.COD_MENU (+)
						AND CH.COD_SISTEMA         = OPCOES.COD_SISTEMA (+)
						AND CH.COD_MENU            = OPCOES.COD_MENU (+)
						AND CH.COD_OPCAO           = OPCOES.COD_OPCAO (+)
						AND CH.SEQ_PLA_SOLICITANTE = SO.SEQ_PLA_SOLICITANTE
						AND CH.SEQ_PLA_OCORRENCIA  = CO.SEQ_PLA_OCORRENCIA
						AND CA.SEQ_PLA_CHAMADO     = CH.SEQ_PLA_CHAMADO
						AND CA.SEQ_PLA_ANALISTA    = A.SEQ_PLA_ANALISTA
						AND CA.SEQ_PLA_ANALISTA    = 26456401
						AND CH.SITUACAO            = 'P'
						--AND TRUNC(CA.DATA) >='01/09/2019'
						--AND CA.SEQ_PLA_CHAMADO = 128123001
						AND CA.SEQ_PLA_CHAMADO     = CRM2.SEQ_PLA_CHAMADO
						AND CRM2.SEQUENCIA         = CA.SEQUENCIA +1; ";
			$sql11 = $this->db->prepare($sql11);
			$sql11->execute();
		}

	}
