<?php 

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$apm_ano = new ApmAno();
$apm_ano_membro = new ApmMembro();
$apm_ano_plano_trabalho = new ApmPlanoTrabalho();

$apm =$apm_ano->findLast();
  
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
<link rel="stylesheet" href="Css/etec-style-usuario-escola.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola-responsible.css">
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">
                   <!--titulo da pagina-->
<title>APM <?php if($apm){ echo $apm->aa_ano; } ?> | Eletrô</title>

</head>

<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<!--Abertura da class aonde ficara todo o conteudo da pagina -->
<main class="main-conteiner"> 
 
  <header class="etec-container-indicator">
   <div class="etec-container-indicator-item"> APM <?php if($apm){ echo $apm->aa_ano; } ?> | <a href="index.php">Eletrô</a> </div>
  </header><!-- fechamento da class"container-indicator-->
 
<?php
 
if($apm){
	
	$apm_ano_membro->setAno($apm->aa_id);

	$membros = $apm_ano_membro->findAll('S');
	
	if($membros){
	 
?>
 <div class="etec-table-elemento  etec-title-princip etec-apm-compisit">
   <h1>Composição da Associação de Pais e Mestres (APM) da Etec JBLF para o ano de  <?php echo $apm->aa_ano; ?></h1>
   
   <div class="cont-table">
   <table >
  <caption >
    Diretoria Executiva
  </caption>
<?php

		foreach($membros as $key => $value):
  
?>
  <tr>
    <td><?php echo $value->am_nome; ?></td>
    <td><?php echo $value->am_cargo; ?></td>
    <td>RG. <?php echo $value->am_rg; ?></td>
  </tr>
<?php

		endforeach;

?>
</table>
 </div><!-- fechamento da class"cont-table"-->
 </div>
<?php

	}
	
	$apm_ano_plano_trabalho->setAno($apm->aa_id);

	$plano_trabalho = $apm_ano_plano_trabalho->findAll('S');
	
	if($plano_trabalho){

?> 
 <div class="etec-apm-plano-trabalho etec-title-princip"> 
  <h1>Plano de trabalho proposto para o ano de <?php echo $apm->aa_ano; ?></h1>
  
   <div class="etec-apm-iten">A APM da ETEC João Baptista de Lima Figueiredo, como importante parceira da Escola, propõe a realização das seguintes atividades para o ano de <?php echo $apm->aa_ano; ?>:
   </div><!-- fechamento da class"cont-iten"-->
   
   <ul>
<?php

		foreach($plano_trabalho as $key => $value):

?>
    <li><?php echo $value->apt_descricao; ?></li>
<?php

		endforeach;

?>
   <ul>
   
  
 </div><!--fechamento da class"cont-text"-->
<?php

	}

}

