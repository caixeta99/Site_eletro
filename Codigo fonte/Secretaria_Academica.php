<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$conselhoclassesemestre = new ConselhoClasseSemestre();
$conselhoclasse = new ConselhoClasse();

$conselho = $conselhoclassesemestre->findLast();

?>
<!doctype html>
<html>
<head>
<?php

include("gogle_anlistc.php");

?>  
                                    <!-- meta tages da pagina -->
<meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
 <meta name="description" content="A vários anos a ETEC: ELETRÔ - João Baptista De Lima Figueiredo vem proporcionado ensino de qualidade a custo zero, contando com um grande aparato como: quadra esportiva , auditório , refeitório , laboratórios 100% equipados e internet disponível para todos os alunos. além de possuir grande taxa de aprovação nos principais vestibulares">                                   
                                   <!--- Icone da pagina-->
<link rel="icon" type="imagem/png" href="Imagens/Imagens estaticas/Icones/icone-etec.png">
 <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
<link rel="stylesheet" href="Css/etec-style-usuario-servicos.css">
<link rel="stylesheet" href="Css/etec-style-usuario-servicos-responsible.css">
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">
                                     <!-- titulo da pagina -->
<title>Secretaria Acadêmica | Eletrô</title>

</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Secretaria Acadêmica  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 




 <div class="etec-container-horari ">
    <div class="etec-secreacademic-con1 etec-title-princip">
     <h1>Horário de expediente</h1>
     <P> A secretaria acadêmica mantém atendimento ao público em todos os períodos de funcionamento da Escola, de acordo com o quadro de horários afixado no hall de entrada do bloco administrativo, e também apresentado a seguir. Além do horário já mencionado, a secretaria terá reservado um período de trabalho exclusivamente para expediente interno.
     </P>
     <div  class="etec-table-elemento">
      <table  border="1" cellpadding="1" >
       <tr class="etec-table-title">
        <td colspan="2"><strong>Horário de atendimento<br>da secretaria</strong></td>
        <td>Tempo por período</td>
      </tr>
      <tr>
       <td>08:30</td>
       <td>10:00</td>
       <td>1:30 horas</td>
      </tr>
      <tr>
       <td>14:00</td>
       <td>16:00</td>
       <td>2:00 horas</td>
      </tr>
      <tr>
       <td>19:30</td>
       <td>21:15</td>
       <td>1:45 horas</td>
      </tr>
    </table>
   </div><!--fechamento da class"cont-table"-->
  </div><!--fechamento da class"etec-secreacademic-con1"-->
  
  <div class="etec-secreacademic-con2 etec-title-princip" >
    <h1>Semestre Letivo</h1>
    <h3>03/02/2020</h3>
    <h3>06/07/2020</h3>
    <h1>Horário das Aulas</h1>
    <h3>Integrado: 07:10 às 12:30 e 13:30 às 15:10</h3>
    <h3>Médio: 07:10 às 11:40</h3>
    <h3>Novotec: 07:10 às 12:30 </h3>
    <h3>Técnico:19:00 às 23:00</h3>
  
  </div><!--fechamento da class"etec-secreacademic-con2"-->
 </div><!--fechamento da classe "etec-container-horari"-->

  <div class="etec-secreacademic-programacao etec-title-princip">
   <h1>Programa Ação Jovem</h1>  
   <p>O Programa Ação Jovem é destinado a estudantes e pode ser solicitado a qualquer época na Secretaria Acadêmica, desde que o Aluno atenda as seguintes condições:</p>
   <ul class="cont-marg-resp-left5">
    <li>ter entre 15 anos completos e 24 anos e 11 meses de idade;</li>
    <li>estar cursando concomitantemente os Ensinos Médio/EJA(na Eletrô ou em outra Escola) e Técnico ou Ensino Integrado;</li>
    <li>ter renda per capita familiar mensal de até meio salário mínimo;</li>
    <li>ter domicílio no Município de Mococa.</li>
   </ul>
 </div><!-- fechamento da class"cont-direserv-sub-title"-->
  
  
 
 
 
 <div class="etec-secreacademic-programacao etec-title-princip ">
  <h1>Renovação de matrícula:</h1>  
  
  <p>As renovações de matrícula serão efetuadas em época prevista no calendário escolar. A renovação de matricula poderá ser realizada na secretaria acadêmica ou através do NSA online.</p>
  </div><!-- fechamento da class"cont-direserv-sub-title"-->
  
 <div class="etec-title-princip etec-secreacademic-programacao">
  <h1>Solicitação de documentos:</h1>  
  
  <p>Todo aluno<strong> concluinte terá seu Certificado/Diploma/Histórico expedido gratuitamente, e desde que não tenha nenhuma pendência acadêmica e/ou documental com a Escola</strong>, devendo o concluinte guardar com responsabilidade tais documentos, de forma que sempre que solicitado deve-se fornecer cópia autenticada dos mesmos, e nunca a via original, pois a confecção de segunda via terá o prazo mínimo de 05 (cinco) dias para expedição.
