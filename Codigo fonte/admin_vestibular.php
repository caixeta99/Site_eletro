<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
 
date_default_timezone_set('America/Sao_Paulo');
$ano = date('Y');
$mes = date('m');
$data = $ano.'-'.$mes.'-01';

$Vestibulinho = new Vestibulinho();
	
	//pega as informações do ultimo vestibular
$vestibulinho = $Vestibulinho->findLast();

if($vestibulinho){

	if($vestibulinho->v_semestre = '1º Semestre'){
		
		$mes_vestibulinho = '01';
	
	}
	else{
	
		$mes_vestibulinho = '07';
	
	} 

		//Pega a data em que os vestibulinho faz referência
	$data_vestibulinho = $vestibulinho->v_ano.'-'.$mes_vestibulinho.'-01';

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


                                   <!--titulo da pagina-->
<title>Vestibulinho</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

    //Cadastra um vestibulinho
if(isset($_POST['cadastrar'])){

    if((!$vestibulinho)or($data >= $data_vestibulinho)){ 

            //verifica se os campos foram recebidos
        if((isset($_POST['periodo']))and(isset($_POST['data']))and(isset($_POST['hora']))and(isset($_POST['valor']))){
              //pega os valores dos campos
            $periodo = $_POST['periodo'];
            $data_exame = $_POST['data'];
            $hora_exame = $_POST['hora'];
            $valor = $_POST['valor'];

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
                //Pega o nome
            $nome = 'Vestibulinho '.$semestre.' '.$ano;

                //Salva os campos  
            if(!($Vestibulinho->setNome($nome))){
                
                die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
            
            }
            $Vestibulinho->setAno($ano);
            if(!($Vestibulinho->setSemestre($semestre))){
                
                die('Falha ao tentar realizar o cadastro, opção inválida.');
            
            }
            if(!($Vestibulinho->setPeriodoInscricao($periodo))){
                
                die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
            
            }
            if(!($Vestibulinho->setPrecoInscricao($valor))){
                
                die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
            
            }
            $Vestibulinho->setDataExame($data_exame);
            $Vestibulinho->setHoraExame($hora_exame);
            

                //Insert
            if($Vestibulinho->insert()){
                
					//Atualiza os dados do ultimo vestibulinho
				$vestibulinho = $Vestibulinho->findLast();
				
				if($vestibulinho){
				
					if($vestibulinho->v_semestre = '1º Semestre'){
						
						$mes_vestibulinho = '01';
					
					}
					else{
					
						$mes_vestibulinho = '07';
					
					} 
					
						//Pega a data em que os vestibulinho faz referência
					$data_vestibulinho = $vestibulinho->v_ano.'-'.$mes_vestibulinho.'-01';
				
				}
				
                echo "<script language=\"javascript\">";
                echo "alert('Cadastro bem sucedido!');";
                echo "</script>";
                
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha ao tentar realizar o cadastro!');";
                echo '</script>';
                
            }
            
        }

    }
    else{

        echo '<script language="javascript">';
        echo "alert('Falha ao tentar realizar o cadastro!');";
        echo '</script>';

    }

}

//edicao do ultimo vestibulinho
if(isset($_POST['editar'])){

    if($vestibulinho){

            //verifica se os campos foram recebidos
        if((isset($_POST['periodo']))and(isset($_POST['data']))and(isset($_POST['hora']))and(isset($_POST['valor']))){
              //pega os valores dos campos
            $periodo = $_POST['periodo'];
            $data_exame = $_POST['data'];
            $hora_exame = $_POST['hora'];
            $valor = $_POST['valor'];

                //Salva os campos  
            if(!($Vestibulinho->setPeriodoInscricao($periodo))){
                
                die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
            
            }
            if(!($Vestibulinho->setPrecoInscricao($valor))){
                
                die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
            
            }
            $Vestibulinho->setDataExame($data_exame);
            $Vestibulinho->setHoraExame($hora_exame);
           
            if($Vestibulinho->update($vestibulinho->v_id)){
            
                echo '<script language="javascript">';
                echo "alert('Edição bem sucedida!');";
                echo '</script>';
            
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha na edição do vestibulinho!');";
                echo '</script>';
                
            }

        }  

    } 

}

?>


<main class="etec-admin-pag-padrao">
<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Vestibulares </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente aos vestibulinhos oferecidos pela escola. Logo abaixo desta mensagem há as seguintes opções: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro(Disponivel caso o vestibulinho desse semestre ainda não tenha sido cadastrado);</p>  
   <p><strong>"Alterar"</strong> Botão que irá redireciona-lo à página de edição;</p>
   <p><strong>"Processo Seletivo"</strong> Botão que irá redireciona-lo à página do processo seletivo;</p>
   <p><strong>"Cursos oferecidos"</strong> Botão que irá redireciona-lo à página dos cursos oferecidos;</p>
   <p><strong>"Recomendações"</strong> Botão que irá redireciona-lo à página de recomendações.</p>
  </div>


<?php 

if((!$vestibulinho)or($data >= $data_vestibulinho)){ 

?>
  <a href="admin_vestibular_cadastrar.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>

<?php 

} 

if(($vestibulinho)and($vestibulinho->v_id != '')){ 

?>
 
   <a href="admin_vestibular_editar.php" > <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Alterar 
   </div></a>
   
   <a href="admin_vestibular_processo_seletivo.php" ><div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten  " >
    Processo Seletivo 
   </div></a>
   
   <a href="admin_vestibular_cursos_ofere.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-alment" >
    Cursos Oferecidos
   </div></a>
   
   
   <a href="admin_vestibular_recomendacoes.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-alment " >
    Recomendaçoes
   </div></a>
   
<?php  

}

include("admin_barra_lateral_legendcores.php");

?> 
  

   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 	    
 
foreach($Vestibulinho->findAll() as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit-reduces  
 	<?php 
 	
	if($value->v_id == $vestibulinho->v_id){
	 	
		echo 'admin-pad-unit-ativar-color';
	  
	}
	else{
      
	  	echo 'admin-pad-unit-desativ-color';
	  
	} 
	
	?>"
       item_id="<?php echo $value->v_id; ?>" >
      
  
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Nome
   </div>
   <div class="etec-admin-pad-cont-unit-info">
        <?php 

        echo $value->v_nome; 

        ?>
   </div>
  
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Valor
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->v_preco_inscricao == ""){echo 'align="center"';}?>>
        <?php 

        if($value->v_preco_inscricao == ""){

            echo '--';

        }
        else{

            echo $value->v_preco_inscricao;

        }

        ?>
   </div>
   
    
     
  <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->

     Periodo de inscrição
   </div>
   <div class="etec-admin-pad-cont-unit-info etec-admin-pad-cont-unit-info " <?php if($value->v_periodo_inscricao == ""){echo 'align="center"';}?>>
        <?php 

        if($value->v_periodo_inscricao == ""){

            echo '--';

        }
        else{

            echo $value->v_periodo_inscricao;

        } 

        ?>  
   </div>
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->

     Data 
   </div>
   <div class="etec-admin-pad-cont-unit-info " <?php if($value->v_data_exame == ""){echo 'align="center"';}?>>
        <?php 

        if($value->v_data_exame == ""){

            echo '--';

        }
        else{

            echo date('d/m/Y',strtotime($value->v_data_exame));

        } 

        ?>
   </div>
   
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->

     Hora 
   </div>
   <div class="etec-admin-pad-cont-unit-info etec-admin-pad-cont-unit-info-alment " <?php if($value->v_hora_exame == ""){echo 'align="center"';}?>>
        <?php 

        if($value->v_hora_exame == ""){

            echo '--';

        }
        else{

            echo $value->v_hora_exame;

        }

        ?> 
   </div>
   
   
   
  
  
  
  
  <div class="etec-admin-pad-cont-unit-info">
     <div class="etec-admin-pad-cont-unit-dis">
     <div class="etec-admin-pad-cont-unit-dis-one">
        <div class="etec-admin-pad-cont-unit-title <?php if($value->v_ano == ""){echo 'align="center"';}?>"><!--- o "conteudo " virou "cont" --->
         Ano 
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info">
            <?php 

            if($value->v_ano == ""){

                echo '--';

            }
            else{

                echo $value->v_ano;

            }

            ?>
        </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-one"-->
     <div class="etec-admin-pad-cont-unit-dis-two">
       <div class="etec-admin-pad-cont-unit-title" <?php if($value->v_semestre == ""){echo 'align="center"';}?>><!--- o "conteudo " virou "cont" --->
        Semestre
       </div>
       <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info ">
            <?php 

            if($value->v_semestre == ""){

                echo '--';

            }
            else{

                echo $value->v_semestre;

            }

            ?>
       </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-two"-->
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->
  
  </div>
  
  
  
   

     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->

<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>






<script src="js/admin_vestibular.js"></script>
</body>
</html>