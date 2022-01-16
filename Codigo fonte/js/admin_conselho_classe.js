$(function(){
  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var turma = $(this).find('div[conselho_classe_turma]').text();
	   var ativo = $(this).attr('ativo');

	   	   //define o botao de desativar/ativar
	   if(ativo.trim() == 'S'){
	      $('.etec-pop-up-opcoes-two label[desativar]').text('Desativar'); 
	   }else{
	      $('.etec-pop-up-opcoes-two label[desativar]').text('Ativar'); 
	   }
	   
				    //salva as informacoes
	   $('#editar').attr({'value':id}); 
	   $('#desativar').attr({'value':id});
	   $('.etec-pop-up-conteud').text(turma);
	   
	        //mostra o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'visible'});
	   
  });

  $('.etec-img-fechar p').click(function(){
	   //esconde o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'hidden'}); 
	   
  });
  
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var periodo = document.getElementById('conselho_classe_periodo');
	  var turma = document.getElementById('conselho_classe_turma');
	  var cadastrar = document.getElementById('cadastrar');
	  if(cadastrar){
		  
	  	var caminho = document.getElementById('selecao-arquivo');
	
	  }
	 
	  periodo_valores = Array('Ensino médio', 'Ensino integrado', 'Ensino integrado - Novotec', 'Ensino técnico');
	    //verifica se o campo foi preenchido
	  if((periodo_valores.indexOf(periodo.value) == -1)||(turma.value=='')){
	    $('#conselho_classe_periodo').css({'color':'red'});
		$('#conselho_classe_turma').css({'color':'red'});
	  }else{
		if(cadastrar){
		
		  if(caminho.value==''){
			
			alert('Preencha todos os campos e escolha um arquivo para cadastrar!');
			  
		  }
		  else{
			
			$('.button input').attr({'type':'submit'});
		    $('.button input').click();
			  
		  }
			
		}
		else{
	      
		  $('.button input').attr({'type':'submit'});
		  $('.button input').click();
	  	
		}
	  
	  }
  });
  
  $('#conselho_classe_periodo').click(function(){
	 $('#conselho_classe_periodo').css({'color':'black'}); 
  });
  
  $('#conselho_classe_turma').click(function(){
	 $('#conselho_classe_turma').css({'color':'black'}); 
  });
  
}(jQuery))

