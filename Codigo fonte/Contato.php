<?php
  if((isset($_POST['nome']))||(isset($_POST['email']))||(isset($_POST['mensagem']))||(isset($_POST['destinatario']))||(isset($_POST['assunto']))){
	  ini_set('display_errors', 1);

      error_reporting(E_ALL);
     
      $nome = $_POST['nome'];
	  
      $from = $_POST['email'];
      
	  $assunto = $_POST['assunto'];
      
	  $destinatario = $_POST['destinatario'];

	  if($destinatario == 'Secretaria Academica'){
      $to = "e009adm@cps.sp.gov.br";
	  }
	  if($destinatario == 'Cordenacao pedagogica'){
      $to = "pedagogico@eletro.g12.br";
	  }
	  if($destinatario == 'Setor de Estagios'){
      $to = "suportalunoeletro@gmail.com";
	  }
	  if($destinatario == 'Diretoria da ETEC'){
      $to = "e009dir@cps.sp.gov.br";
	  }
	  if($destinatario == 'Desenvolvedores'){
      $to = "leandro_ricardo99@outlook.com";
	  }
      $subject = "Assunto".$assunto." De:".$nome." E-mail:".$from;

      $message = $_POST['mensagem'];

      if((strlen($message)>=50)||(strlen($nome)>=10)){
        mail($to, $subject, $message);
		$resultado = 'A mensagem de e-mail foi enviada.';
	  }else{
	    $resultado = 'Erro ao enviar verifique se nome está correto e se a mensagem possui no mínimo 50 caracteres.';
	  }
      echo '<script language="javascript">';
	  echo 'alert(\''.$resultado.'\');';
	  echo '</script>';
  }
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

<link rel="stylesheet" href="Css/etec-style-usuario-rest.css">
<link rel="stylesheet" href="Css/etec-style-usuario-rest-responsible.css">
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">

                          <!-- titulo da pagina -->
<title>Contato | Eletrô</title>
 

</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Contato | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 
<div class="etec-contat-main"> 
 <div class="etec-contat-colun-one">
   
   <div class="etec-contat-tel etec-cont-backgroud">
    <h1>Telefone Da Escola</h1>
   <ul class="etec-contat-list">
    <li>(19) 3656 2052</li>
    <li>(19) 3656 2077</li>
   </ul>
  </div><!--fechamento da class"etec-cont-backgroud "-->
  
  <div class="etec-cont-backgroud ">
   <h1>Ramais</h1>
   <ul class="etec-contat-list">
    <li>Núcleo de Relações Institucionais (ATA) : 200</li>
    <li>Diretoria: 201</li>
    <li>Secretaria Acadêmica: 202</li>
    <li>Departamento de Compras: 203</li>
    <li>Setor Pedagógico: 204</li>
    <li>Departamento de Pessoal: 206</li>
    <li>Orientação Escolar: 207</li>
    <li>Coordenação: 208</li>
    <li>Atendentes de Classe: 209</li>
    <li>Diretoria de Serviços: 211</li>
    <li>Biblioteca: 213</li>
   </ul>
  </div> <!--fechamento da class"etec-cont-backgroud "-->
  
  <div class="etec-cont-backgroud ">
   <h1>Alguns Endereços de E-mail</h1>
   <ul class="etec-contat-list">
   
    <li>e009acad@cps.sp.gov.br</li>
    <li>pedagogico@eletro.g12.br</li>
    <li>e009op@cps.sp.gov.br</li>
    <li>e009adm@cps.sp.gov.br</li>
    <li>e009dir@cps.sp.gov.br</li>
   </ul>
  </div><!--fechamento da class"etec-cont-backgroud "-->

 </div><!--fechamento da class"etec-contat-colun-one"-->
 
 <div class="etec-contat-colun-two">
  <div class="etec-cont-backgroud etec-contat-form-man">
   <form action="" method="post">
    <div class="etec-contat-form-input"><input name="nome" type="text" placeholder="Nome"></div>
    <div class="etec-contat-form-input"><input type="email" name="email" placeholder="E-mail"></div>
    <div class="etec-contat-form-mens"><br><textarea name="mensagem" placeholder="Mensagem"></textarea></div>
    <div class="etec-contat-form-select">
     <p>Assunto:</p>
     <select name="assunto" >
      <option value="Secretaria Academica">Solicitação</option>
      <option value="Secretaria Academica">Reclamação</option>
      <option value="Cordenacao pedagogica">Opinião</option>
      <option value="Secretaria de Estagios">Dúvidas</option>
      <option value="Secretaria Academica">Outro</option>
     </select>
    </div>
   <div class="etec-contat-form-select">
    <p>Enviar para:</p>
    <select name="destinatario" >
     <option value="Secretaria Academica">Secretaria Acadêmica</option>
     <option value="Cordenacao pedagogica">Coordenação Pedagógica</option>
     <option value="Setor de Estagios">Setor de Estágios</option>
     <option value="Diretoria da ETEC">Diretoria da ETEC</option>
     <option value="Desenvolvedores">Desenvolvedores</option>
    </select>
   </div>
   <div class="etec-contat-form-btn "><input name="enviar" type="submit" value="Enviar"></div>
  </form>
 </div>
  
  <div class="etec-cont-enderec etec-cont-backgroud"> 
   <h1>Endereço Da Escola</h1>
   <ul class="etec-contat-list">
    <li>Av. Dr. Américo Pereira Lima, s/n</li>
    <li>Jardim Lavínia</li>
    <li>Mococa – SP</li>
    <li>Cep. 13736-260</li>
   </ul>
 </div><!--fechamento da class"etec-cont-backgroud"-->

 </div><!--fechamento da class"etec-contat-colun-two"-->
