<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$ano = date('Y'); 
$mes = date('n');

if($mes >= 7)
{
	
	$semestre = '1º Semestre';
	
}
else
{

	$semestre = '2º Semestre';
	$ano -= 1;
	
}

$conselhoclassesemestre = new ConselhoClasseSemestre();

$conselho = $conselhoclassesemestre->findLast();

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
<title>APM</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Realizao o cadastro de uma nova APM
if(isset($_POST['cadastrar'])){
    
	if( ($conselho == false) or ($conselho->ccs_ano != $ano) or ($conselho->ccs_semestre != $semestre) ){
	
            //Salva os campos 
        $conselhoclassesemestre->setAno($ano);
		if(!$conselhoclassesemestre->setSemestre($semestre)){ 
		
			die('Falha ao tentar realizar o cadastro, valor inválido.');
		
		}
		
            //Insert
        if($conselhoclassesemestre->insert()){
			
			$semestre2 = str_replace('º', '', $semestre);
			mkdir(__DIR__.'/Documentacao/Secretaria academica/Conselho de Classe/'.$ano.' - '.$semestre2);
			mkdir(__DIR__.'/Documentacao/Secretaria academica/Conselho de Classe/'.$ano.' - '.$semestre2.'/Ensino medio');
			mkdir(__DIR__.'/Documentacao/Secretaria academica/Conselho de Classe/'.$ano.' - '.$semestre2.'/Ensino integrado');
			mkdir(__DIR__.'/Documentacao/Secretaria academica/Conselho de Classe/'.$ano.' - '.$semestre2.'/Ensino integrado - Novotec');
			mkdir(__DIR__.'/Documentacao/Secretaria academica/Conselho de Classe/'.$ano.' - '.$semestre2.'/Ensino tecnico');
			$conselho = $conselhoclassesemestre->findLast();
			
            echo "<script language=\"javascript\">";
            echo "alert('Cadastro bem sucedido!');";
            echo "</script>";
			
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha ao tentar realizar o cadastro!');";
            echo '</script>';
			
		}

	}

}

?>

<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Conselho de classe</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente ao conselho de classe de diversos anos e semestres.</div>
  
  
<?php

if( ($conselho == false) or ($conselho->ccs_ano != $ano) or ($conselho->ccs_semestre != $semestre) ){

?> 
<form action="#" method="post" class="eve-admin-form" >
   <input type="submit" name="cadastrar" class="btn" id="ConselhoClasseCadastro"/>
   <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   <label for='ConselhoClasseCadastro'>Cadastrar</label>
   </div>
</form>
<?php  

}

include("admin_barra_lateral_legendcores.php");

?> 

 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

foreach($conselhoclassesemestre->findAll() as $key => $value):

?>
<a href="admin_conselho_de_classe.php?ASf2fd5Gj3ASDt4223FfsdS1A78Vr23FG65BbshG6HDFHGJ3fsdFS56TDge453GD652sdfgsd53dghCgfBVCer45t46FG1239hg65jhkGH=<?php echo $value->ccs_id; ?>">   
    <div class="etec-admin-pad-conteudo-unit <?php if( ($value->ccs_ano != $ano) or ($value->ccs_semestre != $semestre) ){
      echo 'admin-pad-unit-inative-color';
      }else{
      echo'admin-pad-unit-ativar-color';
      } ?>">
    
        <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
        	Ano
        </div>
        <div class="etec-admin-pad-cont-unit-info" apm_ano>
        	<?php echo $value->ccs_ano; ?>
        </div>
        <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
        	Semestre
        </div>
        <div class="etec-admin-pad-cont-unit-info" apm_ano>
        	<?php echo $value->ccs_semestre; ?>
        </div>
    
    </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
</a>
<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>



<script src="js/admin_apm.js"></script>
</body>
</html>