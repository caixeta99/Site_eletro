<?php
   include("session.php"); 
   $id = $_SESSION['ID_Eletro_JBLF_Mococa_Site_Usuario'];
   
   $resultado = mysqli_query($conexao,"SELECT u_login,u_nome FROM usuarios WHERE u_id = ".$id);
   if (!$resultado){ die("Falha na consulta: ".mysql_error($conexao) ); }
		
   $usuario = mysqli_fetch_array( $resultado, MYSQLI_NUM); 
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

<style>
.etec-op-1{
background-color:rgba(0,0,0,0.2);

}
</style>
                                             <!-- titulo da pagina -->
<title>Meu Perfil</title>

</head>
<body>

<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?> 

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nessa pagina conten tudo  Relacionado com a Escola em si </div>
   <div class="etec-admin-pad-bar-iten etec-op-1" >
   <a href="">Mural de avisos</a>
   </div>
   <div class="etec-admin-pad-bar-iten etec-op-2">
   <a href="">Programas relacionados</a>
   </div>
   <div class="etec-admin-pad-bar-iten etec-op-3">
   	<a href="">Conselho</a>
   </div>
   <div class="etec-admin-pad-bar-iten etec-op-4">
   	<a href="">Corpo Docente</a>
   </div>
 </div>
 <div class="etec-admin-pad-conteudo">
  conteudo
 </div>

</main>



 
 


</div>
					
                        
                        
</div><!-- Fechamento da class "main-conteiner"-->

<script src="js/admin_meu_perfil.js"></script>

</body>
</html>