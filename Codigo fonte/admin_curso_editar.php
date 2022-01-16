<?php

include("session.php");

function MyAutoload($className) {    
	$extension =  spl_autoload_extensions();
	require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Cursos = new Cursos();

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
<title>Editar Curso</title>

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
    $resultado = $Cursos->find($id);
	
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
   <div class="etec-admin-pad-bar-info"><h1>Edição do Curso|<?php echo $resultado->c_titulo; ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição do curso selecionado: <?php echo $resultado->c_titulo; ?>.</div>
   
   <a href="admin_curso.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_curso.php" method="post" enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
   
    <div class="etec-admin-pad-forms-info">
    <p>Título</p>
     <input name="titulo" type="text" class="input" maxlength="50" id="curso_titulo" placeholder="Título do curso." value="<?php echo $resultado->c_titulo;?>"
     	<?php 
	 
     	if($resultado->c_periodo == 'Matutino'){
	
			echo 'disabled="disabled"';
		
		}
		
		?>
    />
  </div>
     
  <div class="etec-admin-pad-forms-info">
  <p>Período </p>
<?php

	if($resultado->c_periodo == 'Matutino'){
		
?>
	<input type="text" name="periodo" value="<?php echo $resultado->c_periodo; ?>" disabled="disabled"  />
<?php
		
	}
	else{
  
?>
     <select name="periodo"  >
   <option <?php if($resultado->c_periodo == 'Diurno'){echo 'selected="selected"';}?>>Diurno</option>
   <option <?php if($resultado->c_periodo == 'Noturno'){echo 'selected="selected"';}?>>Noturno</option>
  </select>
<?php

	}
	
?>
  </div>

  <div class="etec-admin-pad-forms-info">
  <p>Duração </p>
  <?php $duracao = explode(" ",$resultado->c_duracao);?>
  <input name="duracao" type="number" placeholder="Duração do curso." value="<?php echo $duracao[0];?>" id="curso_duracao" 
  	<?php

	if($resultado->c_periodo == 'Matutino'){
	
		echo 'disabled="disabled"';
		
	}
		
	?>/>
  <select name="Unidade_de_medida"  
  	<?php

	if($resultado->c_periodo == 'Matutino'){
	
		echo 'disabled="disabled"';
		
	}
		
	?>>
   <option <?php if($duracao[1]=='Anos'){echo 'selected="selected"';}?> >Anos</option>
   <option <?php if($duracao[1]=='Semestres'){echo 'selected="selected"';}?>>Semestres</option>
  </select>
  
  </div>
  
   
  
  <div class="etec-admin-pad-forms-info-text-are">
    <p>Sinopse</p>
    <textarea name="sinopse" class="text-area" id="curso_sinopse" placeholder="Sinopse do curso." maxlength="500" ><?php echo $resultado->c_sinopse;?></textarea>
  </div>
  
  <div class="etec-admin-pad-forms-info-text-are">
    <p>Descrição</p>
    <textarea name="descricao" class="text-area" id="curso_descricao" placeholder="Descrição do curso." maxlength="1000" ><?php echo $resultado->c_descricao;?></textarea>
  </div>
  
  
    <input name="id" type="hidden" value="<?php echo $id; ?>" />


<div  class="etec-admin-pad-forms-enviar-img-btn">

   <label for='selecao-arquivo'>Selecionar uma imagem</label>
   <input  name="imagem" type="file" id="selecao-arquivo" accept="image/png, image/jpeg"/> 
   </div> 
   
<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_cursos.js"></script>
</body>
</html>