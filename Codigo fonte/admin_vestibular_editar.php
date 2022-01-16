<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Vestibulinho = new Vestibulinho();

    //pega as informações do ultimo vestibular
$vestibulinho = $Vestibulinho->findLast();

if(!$vestibulinho){

    die(header('location:admin_vestibular.php'));

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

<!---tiulo da pagina -->
<title>Editar Vestibulinho</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?>
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição do <?php echo $vestibulinho->v_nome; ?> </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nessa página é possivel realizar edição do <?php echo $vestibulinho->v_nome; ?>.</div>
  
   <a href="admin_vestibular.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_vestibular.php" method="post" >
  <div class="etec-admin-pad-forms">
  
  <div class="etec-admin-pad-forms-info">
    <p>Nome </p>
  <input name="nome" type="text" class="input" disabled value="<?php echo $vestibulinho->v_nome; ?>"/>
  </div>
  
 
  
  
   
  
  <div class="etec-admin-pad-forms-info">
  <p>Data </p>
    <input name="data" type="date" class=""  id="vestibular_data" value="<?php echo $vestibulinho->v_data_exame; ?>" />
   
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Hora </p>
      <input name="hora" type="time" class=""  id="vestibular_hora" value="<?php echo $vestibulinho->v_hora_exame; ?>" />
  
  </div>
  
 <div class="etec-admin-pad-forms-info">
    <p>Período de incrição </p>
  <input name="periodo" type="text" class="input" maxlength="100" id="vestibular_periodo" placeholder="Periodo de Inscrição." value="<?php echo $vestibulinho->v_periodo_inscricao; ?>"/>
  </div>
  
 
  
   
  
   <div class="etec-admin-pad-forms-info">
  <p>Ano </p>
     <input name="ano" type="number" class="input" disabled value="<?php echo $vestibulinho->v_ano; ?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Semestre </p>
    <input name="semestre" type="text" class="input" disabled value="<?php echo $vestibulinho->v_semestre; ?>"/>
  
  </div> 
  
   

   <div class="etec-admin-pad-forms-info">
    <p>Valor </p>
 <input name="valor" type="text" class="input" maxlength="100" id="vestibular_taxa" placeholder="Valor da Taxa de Inscrição." value="<?php echo $vestibulinho->v_preco_inscricao; ?>"/>

  </div>
 <div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_vestibular.js"></script>
</body>
</html>