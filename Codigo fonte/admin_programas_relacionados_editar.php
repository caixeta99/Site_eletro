<?php

include("session.php"); 

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$ProgramasRelacionados = new ProgramasRelacionados();

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
<title>Editar Programa Relacionado</title>

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
    $resultado = $ProgramasRelacionados->find($id);
	
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
   <div class="etec-admin-pad-bar-info"><h1>Edição de Programa | <?php echo $resultado->p_nome; ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição do programa: <?php echo $resultado->p_nome; ?>.</div>
   
   <a href="admin_programas_relacionados.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_programas_relacionados.php" method="post" >
  <div class="etec-admin-pad-forms">

 <div class="etec-admin-pad-forms-info">
    <p>Titulo </p>
     <input name="titulo" type="text" class="input" maxlength="100" id="programa_titulo" placeholder="Título do programa." value="<?php echo $resultado->p_nome;?>"/>
  </div>
  
  
  <div class="etec-admin-pad-forms-info">
    <p>Link </p>
     <input name="link" type="text" class="input" maxlength="200" id="programa_link" placeholder="link do programa." value="<?php echo $resultado->p_link;?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-info-text-are">
    <p>Descrição </p>
      <textarea name="descricao" class="text-area" id="programa_descricao" placeholder="Descrição do programa." maxlength="500" ><?php echo $resultado->p_descricao;?></textarea>
  </div>
  
  <input name="id" type="hidden" value="<?php echo $id; ?>" />
<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  
 <script src="js/admin_programas_relacionados.js"></script>  
  </div>
 </div>
</main>

</body>
</html>