Atestados de matricula, boletim escolar e declarações para devidos fins, poderão ser solicitados a qualquer momento na secretaria acadêmica, respeitando, porém, os respectivos prazos de expedição, conforme relação apresentada abaixo:</p>
  </div><!-- fechamento da class"cont-direserv-sub-title"--> 
  
  

 
 <div class="etec-title-princip etec-secreacademic-programacao etec-list-roman">
 
     <h1>Aproveitamento de Estudos</h1>
       <ul>
        <li>Alunos de outra Unidade de Ensino:
         <ul>
          <li>Anexar Comprovante de que cursou com êxito o(s) componente(s) curricular(es);</li>
          <li>Anexar Conteúdo(s) programático(s).</li>
         </ul>
        </li>
        <li>Alunos desta Unidade de Ensino (Retidos e Promovidos):
         <ul>
          <li>Anexar boletim ou histórico escolar</li>
         </ul>
        </li>
       </ul>
    </div><!--fechamento da class"etec-title-princip etec-secreacademic-programacao"-->
     
      
     
    
  <div class="etec-secreacademic-reque-praz-man">   
    <div class="etec-secreacademic-reque-praz etec-title-princip">
      <h1>Modelos de Requerimentos e Declarações</h1>
       <ul>
        <li>Instruções para solicitações <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/instrucoesparasolicitacoes.doc">(Baixar)</a></li>
        <li>Condições Especiais Adventista <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/condicoesespeciaisadventistas.doc">(Baixar)</a></li>
        <li>Transferência de Período <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/transfperiodo.doc">(Baixar)</a></li>
        <li>Desistência de Vaga <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/desistenciavaga.doc">(Baixar)</a></li>
        <li>Reconsideração e Revisão de Menção <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/reconsideracaoderevisao.doc">(Baixar)</a></li>
        <li>Solicitação para Entrada Atrasada <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/entradaatrasado.doc">(Baixar)</a></li>
        <li>Solicitação para Saída Antecipada <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/saidaantecipada.doc">(Baixar)</a></li>
        <li>Condições Especiais Enfermo e Gestante <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/enfermoegestante.doc"> (Baixar)</a></li>
        <li>Trancamento de Matrícula - Frente <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/trancarmatricula.doc">(Baixar)</a></li>
        <li>Requerimento 2.ª Chamada de Prova <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/2chamadaprova.doc"> (Baixar)</a></li>
        <li>Dispensa em Educação Física <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/edfisica.doc">(Baixar)</a></li>
        <li>Solicitar 2.ª via do certificado/diploma <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/2viacertificado.doc">(Baixar)</a></li>
        <li>Transferência de Escola <a href="Documentacao/Secretaria academica/Modelos de Requerimentos e Declaracoes/transferescola.doc">(Baixar)</a></li>
       </ul>
       
        <div class="etec-title-princip etec-secreacademic-solict ">
         <h1>Solicitação de Documentos</h1>
         <p> Para solicitação de documentos junto a Secretaria Acadêmica encaminhar email para:<a href="mailto:e009acad@cps.sp.gov.br"> e009acad@cps.sp.gov.br</a></p>
        </div><!--fechamento da class"etec-secreacademic-solict "-->
        
     </div><!--fechamento da class"etec-secreacademic-requeri"-->
    
  <div class="etec-secreacademic-reque-praz etec-title-princip ">
   
      <h1>Prazos para expedição de documentos</h1>
       <ul>
        <li>Atestado de Matricula – um dia útil</li>
        <li>Atestado de Frequencia – um dia útil</li>
        <li>Atestado Parcial do Curso - quinze dias úteis</li>
        <li>Certidão de Conclusão – cinco dias úteis</li>
        <li>Histórico Escolar – 2.ª via – trinta dias úteis</li>
        <li>Carta para Fins de Estagio – cinco dias úteis</li>
        <li>Histórico para Transferência - sessenta dias úteis</li>
        <li>Atestado de Vaga – um dia útil</li>
        <li>Formulário de Passe Escolar – cinco dias úteis</li>
        <li>Revisão de Faltas - cinco dias úteis</li>
        <li>Conteúdo de Disciplinas - quinze dias úteis</li>
        <li>Outros Documentos: consultar a secretaria</li>
       </ul>
   </div><!--fechamento da class"cont-container-iten"-->
 </div>
 
 

