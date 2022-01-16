$(function(){
	
  $('.etec-admin-pad-conteudo-unit').click(function(){		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var titulo = $(this).find('div[programa_titulo]').text();
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
	   $('.etec-pop-up-conteud').text(titulo);
	   
	        //mostra o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'visible'});
	   
  });

  $('.etec-img-fechar p').click(function(){
	   //esconde o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'hidden'}); 
	   
  });
  
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var titulo = document.getElementById('programa_titulo');
	  var link_pr = document.getElementById('programa_link');
	  var descricao = document.getElementById('programa_descricao');
	  var cadastrar = document.getElementById('cadastrar');
	  if(cadastrar){
		  
	  	var caminho = document.getElementById('selecao-arquivo');
		
	  }
	  
	    //verifica se o campo foi preenchido
	  if((titulo.value=='')||(link_pr.value=='')||(descricao.value=='')){
		  
	    $('#programa_titulo').css({'color':'red'});
		$('#programa_link').css({'color':'red'});
		$('#programa_descricao').css({'color':'red'});
		
	  }
	  else{
		if(cadastrar){
		
		  if(caminho.value==''){
			
			alert('Preencha todos os campos e escolha uma imagem!');
			  
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
  
  $('#programa_titulo').click(function(){
	 $('#programa_titulo').css({'color':'black'}); 
  });
  
  $('#programa_link').click(function(){
	 $('#programa_link').css({'color':'black'}); 
  });
  
  $('#programa_descricao').click(function(){
	 $('#programa_descricao').css({'color':'black'}); 
  });
 
  
  
}(jQuery))