?>
  <div class="etec-apm-estuto-tile etec-title-princip">
    <h1>Estatuto padrão da associação de pais e mestres da etec JBLF</h1>  
  </div>
  <div class="etec-apm-capitulo ">
   <h1>Capitulo I</h1>
   <h2>Da Instituição, da Natureza e Finalidade da Associação de Pais e Mestres.</h2> 
   <h3>Seção I</h3>
   <h4>Da Instituição</h4>
   <p>Artigo 1º - A Associação de Pais e Mestres da ETE “João Baptista de Lima Figueiredo”, fundada em data de 15/01/1971 é uma pessoa jurídica de direito privado, sem fins econômicos, designada simplesmente APM, com sede na Av. Dr. Américo Pereira Lima, s/nº , na cidade de Mococa- Estado de São Paulo, reger-se-á pelas presentes normas estatutárias.</p>
   <h3>Seção II</h3>
   <h4>Da Natureza e Finalidade</h4>
   <p>Artigo 2º - A APM, instituição auxiliar da escola, terá por finalidade colaborar no aprimoramento do processo educacional, na assistência ao escolar e na integração família-escola-comunidade.</p>
   <p>Artigo 3º - A APM, entidade com objetivos sociais e educativos, não terá caráter político, racial ou religioso e nem finalidades lucrativas.</p>
   <p>Artigo 4º - Para a consecução dos fins a que se referem os artigos anteriores, a Associação se propõe a:</p>
     <ul>
         <li>colaborar com a direção do estabelecimento para atingir os objetivos educacionais propostos pela escola;</li>
         <li>representar as aspirações da comunidade e dos pais de alunos junto à escola;</li>
         <li>mobilizar os recursos humanos, materiais e financeiros da comunidade, para auxiliar a escola, no que diz respeito a:
           <ul>
            <li>a melhoria do ensino;</li>
            <li>o desenvolvimento de atividades de assistência ao escolar carente, nas áreas socio-econômica e de saúde;</li>
            <li>a conservação e manutenção do prédio, máquinas e equipamentos e das instalações técnicas;</li>
            <li> programação de atividades culturais e lazer que envolvam a participação conjunta de pais, professores e alunos.</li>
           </ul>
         </li>
         <li>colaborar  na programação do uso do prédio da escola pela comunidade, principalmente nos períodos ociosos.</li>
         <li>favorecer o entrosamento entre pais e professores.</li>
         <li>prestar serviços à comunidade, oferecendo cursos, de educação profissional de nível básico, promovendo eventos e outras atividades mediante retribuição financeira, através de convênios, parcerias, termo de cooperação ou de iniciativa própria.</li>
        </ul>
      <p>Artigo 5º - As atividades a serem desenvolvidas para alcançar os objetivos especificados nos incisos do artigo anterior, deverão integrar a Proposta Pedagógica da U.E.</p>
    <h3>Seção III</h3>
    <h4>Dos Meios e Recursos</h4>
    <p>Artigo 6º - Os meios e recursos para atender os objetivos da APM, serão obtidos através de:</p>
     <ul>
         <li>contribuição dos associados;</li>
         <li>convênios e parcerias;</li>
         <li>subvenções diversas;</li>
         <li>doações;</li>
         <li>promoções diversas;</li>
         <li>retribuição pelos serviços e atendimento prestados à comunidade, na forma prevista pelo inciso VI do artigo 4º;</li>
         <li>outras fontes.</li>
        </ul> 
     <p>Artigo 7º - A contribuição a que se refere o inciso I do artigo anterior será sempre facultativa.</p>
         <ul>
          <li>1º - O caráter facultativo das contribuições não isenta os associados do dever moral de, dentro de suas possibilidades, cooperar para a constituição do fundo financeiro da Associação.</li>
          <li>2º - No final de cada ano serão fixadas a forma e a época para a campanha de arrecadação das contribuições dos associados, para o período letivo subsequente.</li>
          <li>3º - As contribuições serão depositadas nas agências do Banco Nossa Caixa S/A, em conta vinculada à APM, que só poderá ser movimentada conjuntamente, pelo Diretor Executivo e Diretor Financeiro.</li>
          <li>4º - Nas localidades onde não houver os estabelecimentos de crédito referidos no parágrafo anterior, as contribuições serão depositadas nas agências bancárias onde o Estado ou a Prefeitura mantiverem transações.</li>
         </ul>
      <p>Artigo 8º - A aplicação dos recursos financeiros constará do Plano Anual de Trabalho da APM, integrando o plano escolar.</p>   
          
  </div>
  
  <div class="etec-apm-capitulo ">
   <h1>Capitulo II</h1>
   <h2>Dos Associados, seus Direitos e Deveres</h2>  
   <h3>Seção I</h3>
   <h4>Dos Associados</h4>
   <p>Artigo 9º - O quadro social da APM, constituído por número ilimitado de associados, será composto de:</p>
     <ul>
        <li>associados natos.</li>
        <li>associados admitidos.</li>
        <li>associados honorários.</li>
        <li>
         <ul>
          <li>1º - Serão associados natos o Diretor de Escola, o Vice-Diretor, os professores e demais integrantes dos núcleos de apoio técnico-pedagógico e administrativo da escola, os pais de alunos e os alunos maiores de 18 anos, desde que concordes.</li>
          <li>2º - Serão associados admitidos os pais de ex-alunos, os ex-alunos maiores de 18 anos, os ex-professores e demais membros da comunidade, desde que concordes e aceitos conforme as normas estatutárias.</li>
          <li>3º - Serão considerados associados honorários, a critério do Conselho Deliberativo, aqueles que tenham prestado relevantes serviços à Educação e a APM.</li>
          
         </ul>
        </li>
       </ul>
     <h3>Seção II</h3>
     <h4>Dos Direitos e Deveres</h4>  
     <p>Artigo 10 - Constituem direitos dos associados:
     <ul>
        <li>apresentar sugestões e oferecer colaboração aos dirigentes dos vários órgãos da APM;</li>
        <li>receber informações sobre a orientação pedagógica da escola e o ensino ministrado aos educandos;</li>
        <li>participar das atividades culturais, sociais, esportivas e cívicas organizadas pela APM;</li>
        <li>votar e ser votado nos termos do presente Estatuto;</li>
        <li>solicitar, quando em Assembléia Geral, esclarecimentos a respeito da utilização dos recursos financeiros da APM;</li>
        <li>apresentar pessoas da comunidade para ampliação do quadro social;</li>
        <li>demitir-se quando julgar conveniente, protocolando junto à Secretária da APM seu pedido de demissão.</li>
      </ul>
      <p>Artigo 11 - Constituem deveres dos associados:</p>
      <ul>
       <li>defender, por atos e palavras, o bom nome da Escola e da APM;</li>
       <li>conhecer o Estatuto da APM;</li>
       <li>participar das reuniões para as quais foram convocados;</li>
       <li>desempenhar, responsavelmente, os cargos e as missões que lhes forem confiados;</li>
       <li>concorrer para estreitar as relações de amizade entre todos os associados e incentivar a participação comunitária na escola;</li>
       <li>cooperar, dentro de suas possibilidades, para a constituição do fundo financeiro da APM;</li>
       <li>prestar à APM, serviços gerais ou de sua especialidade profissional, dentro e conforme suas possibilidades;</li>
       <li>zelar pela conservação e manutenção do prédio, da área do terreno e equipamentos escolares.</li>
       
      </ul>
       <p>Artigo 12 – A exclusão do associado do quadro social só é admissível havendo justa causa, assim reconhecida em procedimento que assegure direito de defesa perante a Diretoria Executiva e de recurso para o Conselho Deliberativo, que se reunirá em sessão extraordinária para apreciar o fato.</p>
       <ul>
          <li>1º - O associado será cientificado, por escrito e pessoalmente, dos fatos que lhe são imputados e das conseqüências a que estará sujeito, para, no prazo de 15 (quinze) dias oferecer defesa e indicar, justificadamente, as provas que pretende produzir, cuja pertinência será aferida, de forma motivada, pela Diretoria Executiva.</li>
          <li>2º - Decorrido in albis o prazo previsto no parágrafo anterior, ou produzidas as provas deferidas pela Diretoria Executiva, será o associado notificado, pessoalmente, para oferecer suas razões finais, no prazo de 7 (sete) dias, dirigidas à Diretoria Executiva, que decidirá, motivadamente, no prazo de 20 (vinte) dias, comunicando a decisão ao Conselho Deliberativo.</li>
          <li>3º - Intimado o associado, pessoalmente da decisão, poderá interpor recurso no prazo de 15 (quinze) dias, dirigido ao Conselho Deliberativo, que decidirá, de maneira motivada, no prazo de 20 (vinte) dias.</li>
          <li>4º - Os prazos para apresentação de defesa, razões finais e interposição do recurso serão contados por dias corridos, excluindo-se o dia do começo e incluindo-se o do vencimento.</li>
          <li>5º - Considera-se prorrogado o prazo até o primeiro dia útil se o vencimento ocorrer em sábado, domingo ou feriado.</li>
          <li>6º - Os prazos somente começam a correr a partir do primeiro dia útil após a intimação.</li>
         </ul>
     
        
  </div>
  <div class="etec-apm-capitulo ">
   <h1>Capitulo III</h1>  
   <h2>Da Administração</h2>
   <h3> Seção I</h3>
   <h4>Dos Órgãos Diretores</h4>
   <p>Artigo 13 - A APM será administrada pelos seguintes órgãos:</p>
   <ul>
    <li>Assembléia Geral.</li>
	<li>Conselho Deliberativo.</li>
	<li>Diretoria Executiva.</li>
	<li>Conselho Fiscal.</li>
   </ul>
   <p>Artigo 14 - A Assembléia Geral será constituída pela totalidade dos associados.</p>
    <ul>
     <li>1º - A Assembléia será convocada e presidida pelo Diretor da Escola.</li>
     <li>2º- A Assembléia realizar-se-á, em primeira convocação, com a presença de mais da metade dos associados ou, em segunda convocação, meia hora depois, com qualquer número.</li>
     <li>3º -Para as deliberações é exigido voto concorde da maioria dos presentes à Assembléia.</li>
    </ul>
    <p>Artigo 15 - Cabe à Assembléia Geral:</p>
    <ul>
	 <li>eleger e destituir membros do Conselho Deliberativo, do Conselho Fiscal e da Diretoria Executiva;</li>
	 <li>apreciar o balanço anual e os balancetes semestrais, com o parecer do Conselho Fiscal e aprovar as contas;</li>
	 <li>propor e aprovar a época e a forma das contribuições dos associados, obedecendo ao que dispõe o artigo 7º do presente Estatuto;</li>
	 <li>reunir-se, ordinariamente, pelo menos 1 (uma) vez cada semestre;</li>
	 <li>reunir-se, extraordinariamente, convocada pelo Diretor da Escola ou por 2/3 (dois terços) dos membros do Conselho Deliberativo ou por 1/5 (um quinto) dos associados;</li>
     <li>destituir os administradores eleitos;</li>
     <li>deliberar sobre alteração do Estatuto.</li>
    </ul>
    <p class="etec-apm-p-unic">Parágrafo único – A destituição de administradores e a alteração do Estatuto, serão deliberadas em Assembléia Geral convocada especialmente para tais fins.</p>
    <p>Artigo 16 - O Conselho Deliberativo deverá ser constituído de no mínimo, 11 (onze) membros.</p>
    <ul>
     <li>1º - O Diretor da Escola será o seu presidente nato.</li>
     <li>2º - Os demais componentes, eleitos em Assembléia Geral, obedecerão as seguintes proporções:
       <ul>
         <li>30% dos membros serão professores.</li>
         <li>40% dos membros serão pais de alunos.</li>
         <li>20% dos membros serão alunos maiores de 18 anos.</li>
         <li>10% dos membros serão associados admitidos.</li>
       </ul></li>
      <li>3º - Não sendo atingidas as proporções enumeradas nas alíneas “c” e “d” do parágrafo anterior, as vagas serão preenchidas, respectivamente, por elementos da escola e pais de alunos, na proporção fixada no parágrafo anterior.</li>
      <li>4º - Os professores com filhos matriculados na Escola somente poderão integrar o segmento professor.</li>
     </ul> 
     <p>Artigo 17 - Cabe ao Conselho Deliberativo:</p>
       <ul>
		<li>divulgar a todos os associados os nomes dos eleitos na forma do artigo 15, inciso I, bem como as normas do presente estatuto, para conhecimento geral;</li>
		<li>deliberar sobre o disposto no artigo 4º, no inciso IV do artigo 32 e artigo 44.;</li>
		<li>aprovar o Plano Anual de Trabalho e o Plano de Aplicação de Recursos;</li>
		<li>participar do Conselho de Escola, através de um de seus membros, que deverá ser, obrigatoriamente, pai de aluno;</li>
		<li>realizar estudos e emitir pareceres sobre questões omissas no Estatuto, submetendo-o à apreciação dos órgãos superiores do CEETEPS;</li>
		<li>emitir parecer sobre as contas apresentadas pela Diretoria Executiva, submetendo-as à apreciação da Assembléia Geral;</li>
        <li>reunir-se, ordinariamente, pelo menos 1 (uma) vez por trimestre e, extraordinariamente, sempre que convocado, a critério de seu Presidente ou de 2/3 (dois terços) de seus membros.</li>
       </ul>   
       <p class="etec-apm-p-unic">Parágrafo único - As decisões do Conselho Deliberativo só terão validade se aprovadas por maioria absoluta (1ª convocação) ou maioria simples (2ª convocação) de seus membros.</p>
       <p>Artigo 18 – Cabe ao Presidente do Conselho Deliberativo:</p>
       <ul>
		<li>convocar e presidir as reuniões da Assembléia Geral e do Conselho Deliberativo;</li>
		<li>indicar um Secretário, dentre os membros do Conselho Deliberativo;</li>
		<li>informar os conselheiros sobre as necessidades da escola e dos alunos.</li>
	   </ul>       
       <p>Artigo 19 – O mandato dos conselheiros será de 1 (um) ano, sendo permitida a recondução por mais 2 (duas) vezes.</p>
       <p class="etec-apm-p-unic"> Parágrafo Único – Perderá o mandato o membro do Conselho Deliberativo que faltar a duas reuniões consecutivas sem causa justificada.</p>
       <p>Artigo 20 – A Diretoria Executiva da APM será composta de:</p>
       <ul>
		<li>Diretor Executivo;</li>
		<li>Vice-Diretor Executivo;</li>
		<li>Secretário;</li>
		<li>Diretor Financeiro;</li>
		<li>Vice Diretor Financeiro;</li>
        <li> Diretor Cultural, Esportivo e Social;</li>
        <li>Diretor de Patrimônio.</li>
	  </ul>
      <p class="etec-apm-p-unic">Parágrafo Único – Poderá haver indicação de alunos para a composição da diretoria executiva, exclusivamente para as funções previstas nos incisos III e VI.</p>
      <p>Artigo 21 – Cabe à Diretoria Executiva:</p>
      <ul>
	   <li>elaborar o Plano Anual de Trabalho, submetendo-o à aprovação do Conselho Deliberativo;</li>
	   <li>colocar em execução o Plano aprovado e mencionado no inciso anterior;</li>
	   <li>dar à Assembléia Geral conhecimento sobre:
        <ul>
         <li>as diretrizes que norteiam a ação pedagógica da escola;</li>
         <li>as normas estatutárias que regem a APM;</li>
         <li>as atividades desenvolvidas pela Associação e a programação e aplicação dos recursos do fundo financeiro.</li>
        </ul>
       </li>
	   <li>depositar em conta da APM, em estabelecimento de crédito oficial do Estado de São Paulo, todos os valores recebidos;</li>
	   <li>tomar medidas de emergência, não previstas no Estatuto, submetendo-as ao “referendo” do Conselho Deliberativo;</li>
       <li>reunir-se, ordinariamente, pelo menos 1 (uma) vez por bimestre e, extraordinariamente, a critério de seu Diretor Executivo ou por solicitação de 2/3 (dois terços) de seus membros.</li>
      </ul>
      <p class="etec-apm-p-unic">Parágrafo Único – A fixação das prioridades para aplicação dos recursos do fundo financeiro deverá ser submetida à apreciação do Conselho de Escola.</p>
      <p>Artigo 22 – Compete ao Diretor Executivo:</p>
      <ul>
	   <li>representar a APM ativa e passivamente, judicial e extrajudicialmente;</li>
	   <li>convocar as reuniões da Diretoria Executiva, presidindo-as;</li>
	   <li>fazer cumprir as deliberações do Conselho Deliberativo;</li>
	   <li>apresentar ao Conselho Deliberativo relatório semestral das atividades da Diretoria;</li>
	   <li>admitir e/ou dispensar pessoal de seu quadro, obedecidas as decisões do Conselho Deliberativo;</li>
       <li>movimentar, conjuntamente com o Diretor Financeiro, os recursos da Associação;</li>
       <li>visar as contas a serem pagas;</li>
       <li>submeter os balancetes semestrais e o balanço anual ao Conselho Deliberativo e Assembléia Geral, após apreciação escrita do Conselho Fiscal;</li>
       <li>rubricar e publicar em quadro próprio da APM, os balancetes semestrais e o balanço anual.</li>
	  </ul>
      <p>Artigo 23 - Compete ao Vice-Diretor Executivo auxiliar o Diretor Executivo e substituí-lo em seus impedimentos eventuais..</p>
      <p>Artigo 24 - Compete ao Secretário:</p>
      <ul>
	   <li>lavrar as atas das reuniões e Assembléias Gerais;</li>
	   <li>redigir circulares e relatórios e encarregar-se da correspondência social;</li>
	   <li>assessorar o Diretor Executivo nas matérias de interesse da Associação;</li>
	   <li>organizar e zelar pela conservação do arquivo da APM;</li>
	   <li>organizar e manter atualizado o cadastro dos associados da APM.</li>
	  </ul>
      <p>Artigo 25 - Compete ao Diretor Financeiro:</p>
      <ul>
		<li>subscrever com o Diretor Executivo os cheques da conta bancária da APM;</li>
		<li>efetuar, através de cheques nominais, os pagamentos autorizados pelo Diretor Executivo, de conformidade com aplicação de recursos planejada;</li>
		<li>apresentar ao Diretor Executivo os balancetes semestrais e balanço anual, acompanhado dos documentos comprobatórios de receita e despesa;</li>
		<li>informar os órgãos diretores da APM sobre a situação financeira da Associação;</li>
		<li>promover concorrência de preços, quanto aos serviços e materiais adquiridos pela APM ;</li>
        <li>arquivar notas fiscais, recibos e documentos relativos aos valores recebidos e pagos pela Associação apresentando-os para elaboração da escrituração contábil.</li>
	 </ul>
      <p>Artigo 26 - O cargo de Diretor Financeiro será sempre ocupado por pai de aluno.</p>
      <p>Artigo 27 - Compete ao Vice-Diretor Financeiro auxiliar o Diretor Financeiro e substituí-lo em seus impedimentos eventuais.</p>
      <p>Artigo 28 - Cabe ao diretor Cultural e Esportivo e Social promover a integração escola-comunidade através de atividades culturais, esportivas, sociais e assistenciais, assessorado nas atividades a serem desenvolvidas, pelos professores da Escola.</p>
      <p>Artigo 29 - Cabe ao Diretor de Patrimônio manter entendimentos com a Direção da Escola no que se refere à:</p>
      <ul>
	   <li>aquisição de materiais, inclusive didáticos;</li>
	   <li> manutenção e conservação do prédio e de equipamentos e supervisão dos serviços contratados.</li>
      </ul>
      <p class="etec-apm-p-unic">Parágrafo Único – O Diretor de Patrimônio poderá ser assessorado pelos membros do Conselho de Escola.</p>
      <p>Artigo 30 – Os Diretores terão, ainda, por função:</p>
      <ul>
	   <li>comparecer às reuniões da Diretoria, discutindo e votando;</li>
	   <li>estabelecer contato com as outras APMs ou entidades oficiais e particulares;</li>
	   <li>construir comissões auxiliares com vistas à descentralização de suas atividades;</li>
	   <li>elaborar contratos e celebrar convênios com a aprovação do Conselho Deliberativo;</li>
	  </ul>
      <p class="etec-apm-p-unic">Parágrafo Único: A Diretoria Executiva poderá elaborar contratos e celebrar convênios, nos termos do Artigo 6o, com a aprovação do Conselho Deliberativo.</p>
      <p>Artigo 31 – O mandato de cada Diretor será de 1 (um) ano, sendo permitida sua recondução, mais uma vez para o mesmo cargo.</p>  
      <ul>
       <li>1º - Perderá o mandato o membro da Diretoria que faltar a três reuniões consecutivas, sem causa justificada.</li>
       <li>2º - No caso de impedimento ou substituição de qualquer membro da Diretoria, o Conselho Deliberativo tomará as devidas providências.</li>
      </ul>
      <p>Artigo 32 – O Conselho Fiscal, constituído de 3 (três) elementos, sendo 2 (dois) pais de alunos e 1(um) representante do quadro administrativo ou docente da Escola, tem por atribuição:</p>
      <ul>
	   <li>verificar os balancetes semestrais e balanços anuais apresentados pela Diretoria, emitindo parecer por escrito;</li>
	   <li>assessorar a Diretoria na elaboração do Plano Anual de Trabalho na parte referente à aplicação de recursos;</li>
	   <li>examinar, a qualquer tempo, os livros e documentos da Diretoria Financeira;</li>
	   <li>dar parecer, a pedido da Diretoria ou Conselho Deliberativo sobre resoluções que afetem as finanças da APM;</li>
	   <li>solicitar ao Conselho Deliberativo, se necessário, a contratação de serviços de auditoria contábil.</li>
	  </ul>
      <p class="etec-apm-p-unic">Parágrafo único - O mandato dos Conselheiros será de um ano, sendo permitida a reeleição por mais uma vez..</p>
      <p>Artigo 33 - O Conselho Fiscal reunir-se-á, ordinariamente, a cada semestre e, extraordinariamente, mediante convocação da maioria de seus membros ou Diretoria Executiva.
      
  </div>
  
   <div class="etec-apm-capitulo ">
    <h1>Capitulo IV</h1>
    <h2>Da Intervenção</h2>
    <p>Artigo 34 - Sempre que as atividades da APM venham a contrariar as finalidades definidas neste Estatuto ou ferir a legislação vigente, poderá haver intervenção, mediante solicitação da Direção da escola ou de membros da Associação às autoridades competentes.</p>
    <ul>
     <li>1º- O processo regular de apuração dos fatos será feito pelos órgãos competentes do CEETEPS.</li>
     <li>2º- A intervenção será determinada pelo Diretor Superintendente do CEETEPS.</li>
    </ul>  
   </div>
   
   <div class="etec-apm-capitulo ">
    <h1>Capitulo V</h1>
    <h2>Das Disposições Finais</h2>
    <p>Artigo 35 - O Diretor da Escola poderá participar das reuniões da Diretoria Executiva, intervindo nos debates, prestando orientação ou esclarecimento, ou fazendo constar em atas seus pontos de vista, mas sem direito a voto.</p>
    <p>Artigo 36 - É vedado aos Conselheiros e Diretores:</p>
    <ul>
	  <li>receber qualquer tipo de remuneração e  estabelecer relações contratuais com a APM deles próprios e de parentes até 2º grau ou cônjuge.</li>
    </ul>
    <p>Artigo 37 - Ocorrida vacância de cargos do Conselho Deliberativo, do Conselho Fiscal ou da Diretoria Executiva, o preenchimento dos mesmos processar-se-á por decisão dos membros do respectivo órgão deliberativo que se reunirá para este fim.</p>
    <p class="etec-apm-p-unic">Parágrafo único - O preenchimento a que se refere este artigo visa tão-somente à conclusão de mandato da vaga ocorrida.</p>
    <p>Artigo 38 - Serão afixadas em quadro de avisos, os planos de atividades, notícias e atividades da Associação, convites, convocações e prestações de contas.</p>  
    <p>Artigo 39 - O balanço anual será submetido à apreciação do Conselho Fiscal, que deverá manifestar-se no prazo de 5 (cinco) dias, e até 10 (dez) dias antes da convocação da Assembléia geral.</p>
    <p>Artigo 40 - O Edital de convocação da Assembléia Geral, com cinco dias de antecedência da reunião, conterá:</p>
    <ul>
	 <li> dia, local e hora da 1ª e 2ª convocações;</li>
	 <li> ordem do dia.</li>
	 <li>
      <ul>
       <li>1º - Além de ser afixado no quadro de avisos da escola, será obrigatório o envio de circular aos associados.</li>
       <li>2º - A convocação da Assembléia Geral e dos demais órgãos deliberativos far-se-á na forma deste estatuto, garantido a 1/5 (um quinto) dos associados o direito de promovê-la.</li>
      </ul>
     </li>
    </ul> 
    <p>Artigo 41 - A APM deverá ser devidamente registrada junto aos órgãos públicos competentes.</p>
    <p>Artigo 42 - No exercício de suas atribuições, a APM manterá rigoroso respeito às disposições legais, de modo a assegurar a observância dos princípios fundamentais que norteiam a filosofia e política educacionais do Estado.</p>
    <p>Artigo 43 - Cabe a APM deliberar sobre a administração da cantina escolar e outros órgãos, assim como, sobre a aplicação de seus recursos priorizados pelo Conselho de Escola.</p>
    <p>Artigo 44 - Os bens permanentes doados à APM ou por ela adquiridos serão identificados, contabilizados, inventariados e integrarão o seu patrimônio.</p>
    <p class="etec-apm-p-unic"> Parágrafo Único – Os bens adquiridos com recursos públicos, deverão ser transferidos para integrar o patrimônio do estabelecimento de ensino.</p>
    <p>Artigo 45 - A APM terá prazo indeterminado de duração e somente poderá ser dissolvida, por deliberação da Assembléia Geral, especialmente convocada para este fim, obedecidas as disposições legais.</p>
    <p>Artigo 46 - Os membros não respondem subsidiariamente pelas obrigações sociais assumidas em nome da APM.</p>
    <p>Artigo 47 - Em caso de dissolução, os bens da APM passarão a integrar o patrimônio do estabelecimento de ensino respectivo, obedecida a legislação vigente.</p>
    <p>Artigo 48 - Qualquer modificação e ou adendo neste Estatuto deverá ser submetida ao Conselho Deliberativo do CEETEPS.</p>
    <p> Mococa ,  29 de novembro  de  2006.</p>
    <p>Legislação:</p>
        <ul>
		<li>Lei 1490, de 12/12/1977 – Disciplina o funcionamento das APMs e dá providências correlatas;</li>
		<li>Decreto 12983, de 15/12/1978 – Estabelece o Estatuto-Padrão das APMs;</li>
		<li>Decreto 48408, de 06/01/2004 – Altera e acrescenta dispositivos que especifica ao Estatuto Padrão das Associações de Pais e Mestres – APM, estabelecido pelo Decreto ? 12.983, de 15 de dezembro de 1978 e dá providências correlatas;</li>
		<li>Decreto 50576, de 03/05/2006 – Altera o Estatuto Padrão das Associações de Pais e Mestres, estabelecido pelo Decreto ? 12.983, de 15 de dezembro de 1978, e dá providência correlata.</li>
		
		</ul>  
   </div>
    

       

        
 
  
    
 
 </div><!--Fechamento da class"container-text-pad"-->
 
 <div class="cont-marg-bot2 cont-separaded-ses"></div>
</main><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>