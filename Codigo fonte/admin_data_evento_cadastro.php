<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Eventos = new Eventos();

if(isset($_GET['Ade34F5fgdfS4s4t4Fg577SshjHgQdFDbcvFY3q3886DGFgSllHJJu4308Hrt5bFDdgHyYgNBdf'])){

    $id_evento = $_GET['Ade34F5fgdfS4s4t4Fg577SshjHgQdFDbcvFY3q3886DGFgSllHJJu4308Hrt5bFDdgHyYgNBdf'];

}
else{
	
    header('location:admin_evento.php');

}
  
   //realiza a busca das informações
$resultado = $Eventos->find($id_evento);

if(!($resultado)){

    die("Falha na consulta");

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
                               <!-- titulo da pagina -->
<title>Cadastro de Datas do Evento</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de uma nova data </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de datas para o evento selecionado. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de datas; </p>
   </div>
   
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> logo abaixo poderá ser visto um resumo de cada campo do formulário:
     <p><strong>Data</strong> Valor que fará referência ao período que será realizado o evento; </p>
     <p><strong>Evento</strong>Lembrete do evento que a data faz referência;</p>
   </div>
    
   
   <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   <form action="admin_data_evento.php" method="post">
   <label for="Voltar"><div class="">Voltar</div></label>
   <input type="hidden" value="<?php echo $id_evento; ?>" name="id" />
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
  <input name="data" type="date" id="data_evento_data"/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Evento</p>
    <input name="evento" type="text" disabled="disabled" value="
<?php

echo $resultado->e_titulo;
	
?>
    ">
  </div>
  
 
<input type="hidden" name="id" value="<?php echo $id_evento; ?>" />
<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>



<script src="js/admin_data_eventos.js"></script>
</body>
</html>