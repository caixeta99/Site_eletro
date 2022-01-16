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

if(isset($_POST['id'])){
   
	 	//pega o id
   	$id = (int)$_POST['id'];
 
	    //realiza a busca das informações
    $Prestacao_info = $PrestacaoContas->find($id);
	
    if(!($Prestacao_info)){

    	die("Falha na consulta");

    }  

}
else{
	
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

                    <!-- titulo da pagina -->
<title>Itens - <?php echo $Prestacao_info->pc_pagina.' '.$Prestacao_info->pc_ano; ?></title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//edicao de um item da prestação de contas
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['id_item']))and(isset($_FILES["documento"]))){
   
            //pega os valores dos campos
        $id_item = $_POST['id_item'];
        $nome_temporario=$_FILES["documento"]["tmp_name"];
   		$pathinfo = pathinfo($_FILES["documento"]["name"]);
		
		if($nome_temporario != ''){
      		
				//pega os dados do item
   			$resultado = $PrestacaoContasItens->find($id_item);
	
			if(!($resultado)){
		
				die("Falha na consulta");
		
			}
   
      			//apaga o arquivo antigo
   			if($resultado->pci_caminho != ''){
   				
				unlink($resultado->pci_caminho);      
   			
			}
     			
				//faz upload do documento  
   			$caminho = 'Documentacao/Prestacao_Contas/'.$resultado->pci_prestacao_contas.'/'.$resultado->pci_mes.'.'.$pathinfo['extension'];
   			copy($nome_temporario,$caminho);
   
			if(!($PrestacaoContasItens->setCaminho($caminho))){
				
				die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
			
			}
		   
			if($PrestacaoContasItens->update($id_item)){
			
				echo '<script language="javascript">';
				echo "alert('Edição bem sucedida!');";
				echo '</script>';
			
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na edição da data selecionado!');";
				echo '</script>';
				
			}
				
		}

    }   

}

?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Itens - <?php echo $Prestacao_info->pc_pagina.' '.$Prestacao_info->pc_ano; ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém todos os itens de <?php echo $Prestacao_info->pc_pagina.' '.$Prestacao_info->pc_ano; ?>. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de prestação de contas;</p>  
  
    </div>
   <a href="admin_prestacoes_contas.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
   </div></a>
  
 </div>
 <div class="etec-admin-pad-conteudo">
 
  
  
  

<?php 	     		

foreach($PrestacaoContasItens->findAll($Prestacao_info->pc_id) as $key => $value):

?>        
 <a href="admin_prestacoes_contas_itens_editar.php?ASf2fd5Gj322FDabVsdHr65FvXa345SDF1F78Vr23FG65BbshG6HDFHGJ3fsdFS56TDge453GD652sdfgsd53dghCgfBVCer45t46FG1239hg65jhkGH=<?php echo $value->pci_id; ?>">
 <div class="etec-admin-pad-conteudo-unit admin-pad-unit-ativar-color">
  
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Mes
   </div>
   <div class="etec-admin-pad-cont-unit-info" >
    <?php echo $value->pci_mes; ?>
   </div>
  
  
    <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Caminho do Documento
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->pci_caminho == ""){echo 'align="center"';}?>>
     <?php if($value->pci_caminho == ""){echo '--';}else{echo $value->pci_caminho;} ?>
   </div>
 </div>
<?php 

endforeach;

?>
</main>



</body>
</html>