</div><!--fechamento da classe"etec-contat-main"-->
 
 <div class="etec-contat-horario-main ">
  <h1>Horario de Atendimento Ao Publico</h1>
  <div class="etec-contat-horario-port">
    <div class="etec-horari-content-portaria etec-cont-backgroud">
     <h1>Portaria da Etec</h1>
     <p class="">Das 07:00 as 23:00hs</p>
     <h1>Secretaria Acadêmica</h1>
     <div class="etec-horario-tablet-font  ">
      <table  border="1" cellpadding="1" >
       <tr class="etec-table-title">
        <td>Dia Da Semana</td>
        <td>Manhã</td>
        <td>Tarde</td>
        <td>Noite</td>
       </tr>
       <tr class="etec-table-conteudo">
        <td>2ª a 6ª Feira</td>
        <td>08:30 ás 10:00hs</td>
        <td>13:30 ás 15:30hs</td>
        <td>19:30 ás 21:15hs</td>
       </tr>
     </table>
    </div><!--fechamneto da class "cont-table"-->
   </div><!--fechamento da class"horari-content-portaria"-->
  </div><!--fechamento da class"etec-contat-horario-port"--->
  <div class="etec-contat-horario-dirserv">
    <div class="etec-horari-content-servico etec-cont-backgroud">
      
      
      
      <h2>Direção </h2>
       <p class="cont-marg-bot1">Responsável: Inês de Lourdes Madureira </p>
<h2>Diretoria de Serviços Administrativos</h2>
       <p class="cont-marg-bot1">Responsável: José Cortez Júnior</p>  
<h2>Coordenação Pedagógica</h2>
       <p class="cont-marg-bot1">Responsável: Rodrigo Martins Perre</p>
<h2>Orientação Educacional </h2>
       <p class="cont-marg-bot1">Responsável: Melina de Souza  Sernáglia Piantino</p>
  <h2>Setor de Estágios</h2>
       <p class="cont-marg-bot1">Responsável: Marcelo Dias do Lago  </p>
<h2>Secretaria Acadêmica</h2>
       <p class="cont-marg-bot1">Responsável: Mariana Aparecida Fonseca Gonçalves</p>
    </div><!--fechamento da class"horari-content-servico "-->
  </div> <!--fechamento da class"etec-contat-horario-dirserv"-->
 



  
  
 </div><!--fechamento da class"contat-horario-main"-->
 
 

</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>