<?php
 

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Gremios = new Gremio();
$Membros = new ComposicaoGremio();
 
if(isset($_GET['A34Fdvs246F4sggSDSf34tFiy7yeEe5HGdferrGFDrGYWt5GTdw436CsdX4f4547212S3deAet4AqdFw'])){
		//pega o valor do id
	$id = $_GET['A34Fdvs246F4sggSDSf34tFiy7yeEe5HGdferrGFDrGYWt5GTdw436CsdX4f4547212S3deAet4AqdFw'];
	  
	date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y'); 
      
    	//verifica se existe o gremio
	$gremio_atual = $Gremios->find($date);
	
	if(!($gremio_atual)){
	
		die(header('location:admin_gremio.php'));
	
	}
	
		//verifica seé permitido realizar alterações neste membro do gremio
	$membro = $Membros->find($id, $gremio_atual->g_id);
		
	if(!($membro)){
		
		die("Falha na consulta");
		 
	}
	
      
}
else{

	die(header('location:admin_gremio.php'));

}

?>
<!doctype html>
<html>
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
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes.css">
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes-responsible.css">

    <!--icone da pagina-->
<link rel="icon" href="Imagens/Imagens estaticas/Icones/icone-etec.png" />
                                             <!-- titulo da pagina -->
<title>Grêmio Estudantil</title>

</head>
<body>

<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Editar membro <?php echo $membro->cg_funcao; ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição do <?php echo $membro->cg_funcao; ?> pertencente ao atual grêmio estudantil.</div>

   <a href="admin_gremio_estudantil_composicao.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_gremio_estudantil_composicao.php" method="post" enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
  
  <div class="etec-admin-pad-forms-info">
    <p>Nome </p>
  
  <input name="nome" type="text" class="input" maxlength="100" id="" placeholder="Nome do Membro." value="<?php echo $membro->cg_nome; ?>"/>  
  </div>
  
  <div class="etec-admin-pad-forms-info">
    <p>Modalidade cursada </p>
<input name="modalidade" type="text" class="input" maxlength="100" id="" placeholder="Modalidade cursada pelo menbro." value="<?php echo $membro->cg_modalidade; ?>"/>
  </div>
  
   <div class="etec-admin-pad-forms-info">
    <p>Cargo </p>
   <input name="funcao" type="text" class="input" id="" placeholder="Funçao do Membro." value="<?php echo $membro->cg_funcao; ?>" disabled/>
  </div>
  
<?php

if($gremio_atual->g_imagens == 'S'){

?> 
    
  <div  class="etec-admin-pad-forms-enviar-img-btn">

   <label for='selecao-arquivo'>Selecionar uma imagem</label>
   <input  name="imagem" type="file" id="selecao-arquivo" accept="image/png, image/jpeg"/> 
   </div> 
   
  
<?php 

}

?>
  
 
  
   

    <input name="id_membro" type="hidden" value="<?php echo $id; ?>" />

<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="submit" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>




</body>
</html>