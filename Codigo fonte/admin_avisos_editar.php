<?php

include("session.php");

function MyAutoload($className) {    
	$extension =  spl_autoload_extensions();
	require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Avisos = new Avisos();

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
                    
                    <!--titulo da pagina -->
<title>Editar aviso</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

    //verifica se o id foi recebido
if((isset($_POST['id']))){
    	//pega o valor do id
    $id = (int)$_POST['id'];

        //realiza a busca das informações
    $resultado = $Avisos->find($id);
	
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
   <div class="etec-admin-pad-bar-info"><h1>Edição de um  Aviso</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição do aviso para os: <?php 
   if($resultado->av_destinatario == 'alunos'){
	   echo 'Alunos';
       }
       if($resultado->av_destinatario == 'ex-alunos'){
	   echo 'EX-Alunos';
       }
       if($resultado->av_destinatario == 'secretaria'){
	   echo 'Secretaria Académica';
       }
       if($resultado->av_destinatario == 'coordenacao'){
	   echo 'Coordenação Pedagogica';
       }
   ?></div>
   
   <a href="admin_avisos.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_avisos.php" method="post" >
  <div class="etec-admin-pad-forms">
   <div class="etec-admin-pad-forms-info">
    <p>Destinatário </p>
     <select name="destinatario" class="input">
      <option <?php if ($resultado->av_destinatario == 'alunos'){ echo 'selected="selected"';} ?> value="alunos">Alunos</option>
  <option <?php if ($resultado->av_destinatario == 'ex-alunos'){ echo 'selected="selected"';} ?> value="ex-alunos">EX-Alunos</option>
  <option <?php if ($resultado->av_destinatario == 'secretaria'){ echo 'selected="selected"';} ?> value="secretaria">Secretaria Acadêmica</option>
  <option <?php if ($resultado->av_destinatario == 'coordenacao'){ echo 'selected="selected"';} ?> value="coordenacao">Coordenação Pedagógica</option>
</select>
  </div>
  
   
  <div class="etec-admin-pad-forms-info-text-are">
    
    <textarea name="descricao" class="text-area" id="aviso_descricao" placeholder="Descrição do aviso." maxlength="250"><?php echo $resultado->av_descricao; ?></textarea>
  </div>
  

   <input name="id" type="hidden" value="<?php echo $resultado->av_id; ?>" />
<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  
 <script src="js/admin-avisos.js"></script>  
  </div>
 </div>
</main


></body>
</html>