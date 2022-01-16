<?php

   include("session.php");

 
   
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
<title>Cadastrar Prestação de Contas</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>
<?php
//verifica se os campos foram recebidos
 if((isset($_POST['ano']))and(isset($_POST['identificacao_pag']))){
	 //pega os valores dos campos
   $ano = $_POST['ano'];
   $identificacao_pag = $_POST['identificacao_pag'];
   
   //verificacao contra mysql inject
   $ano = stripcslashes($ano);
   $ano = mysqli_real_escape_string($conexao,$ano);
   $identificacao_pag = stripcslashes($identificacao_pag);
   $identificacao_pag = mysqli_real_escape_string($conexao,$identificacao_pag);
   
   //realiza o cadastro da prestacao
   $sql = "insert into prestacacao_contas(pc_ano,pc_pagina) values('".$ano."','".$identificacao_pag."')";
   
   $resultado = mysqli_query($conexao,$sql);
   if (!$resultado){ die("Falha no cadastro: ".mysqli_error($conexao) ); 
   }else{ 
           //pega o id
	  $resultado = mysqli_query($conexao,"SELECT max(pc_id) FROM prestacacao_contas");
      if (!$resultado){ die("Falha na consulta: ".mysql_error($conexao) ); }   
	  $id = mysqli_fetch_array( $resultado, MYSQLI_NUM);
	   
	  //realiza o cadastro dos itens
     $sql = "insert into prestacacao_contas_itens(pci_mes,pci_prestacao_contas)";
	 $sql .= " values('Janeiro',".$id[0]."),";
	 $sql .= " ('Fevereiro',".$id[0]."),";
	 $sql .= " ('Marco',".$id[0]."),";
	 $sql .= " ('Abril',".$id[0]."),";
	 $sql .= " ('Maio',".$id[0]."),";
	 $sql .= " ('Junho',".$id[0]."),";
	 $sql .= " ('Julho',".$id[0]."),";
	 $sql .= " ('Agosto',".$id[0]."),";
	 $sql .= " ('Setembro',".$id[0]."),";
	 $sql .= " ('Outubro',".$id[0]."),";
	 $sql .= " ('Novembro',".$id[0]."),";
	 $sql .= " ('Dezembro',".$id[0].")";
     
     $resultado = mysqli_query($conexao,$sql);
     if (!$resultado){ die("Falha no cadastro: ".mysqli_error($conexao) ); }  
	 
	 mkdir(__DIR__."/Documentacao/Prestacao_Contas/".$id[0], 0777);
	  
	   // mensagem de cadastro bem sucedido
     echo "<script language=\"javascript\">";
	 echo "alert('Cadastro bem sucedido!');";
	 echo  'window.location.href = "admin_prestacoes_contas.php";';
	 echo "</script>";
   }
   
 }
?>
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de uma nova prestação de contas </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página é possivel realizar o cadastro de uma nova prestação de contas. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de prestação de contas; </p>
   </div>
    <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Ano</strong> Aceita apenas números, faz referência ao ano que a prestação de contas pertence;</p>
    <p><strong>Página</strong> Neste campo é decidido se a prestação de contas pertence ao refeitorio ou à direção de serviços;</p>
  
    
   
   
    </div>
    
   <a href="admin_prestacoes_contas.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_prestacoes_contas.php" method="post" >
  <div class="etec-admin-pad-forms">
  
  
  <div class="etec-admin-pad-forms-info">
  <p>Ano</p>
  
    <input name="ano" type="number"  id="prestacao_ano"/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Página</p>
   <select name="identificacao_pag" class="Forme-elemente-dur  ">
   <option value="Refeitório">Refeitório</option>
   <option value="Direção de Serviço">Direção de Serviço</option>
  </select>
  
  </div>
  
 
  

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>



<script src="js/admin_prestacao_contas.js"></script>
</body>
</html>