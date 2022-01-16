<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$CorpoDocente = new CorpoDocente();

$Membros_Corpo_Docente = $CorpoDocente->findAll('S');

if(!$Membros_Corpo_Docente){

	die(header('location:erro 404.php'));

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
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola.css">

                              <!-- titulo da pagina -->
<title>Corpo Docente <?php echo date('Y');?> | Eletrô</title>

</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <div class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Corpo docente <?php echo date('Y');?> | <a href="index.php">Eletrô</a> </div>
  
 </div><!-- fechamento da class"container-indicator-->
 


 <div class="etec-table-elemento etec-corpo-docente etec-title-princip">
       
   <h1>Composição do Corpo Docente da Etec Joao Baptista de Lima Figueiredo(JBLF)</h1>
   
   <table >
  <caption>
    Corpo Docente <?php echo date('Y');?>
  </caption>
<?php	    		

foreach($Membros_Corpo_Docente as $key => $value): 	

?> 
  <tr class="">
    <td><?php echo $value->cd_nome; ?></td>
    <td ><?php echo $value->cd_email; ?></td>
    
  </tr>
<?php 

endforeach;

?>
  
</table>
 </div><!-- fechamento da class"cont-table"-->
 </div><!-- fechamento da class"container-text-pad"-->

 
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>