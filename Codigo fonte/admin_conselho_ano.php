<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Conselho_Ano = new ConselhoAno();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

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


<title>Conselhos</title>
</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

if(isset($_POST['cadastrar'])){
	
		//Verifica se é necessario o cadastro do conselho
	$resultado = $Conselho_Ano->find('');

	if((!$resultado)or($resultado->coa_ano < $date)){
	
			//Salva os campos 
		$Conselho_Ano->setAno($date); 
	
			//Insert
		if($Conselho_Ano->insert()){
			
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
   <div class="etec-admin-pad-bar-info"><h1>Ediçoes do Conselho</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente ao conselho de cada ano.
<?php 
  
  	//Verica qual foi o ultimo conselho e se é necessario o cadaastro de um novo
$resultado = $Conselho_Ano->find('');

if((!$resultado)or($resultado->coa_ano < $date)){

?>  
    <p><strong>Cadastrar</strong> Aonde é posivel cadastrar uma nova edição do conselho escolar</p>
    
<?php 

} 

?> 
   </div>
  
<?php 
  
if((!$resultado)or($resultado->coa_ano < $date)){

?>  
<form method="post" action="#">
   <label for="btn_cadastrar"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></label>
   <input type="submit" name="cadastrar" id="btn_cadastrar" />
</form>
<?php 

} 

include("admin_barra_lateral_legendcores.php");

?> 
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 	     

foreach($Conselho_Ano->findAll() as $key => $value):

?>
 <a href="admin_conselho.php?ASdfd546GHD3hj5657RGHRweerRujyY54gerU7565FGerT556DFGDwIuy6YUjmgGhjUT54=<?php echo $value->coa_id; ?>">       
 <div class="etec-admin-pad-conteudo-unit-reduces  
<?php 

if($value->coa_ano != $date){
	
	echo 'admin-pad-unit-inative-color';

}
else{
    
	echo'admin-pad-unit-ativar-color';

}

?>" item_id="<?php echo $value->coa_id; ?>" >
  
   <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Ano
   </div>
   <div class="etec-admin-pad-cont-unit-info">
     <?php  
	 
	 echo $value->coa_ano;
	 
	 ?>
   </div>
   
    
  
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
  </a><!--fechamento do link que envolve todo o container -->
<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>









</body>
</html>
