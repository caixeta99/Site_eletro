<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$apm_ano = new ApmAno();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

$apm =$apm_ano->findLast();

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
    
	if( ($apm == false) or ($apm->aa_ano < $date) ){
	
            //Salva os campos 
        $apm_ano->setAno($date); 

            //Insert
        if($apm_ano->insert()){
			
			$apm =$apm_ano->findLast();
			
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

<div class="etec-pop-up-tela-informacoes-fundo">

<div class="etec-pop-p-tela-informacoes-two-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">

  </div> 
 
   <div class="etec-pop-up-opcoes-two">
    <form action="admin_apm_membros.php" method="post" class="eve-admin-form" >
      <label for='Membros'>Membros</label>
     <input type="submit" name="membros" class="btn" id="Membros"/> <input  id="apm_membros" name="idApm" type="hidden" value=""  />
    </form>
    <form action="admin_apm_plano_trabalho.php" method="post" class="eve-admin-form">
     <label for='PlanoTrabalho'>Plano de trabalho</label>
     <input type="submit" name="planotrabalho" class="btn" id="PlanoTrabalho" /><input id="apm_plano_trabalho" name="idApm" type="hidden" value=""  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->
</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->


<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>APM</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente a Associação de Pais e Mestres(APM).</div>
  
  
<?php

if( ($apm == false) or ($apm->aa_ano < $date) ){

?> 
<form action="#" method="post" class="eve-admin-form" >
   <input type="submit" name="cadastrar" class="btn" id="ApmCadastro"/>
   <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   <label for='ApmCadastro'>Cadastrar</label>
   </div>
</form>
<?php  

}

include("admin_barra_lateral_legendcores.php");

?> 
    
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

foreach($apm_ano->findAll() as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit <?php if($value->aa_ano < $date){
	  echo 'admin-pad-unit-inative-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->aa_id; ?>">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     APM
   </div>
   <div class="etec-admin-pad-cont-unit-info" apm_ano>
     <?php echo $value->aa_ano; ?>
   </div>

     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>



<script src="js/admin_apm.js"></script>
</body>
</html>