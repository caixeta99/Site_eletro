<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Vestibulinho = new Vestibulinho();

date_default_timezone_set('America/Sao_Paulo');
$ano = date('Y');
$mes = date('m');
$data = $ano.'-'.$mes.'-01';

    //pega as informações do ultimo vestibular
$vestibulinho = $Vestibulinho->findLast();

if($vestibulinho){

    if($vestibulinho->v_semestre = '1º Semestre'){
        
        $mes_vestibulinho = '01';

    }
    else{

        $mes_vestibulinho = '07';

    } 

    $data_vestibulinho = $vestibulinho->v_ano.'-'.$mes_vestibulinho.'-01';

    if($data < $data_vestibulinho){ 

        die(header('location:admin_vestibular.php'));

    }

}
    
		//Pega as informacoes do vestibulinho à ser cadastrado
	//Pega o semestre
if($mes <= 6){

		//Se o vestibulinho estiver sendo cadastrado antes do mes 6 ele fará referencia ao 2 semestre
	$semestre = '2º Semestre';

}
else{

		//Se o vestibulinho estiver sendo cadastrado depois do mes 6 ele fará referencia ao 1 semestre do proximo ano
	$semestre = '1º Semestre';
	$ano++;

}

$nome = 'Vestibulinho '.$semestre.' '.$ano;

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
<title>Cadastro de Vestibulinho</title>

</head>
<body>



<?php

include("admin_menu.php");/*inclusao do menu do site*/

?> 
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de Vestibulinho</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página é possivel realizar o cadastro de um novo vestibulinho. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de vestibulinho; </p>
   </div>
   <a href="admin_vestibular.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_vestibular.php" method="post" >
  <div class="etec-admin-pad-forms">
  
  
   <div class="etec-admin-pad-forms-element">
  <input name="nome" type="text" class="input" disabled value="<?php echo $nome; ?>"/>
  </div>
  
  
   
  
  <div class="etec-admin-pad-forms-info">
  <p>Data</p>
    <input name="data" type="date" class=""  id="vestibular_data" />
   
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>hora</p>
    <input name="hora" type="time" class=""  id="vestibular_hora" />
  
  </div>
  
 
  
 
  
   <div class="etec-admin-pad-forms-element">
   <input name="periodo" type="text" class="input" maxlength="100" id="vestibular_periodo" placeholder="Periodo de Inscrição." value=""/>
  </div>
  
   <div class="etec-admin-pad-forms-info">
  <p>Ano</p>
     <input name="ano" type="number" class="input" disabled value="<?php echo $ano; ?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Semestre</p>
    <input name="semestre" class="Forme-elemente-dur" disabled type="text" value="<?php echo $semestre; ?>" >
  </div>  
<div class="etec-admin-pad-forms-element">
   <input name="valor" type="text" class="input" maxlength="100" id="vestibular_taxa" placeholder="Valor da Taxa de Inscrição." value=""/>

  </div>
  
 <div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_vestibular.js"></script>
</body>
</html>