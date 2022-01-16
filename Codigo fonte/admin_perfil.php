<?php

include("session.php"); 

$id_usuario = $_SESSION['ID_Eletro_JBLF_Mococa_Site_Usuario'];

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Usuarios = new Usuarios();
   
    //realiza a busca das informações
$resultado = $Usuarios->find($id_usuario);

if(!($resultado)){

  die("Falha na consulta");

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


 <!--icone da pagina-->
<link rel="icon" href="Imagens/Imagens estaticas/Icones/icone-etec.png" />



                                             <!-- titulo da pagina -->
<title>Meu Perfil</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//edicao do usuario e login
if(isset($_POST['editarlogin'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['login']))and(isset($_POST['name']))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $login = $_POST['login'];
        $name = $_POST['name'];

        if(!($Usuarios->setLogin($login))){
            
            die('Falha ao tentar realizar a edição, o nome deve ter entre 8 e 50 caracteres.');
        
        }
        if(!($Usuarios->setNome($name))){
            
            die('Falha ao tentar realizar a edição, o login deve ter entre 8 e 50 caracteres.');
        
        }
       
        if($Usuarios->updateLogin($id)){
        	
				//Atualiza os dados
			$resultado = $Usuarios->find($id_usuario);
            echo '<script language="javascript">';
            echo "alert('Edição bem sucedida!');";
            echo '</script>';
        
        }
        else{
            
            echo '<script language="javascript">';
            echo "alert('Falha na edição!');";
            echo '</script>';
            
        }

    }   

}

//edicao da senha
if(isset($_POST['editarsenha'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['senha_antiga']))and(isset($_POST['senha_nova']))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $senha_antiga = $_POST['senha_antiga'];
        $senha_nova = $_POST['senha_nova'];

        if($resultado->u_senha == $senha_antiga){

            if(!($Usuarios->setSenha($senha_nova))){
                
                die('Falha ao tentar realizar a edição, a senha deve ter entre 8 e 50 caracteres.');
            
            }
           
            if($Usuarios->updateSenha($id)){
            
                echo '<script language="javascript">';
                echo "alert('Alteração bem sucedida!');";
                echo '</script>';
            
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha na ao alterar senha!');";
                echo '</script>';
                
            }

        }
        else{

            echo '<script language="javascript">';
            echo "alert('Senha inválida!');";
            echo '</script>';

        }

    }   

}

?>

 
 
 <main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
  
  <div class="etec-admin-pad-bar-info"> <h1>Meu Perfil</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel visualizar e editar as informações do usuário administrativo.</div>
  
 
  
 </div>
 
 <div class="etec-admin-pad-conteudo">
 
  <div class="etec-admin-pad-my-dates">  
  
  <div class="etec-pag-my-perf-dados">
   <div class="etec-pag-my-perf-dados-title ">Nome </div>
   <div class="etec-pag-my-perf-dados-title">Login </div>
   </div>
   
   <form method="post" action="#">
     <div class="etec-pag-my-perf-dados-conteud "><input type="text" name="name"  value="<?php echo $resultado->u_nome; ?>"  maxlength="100" placeholder="Nome do Usuário"></div>
     <div class="etec-pag-my-perf-dados-conteud"><input type="text" name="login" id="login_usuario" value="<?php echo $resultado->u_login; ?>" maxlength="50"  placeholder="Login do Usuário"></div>
     
      
     <input name="id" type="hidden" value="<?php echo $resultado->u_id; ?>"> 
     
     <div class="etec-pag-my-perf-dados-btn  " id="salvar_alteracoes"><input name="editarlogin"  type="button" value="Salvar alterações"></div>
    
  </form>
 
 
 </div><!--fechamento da class"etec-admin-pad-my-dates"-->
 
 
 
 <div class="etec-admin-pad-my-dates">
     
  <div class="etec-pag-my-perf-dados">
   <div class="etec-pag-my-perf-dados-title ">Senha senha </div>
   <div class="etec-pag-my-perf-dados-title">Nova antiga </div>
   </div>
   
   <form method="post" action="#">
     <div class="etec-pag-my-perf-dados-conteud "><input type="password" name="senha_antiga"  id="nova_senha" value=""  maxlength="50" placeholder="Senha atual."></div>
     <div class="etec-pag-my-perf-dados-conteud"><input type="password" name="senha_nova" id="senha_atual" value="" maxlength="50"  placeholder="Nova senha."></div>
     
      
     <input name="id" type="hidden" value="<?php echo $resultado->u_id; ?>"> 
     
     <div class="etec-pag-my-perf-dados-btn  " id="salvar_alteracoes_senha"><input name="editarsenha"  type="button" value="Salvar alterações"></div>
    
  </form>
   
 </div><!--fechamento da class"etec-admin-pad-my-dates"-->


</div></div>

  



</main>


 





					
                        
                        

<script src="js/admin_meu_perfil.js"></script>

</body>
</html>