<div class="etec-secreacademic-info-add etec-title-princip">
 <h1>Informações Adicionais</h1> 

<p>A secretaria acadêmica reserva o direito de não fornecer informações referentes aos dados ali arquivados, para o público externo, tendo em vista a sua obrigação legal de manter sigilo sobre os dados pessoais dos alunos.
Todos os documentos entregues na secretaria por ocasião da matrícula, serão arquivados em prontuário próprio, sem possibilidade de devolução, mesmo que haja desistência da vaga por parte do aluno.</p>
<p >A secretaria acadêmica não está autorizada a informar nenhum tipo de resultado de aproveitamento escolar, seja parcial, final ou até mesmo de progressão parcial antes da realização dos conselhos de classe. Toda divulgação oficial acontecerá através dos quadros de aviso e do site da Escola, e sempre nas datas estipuladas em calendário escolar.</p>
<p >O aluno poderá procurar a secretaria, dentro do seu horário de atendimento, para informações adicionais e demais esclarecimentos que não constam neste manual, estando esta sempre a disposição para atendê-lo e esclarecer suas dúvidas. Informações também poderão ser solicitadas via e-mail – através do endereço – e009acad@cps.sp.gov.br</p> 

<strong  class="cont-marg-left1">A secretaria acadêmica não se responsabiliza por informações inconsistentes fornecidas por pessoas que não trabalham no setor, ou ainda, por documentos que não sejam devidamente protocolados pela própria secretaria.</strong>
 </div><!---fechamento  da classe-->

<?php 

if($conselho){
	
	$periodos = array('Ensino médio','Ensino integrado','Ensino integrado - Novotec','Ensino técnico');
	
	$conselhoclasse->setConselho($conselho->ccs_id);

?>
<!--conselho de class-->
<div class="etec-refeitorio-prestacoes-conts">
	<h1>Resultados do conselho de classe <?php echo $conselho->ccs_ano.' - '.$conselho->ccs_semestre; ?>:</h1>
<?php
	
	foreach($periodos as $key => $p):
	
		$conselhoclasse->setPeriodo($p);
		
		$arquivos = $conselhoclasse->findAll($ativo = 'S', $periodo = 'S');	
		
		if($arquivos){
		
?>
    <div class="etec-table-elemento">
        <table width="200" border="1" cellpadding="1" class="">
            <caption> 
<?php 

			echo $periodos[$i];
			 
?>
            </caption>  
            <tr id="cont-table-title">
                <td  >
                    Anos
                </td>
                <td >
                    Arquivo
                </td>
            </tr> 
<?php 

			foreach($arquivos as $key => $value):

?>  
            <tr>
                <td>
<?php 

				echo $value->cc_turma;	 
		
?>
                </td>
                <td class="cont-td-doc ">
                    <a href="<?php echo $value->cc_documento; ?>" target="_blank">
                        Download
                    </a>
                </td> 
            </tr>
<?php 

			endforeach;

?>
        </table>
    </div><!--fechamento da class"cont-table"-->
<?php 

		}
		
	endforeach;

?>
  
</div><!--fehchamento da class"refeitorio-prestacoes-cont"-->
<?php 

}

?> 
 
 
</div><!--fechamento da classe "main-conteiner"-->
 
  

  
  


 

<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>


</body>
</html>