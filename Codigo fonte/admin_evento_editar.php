<?php

include("session.php");

function MyAutoload($className) {    
  $extension =  spl_autoload_extensions();
  require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Eventos = new Eventos();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
                                    <!-- meta tages da pagina -->
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
 
 
<title>Editar Evento</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>
<?php

    //verifica se o id foi recebido
if((isset($_POST['id']))){
      //pega o valor do id
    $id = (int)$_POST['id'];

        //realiza a busca das informações
    $resultado = $Eventos->find($id);
  
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
   <div class="etec-admin-pad-bar-info"><h1>Edição de Evento | <?php echo $resultado->e_titulo; ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição do evento: <?php echo $resultado->e_titulo; ?>.</div>
   
   <a href="admin_evento.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_evento.php" method="post" >
  <div class="etec-admin-pad-forms">
  

  
   <div class="etec-admin-pad-forms-info">
    <p>Título</p>
     <input name="titulo" type="text"  maxlength="50"  placeholder="Título do evento." id="evento_titulo" value="<?php echo $resultado->e_titulo; ?>"/>
  </div>
   
  <div class="etec-admin-pad-forms-info-text-are">
    <p>Sinopse</p>
     <textarea name="sinopse"  placeholder="Sinopse do curso." maxlength="500" id="evento_sinopse"><?php echo $resultado->e_sinopse; ?></textarea>
  </div>
  <div class="etec-admin-pad-forms-info-text-are">
    <p>Descrição</p>
   <textarea name="descricao"  placeholder="Descrição do curso." maxlength="1000" id="evento_descricao"><?php echo $resultado->e_descricao; ?></textarea>
  </div>
 
  
  
  <input name="id" type="hidden" value="<?php echo $id; ?>" />

<div class="button2 etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>


<script src="js/admin_eventos.js"></script>
</body>
</html>