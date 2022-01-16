<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$EventoData = new EventoData();
$Eventos = new Eventos();
   
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
<title>Editar Data de um Evento</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/

    //verifica se o id foi recebido
if((isset($_POST['id']))){
      //pega o valor do id
    $id = (int)$_POST['id'];

        //realiza a busca das informações
    $resultado = $EventoData->find($id);
  
    if(!($resultado)){

      die("Falha na consulta");

    }

}
else{

  die("Falha na consulta");

}

?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição da Data | <?php  echo date('d/m/Y',  strtotime($resultado->de_data)); ?> </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de datas do evento selecionado.</div>
   
   <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   <form action="admin_data_evento.php" method="post">
   <label for="Voltar"><div class="">Voltar</div></label>
   <input type="hidden" value="<?php echo $resultado->de_evento; ?>" name="id" />
   <input type="submit" id="Voltar"/>
   </form>
   </div>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_data_evento.php" method="post" >
  <div class="etec-admin-pad-forms">
   
  
  <div class="etec-admin-pad-forms-info">
  <p>Data</p>
  <input name="data" type="date" maxlength="50"  placeholder="Dia e mês do evento" id="data_evento_data" value="<?php echo $resultado->de_data; ?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Evento</p>
    <input name="evento" type="text" disabled="disabled" value="
<?php
	
     //realiza a busca das informações
$evento = $Eventos->find($resultado->de_evento);

if(!($evento)){

    die("Falha na consulta");

}
	
echo $evento->e_titulo;

?>
    
">
  </div>
  
<input name="id" type="hidden" value="<?php echo $resultado->de_evento; ?>" /> 
<input name="id_data" type="hidden" value="<?php echo $id; ?>" />
<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>




<script src="js/admin_data_eventos.js"></script>
</body>
</html>