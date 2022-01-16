<?php

include("session.php");

	//Se chamada a funcao editar o cache será limpado
if(isset($_POST['editar'])){

	header("Cache-Control: no-cache, must-revalidate");

}

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Gremios = new Gremio();
$Membros = new ComposicaoGremio();
$Imagens = new Imagem();

	//busca o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y');  
   
if(isset($_POST['id'])){
	
		//pega o valor do id
	$id = $_POST['id'];
	
}
else{
		//realiza a busca do ultimo gremio estudantil
	$gremio_atual = $Gremios->find($date);
	
	if(!($gremio_atual)){
		
		die(header('location:admin_gremio.php'));
	
	}
	else{
		
		$id = $gremio_atual->g_id;
		
	}
	
}
  
    //realiza a busca do gremio estudantil
$gremio = $Gremios->findId($id);
	
if(!($gremio)){	  

	die('Falha na consulta.');

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

 
  <!-- titulo da pagina-->
<title>Grêmio Estudantil</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//edicao de data do calendario no mysql 
if(isset($_POST['editar'])){
	
	    //verifica se é permitido a edição do gremio
	$gremio_atual = $Gremios->find($date);
	
	if($gremio_atual){

			//verifica se os valores foram recebidos
		if((isset($_POST['id_membro']))and(isset($_POST['nome']))and(isset($_POST['modalidade']))){
	   		
				//pega os valores dos campos
			$id_membro = $_POST['id_membro'];
			$nome = $_POST['nome'];
			$modalidade = $_POST['modalidade'];
			
				//verifica seé permitido realizar alterações neste membro do gremio
			$membro = $Membros->find($id_membro, $gremio_atual->g_id);
		
			if(!($membro)){
			
				die('Falha na edição do membro do grêmio.');
				
			}
			
			$imagem_membro = $membro->cg_imagens;
			
				//verifica se a imagem foi mudada
			if((isset($_FILES['imagem']))and($_FILES["imagem"]["name"] != "")){

				if($imagem_membro == ''){
	
						//realiza a busca da quantidade de imagens no album pararenomear a imagem
					$resultado = $Imagens->CountImagens($gremio->g_album, 'S');
					$nome_imagem = $resultado->Quantidade;
					$caminho = 'Imagens/Albuns/'.$gremio->g_album.'/'.$nome_imagem.'.jpg';
					
						//Cadastra a imagem
					$Imagens->setTitulo('');
					$Imagens->setAlt('');
					$Imagens->setCaminho($caminho);
					$Imagens->setAlbum($gremio->g_album);
					$Imagens->setPrincipal('N');
					
					if(!($Imagens->insert())){
					
						die('Falha ao realizar o cadastro.');
					
					}
					
						//busca o id da imagem
					$resultado = $Imagens->findLast();
					$imagem_membro = $resultado->id;
	
				}
				else{
					
						//pega as informações atuais da imagem 
					$resultado = $Imagens->find($imagem_membro);	
					$caminho = $resultado->i_caminho; 
					
				}
				
					//muda para a nova imagem   
				$nome_temporario=$_FILES["imagem"]["tmp_name"];
				copy($nome_temporario,$caminho);
				
			}
			
				//Salva os campos 
			if(!($Membros->setNome($nome))){
			
				die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
			}
			if(!($Membros->setModalidade($modalidade))){
			
				die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
			}
			$Membros->setImagem($imagem_membro);
		   
		   		//Realiza a edição
			if($Membros->update($membro->cg_id)){
			
				echo '<script language="javascript">';
				echo "alert('Edição bem sucedida!');";
				echo '</script>';
			
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na edição do membro grêmio!');";
				echo '</script>';
				
			}
			
		}  
		
	}
	else{
	
		echo '<script language="javascript">';
		echo "alert('Falha na edição do grêmio!');";
		echo '</script>';
		
	}

}

?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Composição do grêmio estudantil <?php echo $gremio->g_ano ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos membros do grêmio atual da escola. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página dos grêmios;</p>  
  
    </div>
   
   <a href="admin_gremio.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
   </div></a>
  
  <?php  
   include("admin_barra_lateral_legendcores.php");
 ?> 
 </div>
 <div class="etec-admin-pad-conteudo">
 
<?php 

foreach($Membros->findAll($id) as $key => $value):


		 
	//verifica se há imagem  principal no album
$resultado = $Imagens->find($value->cg_imagens);
   
if(!$resultado){

		//se não foi encontrada, e chamada uma imagem pré definida
	$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/icone_de_rosto.jpg'); 

}
else{

		//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
	$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 

}

?>
  
<?php 
 
if($gremio->g_ano == $date){ 

?>
<a href="admin_gremio_estudantil_composicao_editar.php?A34Fdvs246F4sggSDSf34tFiy7yeEe5HGdferrGFDrGYWt5GTdw436CsdX4f4547212S3deAet4AqdFw=<?php echo $value->cg_id; ?>">
<?php 

} 

?> 
<div class="etec-admin-pad-conteudo-unit admin-pad-unit-ativar-color " >
    <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
		<?php echo $value->cg_funcao; ?>
    </div>
   	<?php 
   
   	if($gremio->g_imagens == 'S'){
   
   	?>
   	
    <div class="etec-admin-pad-cont-unit-info-img">
     	<img src="<?php echo $imagem[2]; ?>?var=<?php echo rand(); ?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>" />
   	</div>
   	
	<?php 

   	}
	
   	?>
  	
    <div class="etec-admin-pad-cont-unit-info">
  		<?php echo $value->cg_nome; ?>
  	</div>
  
  	<div class="etec-admin-pad-cont-unit-info">
  		Modalidade cursada: <?php echo $value->cg_modalidade; ?>
	</div>

</div>

<?php 

if($gremio->g_ano == $date){ 

?> 

</a>

<?php

}

endforeach;
 
?>  
 </div>



</main>



</body>
</html>