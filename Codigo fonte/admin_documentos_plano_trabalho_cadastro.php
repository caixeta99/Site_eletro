<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
 
$DocumentosAno = new DocumentosAno(); 
$DocumentosPlanoTrabalho = new DocumentosPlanoTrabalho();
$Cursos = new Cursos();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

  	//Verica qual foi o ultimo ano
$resultado = $DocumentosAno->find('');

if((!$resultado)or($resultado->doc_ano != $date)){

	die(header('location:admin_coordenacao.php'));
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

                                     <meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
                                    
                                    <!--- Css padrao-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-adm.css">
<link rel="stylesheet" href="Css/etec-style-adm-responsible.css">
<link rel="stylesheet" href="Css/etec-style-fonts.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
   
    <!--icone da pagina-->
<link rel="icon" href="Imagens/Imagens estaticas/Icones/icone-etec.png" />
                             
                              <!-- titulo da pagina -->
<title>Plano de Trabalho - cadastro</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?>



<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Plano de Trabalho</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos planos de trabalho.</div>
    <a href="admin_documentos_plano_trabalho.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   	Voltar
   	</div></a>
    
    <div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     <label for="ligacao">Salvar Alterações</label>
   </div>
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
<form action="admin_documentos_plano_trabalho.php" method="post">
     <input name="cursos" type="submit" id="ligacao" class="input_typ_subm_none" />   
<?php 

$i = 0;

foreach($Cursos->findAll('S', '') as $key => $value):
	
?>

 <div class="etec-admin-pad-conteudo-unit admin-pad-unit-ativar-color">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Curso
   </div>
   <div class="etec-admin-pad-cont-unit-info">
	<?php  
	
	echo $value->c_titulo; 
	
	?>
   </div>
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Período
   </div>
   <div class="etec-admin-pad-cont-unit-info">
     <?php  echo $value->c_periodo; ?>
   </div>
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
   		Selecionar   
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " >
      <input name="curso_plano_trabalho[<?php echo $i; ?>]" type="checkbox" value="<?php echo $value->c_id; ?>"
           	<?php
		    
			    //Verificase há ligacao com o curso
			$documentos = $DocumentosPlanoTrabalho->findAll($resultado->doc_id, $value->c_id, 'S');
			
			if($documentos){
			
				echo 'checked="checked"';
			
			}
			
		   	?>  
      />
   </div>
   
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
 
<?php 

	$i++;

endforeach;

?>
</form>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>

</body>
</html>