$(function(){
  	
	$('.etec-admin-pad-conteudo-unit-reduces').click(function(){
	   
	    	//pega as informações
	   	var id = $(this).attr('item_id');
	   	var titulo = $(this).find('div[curso_titulo]').text();
	   	var periodo = $(this).find('div[curso_periodo]').text();
		var ativo = $(this).attr('ativo');
		
		if(periodo.trim() != 'Matutino'){
	   	   		//define o botao de desativar/ativar
	   		if(ativo == 'S'){
	      		$('.etec-pop-up-opcoes-two label[desativar]').text('Desativar'); 
	   		}
			else{
	      		$('.etec-pop-up-opcoes-two label[desativar]').text('Ativar'); 
	   		}
			   	//salva as informacoes
	   		$('#desativar').attr({'value':id});
			
				//Mostra o botao
			$('.etec-pop-up-opcoes-two label[desativar]').css({'display':'block'});

		}
		else{
				//Esconde o botao
			$('.etec-pop-up-opcoes-two label[desativar]').css({'display':'none'});
			
		} 
		  
		  	//salva o titulo e o id
		$('#editar').attr({'value':id});
	   	$('.etec-pop-up-conteud').text(titulo);
	   	
		$('.etec-pop-up-opcoes-two').css({'display':'block'});
		   
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
	  var titulo = document.getElementById('curso_titulo');
	  var sinopse = document.getElementById('curso_sinopse');
	  var descricao = document.getElementById('curso_descricao');
	  var duracao = document.getElementById('curso_duracao');
	  
	    //verifica se o campo foi preenchido
	  if((titulo.value=='')||(sinopse.value=='')||(descricao.value=='')||(duracao.value=='')){
	    $('#curso_titulo').css({'color':'red'});
		$('#curso_sinopse').css({'color':'red'});
		$('#curso_descricao').css({'color':'red'});
		$('#curso_duracao').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#curso_titulo').click(function(){
	 $('#curso_titulo').css({'color':'black'}); 
  });
  
  $('#curso_sinopse').click(function(){
	 $('#curso_sinopse').css({'color':'black'}); 
  });
  
  $('#curso_descricao').click(function(){
	 $('#curso_descricao').css({'color':'black'}); 
  });
  
  $('#curso_duracao').click(function(){
	 $('#curso_duracao').css({'color':'black'}); 
  });

}(jQuery))

