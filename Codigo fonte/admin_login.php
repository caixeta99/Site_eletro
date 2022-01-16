<?php 

session_start();

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Usuarios = new Usuarios();

if(isset($_POST['btnlogin'])) {

    if((isset($_POST['txtlogin']))and(isset($_POST['txtSenha']))){
   
		$login = $_POST['txtlogin'];
		$password = $_POST['txtSenha'];
		   
		$verificacao = true;
		   
			//Salva os valores dos campos
		if(!($Usuarios->setLogin($login))){
				
			echo '<script language="javascript">'
			    .'alert(\'Usuário inválido\');'
			    .'</script>';
			$verificacao = false;
			
			
		}
		if(!($Usuarios->setSenha($password))){
				
			echo '<script language="javascript">'
			    .'alert(\'Senha inválida\');'
			    .'</script>';
			$verificacao = false;
			
		}
		
		if($verificacao){
	
				//Verifica o login e senha
			$resultado = $Usuarios->find('');
			
			if($resultado){
		
					//Salva os valores no session
				$_SESSION['ID_Eletro_JBLF_Mococa_Site_Usuario'] = $resultado->u_id;
				$_SESSION['Nome_Eletro_JBLF_Mococa_Site_Usuario'] = $resultado->u_nome;  
		
					//Transferi para pagina de evento
				echo '<script language="javascript">';
				echo  'window.location.href = "admin_evento.php";';
				echo '</script>'; 
		
			}
			else{
		
					//Mensagem de falha ao tentar realiza login
				echo '<script language="javascript">';
				echo 'alert(\'Usuário ou senha inválidos!\');';
				echo '</script>';
		
			}
			
		}
   
	}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>


 <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
<link rel="stylesheet" href="Css/etec-style-fonts.css">   
<link rel="stylesheet" href="Css/etec-style-adm.css" />
<link rel="stylesheet" href="Css/etec-style-adm-responsible.css" />

 <link rel="icon" type="imagem/png" href="Imagens/Imagens estaticas/Icones/icone-etec.png">                                      <!-- titulo da pagina -->
 <title>Login Administrativo</title>
  
</head>
<body >

<div class="etec-admin-login-img-fund">


<img src="Imagens/Imagens estaticas/Login pagina administrativa/login.jpg" /></div>
<div  class="etec-admin-login-form-center">

 <fieldset >
  <form action="" method="post" enctype="multipart/form-data">
  <div class="etec-admin-login-form-img"><img src="Imagens/Imagens estaticas/Icones/logo_tranparente.png"  /></div>
  <h1>Login</h1>
   <input type="text" name="txtlogin" width="200" maxlength="50" class="" id="" autofocus placeholder="Nome">
   <input type="password" name="txtSenha" width="200" maxlength="50" class="" id="" placeholder="Senha">
   <h3> Caso não consiga acessar o sistema entre em contato com os  desenvolvedores!</h3>
   <input id="admin_login_btn" type="submit" value="Logar" name="btnlogin" /> 

    
   </form>
  </fieldset>
</div><!--fechamento da classe"etec-admin-login-form-center"-->


</body>
</html>
