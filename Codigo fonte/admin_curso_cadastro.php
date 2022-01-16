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
                     
                        <!-- titulo da pagina -->
<title>Cadastro de Cursos</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de Curso</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de um novo curso. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de cursos; </p>
   </div>
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário ,nesse será mostrado os posiveis valores que são permitidos para cada campo.
    <p><strong>Título</strong> Aceita até 50 caracteres</p>
    <p><strong>Período</strong> Aceita os valores "Diurno" e "Noturno"</p>
    <p><strong>Duração</strong> Aceita apenas números e deve ser especificado sua unidade de medida: "Semestres" ou "Anos"</p>
    <p><strong>Imagens</strong> Aceita apenas imagens no formato "png" e "jpg"</p>
    <p><strong>Sinopse do Curso</strong> Aceita até 500 caracteres</p>
    <p><strong>Descrição  do Curso</strong> Aceita até 1000 caracteres</p>
    
   
   
    </div>
   <a href="admin_curso.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_curso.php" method="post" enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
   <div class="etec-admin-pad-forms-element">
   <input name="titulo" type="text" class="Forme-elemente adm-data-date " maxlength="50" id="curso_titulo" placeholder="Título do curso."/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Período</p>
  
     <select name="periodo" class="" id="">
    <option>Diurno</option>
    <option>Noturno</option>
   </select>
  </div>
  
  <div class="etec-admin-pad-forms-info">
  <p>Duração</p>
   <input name="duracao" type="number" placeholder="Duração" id="curso_duracao"/>
  <select name="Unidade_de_medida">
   <option>Anos</option>
   <option>Semestres</option>
  </select>
  
  </div>
  

  
  
  <div class="etec-admin-pad-forms-element">
   <textarea name="sinopse" class="text-area " id="curso_sinopse" placeholder="Sinopse do curso." maxlength="500" ></textarea>
  </div>
  
   <div class="etec-admin-pad-forms-element">
   <textarea name="descricao" class="text-area " id="curso_descricao" placeholder="Descrição do curso." maxlength="1000" ></textarea>
  </div>
    <div  class="etec-admin-pad-forms-enviar-img-btn">

   <label for='selecao-arquivo'>Selecionar uma imagem</label>
   <input  name="imagem" type="file" id="selecao-arquivo" accept="image/png, image/jpeg"/> 
   </div>  

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>



<script src="js/admin_cursos.js"></script>
</body>
</html>