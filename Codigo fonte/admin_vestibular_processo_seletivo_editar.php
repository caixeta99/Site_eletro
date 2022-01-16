<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Vestibulinho = new Vestibulinho();
$ProcessoSeletivo = new ProcessoSeletivoVestibulinho();

    //pega as informações do ultimo vestibular
$vestibulinho = $Vestibulinho->findLast();

if(!$vestibulinho){

    die(header('location:admin_vestibular.php'));

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
<title>Editar um tópico</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

   //verifica se o id foi recebido
if((isset($_POST['id']))){
      //pega o valor do id
    $id = (int)$_POST['id'];

        //realiza a busca das informações
    $resultado = $ProcessoSeletivo->find($id);
  
    if(!($resultado)){

        die(header('location:admin_vestibular_processo_seletivo.php'));

    }

    if($resultado->vt_vestibular != $vestibulinho->v_id){

        die(header('location:admin_vestibular_processo_seletivo.php'));

    }

}
else{

    die(header('location:admin_vestibular_processo_seletivo.php'));

}
   
    //separa a hora e a data
$data_hora_i = explode(" ",$resultado->vt_data_inicial);
if($resultado->vt_data_final != ''){

    $data_hora_f = explode(" ",$resultado->vt_data_final);

}

?> 

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição do Tópico</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de um determinado tópico.</div>
  
   <a href="admin_vestibular_processo_seletivo.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_vestibular_processo_seletivo.php" method="post">
  <div class="etec-admin-pad-forms">
  
     <div class="etec-admin-pad-forms-info">
    <p>Descrição </p>
 <input name="descricao" type="text" class="input" maxlength="200" id="vps_nome" placeholder="Descrição." value="<?php echo $resultado->vt_descricao; ?>"/>

  </div>
  
  
  <div class="etec-admin-pad-forms-info-pared">
  <p>Inicio </p>
  
   <input name="data_i" type="date" class="" id="vps_data_i" placeholder="Data do tópico." value="<?php echo $data_hora_i[0]; ?>"/>
      <input name="hora_i" type="time" class="" placeholder="Data e hora de término" value="<?php
	  $hora_i = explode(":",$data_hora_i[1]);
	  echo $hora_i[0].':'.$hora_i[1]; ?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-info-pared">
  <p>Fim </p>
    <input name="data_f" type="date" class="" id="" placeholder="Data e hora de término" value="<?php if($resultado->vt_data_final != ''){ echo $data_hora_f[0];} ?>"/>
     <input name="hora_f" type="time" class="" id="" placeholder="Data e hora de término" value="<?php if($resultado->vt_data_final != ''){ 
	 $hora_f = explode(":",$data_hora_f[1]); 
	 echo $hora_f[0].':'.$hora_f[1];
	 }
	 
	 ?>"/>
  
  </div>
  
<input name="id" type="hidden" value="<?php echo $resultado->vt_id; ?>" />
<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>


<script src="js/admin_processo_seletivo.js"></script>

</body>
</html>