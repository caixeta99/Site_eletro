<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$PrestacaoContas = new PrestacaoContas();
$PrestacaoContasItens = new PrestacaoContasItens();
   
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

<title>Editar item</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//verifica se o id foi recebido
if(isset($_GET['ASf2fd5Gj322FDabVsdHr65FvXa345SDF1F78Vr23FG65BbshG6HDFHGJ3fsdFS56TDge453GD652sdfgsd53dghCgfBVCer45t46FG1239hg65jhkGH'])){
		//pega o id
   	$id = (int)$_GET['ASf2fd5Gj322FDabVsdHr65FvXa345SDF1F78Vr23FG65BbshG6HDFHGJ3fsdFS56TDge453GD652sdfgsd53dghCgfBVCer45t46FG1239hg65jhkGH'];

    //realiza a busca das informações
    $resultado = $PrestacaoContasItens->find($id);
	
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
   <div class="etec-admin-pad-bar-info"><h1>Edição de um item</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de um item da prestação de contas.</div>
  	<form method="post" action="admin_prestacoes_contas_itens.php">
   		<label for="btn_voltar">
        	<div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   				Voltar
   			</div>
        </label>
        <input name="id" type="hidden" />
        <input type="submit" id="btn_voltar" />
   	</form>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_prestacoes_contas_itens.php" method="post" enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
  
  

  
  <div class="etec-admin-pad-forms-info">
  <p>Mês </p>
  
   
   <input name="mes" type="text" value="<?php echo $resultado->pci_mes; ?>"  disabled="disabled"/>
  </div>
 
     <div  class="etec-admin-pad-forms-enviar-img-btn">

   <label for='selecao-arquivo'>Selecionar uma arquivo</label>
   <input  name="documento" type="file" value="" id="selecao-arquivo" accept="application/pdf application/msword application/msexcel"  />
   </div>  
<input name="id_item" type="hidden" value="<?php echo $resultado->pci_id; ?>" />
<input name="id" type="hidden" value="<?php echo $resultado->pci_prestacao_contas; ?>" />  

<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="submit" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>


</body>
</html>