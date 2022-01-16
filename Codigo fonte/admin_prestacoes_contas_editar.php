<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$PrestacaoContas = new PrestacaoContas();

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
<title>Editar uma prestação de contas</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

    //verifica se o id foi recebido
if((isset($_POST['id']))){
    	//pega o valor do id
    $id = (int)$_POST['id'];

        //realiza a busca das informações
    $resultado = $PrestacaoContas->find($id);
	
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
   <div class="etec-admin-pad-bar-info"><h1>Editar prestação</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de uma prestação de contas. </div>
   
   <a href="admin_prestacoes_contas.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
   
</div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_prestacoes_contas.php" method="post" >
  <div class="etec-admin-pad-forms">
   <div class="etec-admin-pad-forms-info">
    <p>Ano </p>
     <input name="ano" type="number" class="input" id="prestacao_ano" value="<?php echo $resultado->pc_ano; ?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
    <p>Página </p>
     <select name="identificacao_pag" class="Forme-elemente-dur  ">
    <option value="Refeitório" <?php if($resultado->pc_pagina == 'Refeitório'){ echo 'selected="selected"';} ?> >Refeitório</option>
    <option value="Direção de Serviço"  <?php if($resultado->pc_pagina == 'Direção de Serviço'){ echo 'selected="selected"';} ?>>Direção de Serviço</option>
   </select>
  </div>
  <input name="id" type="hidden" value="<?php echo $resultado->pc_id; ?>" />

<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  
  </div>
 </div>
</main>

<script src="js/admin_prestacao_contas.js"></script>
</body>
</html>