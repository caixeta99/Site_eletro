$(function(){
	
   $('.etec-admin-pad-conteudo-unit').click(function(){
	   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var principal = $(this).attr('principal');
	   var ativo = $(this).attr('ativo');
	   
		   //define o botao de desativar/ativar
	   if(ativo.trim() == 'S'){
		  $('.etec-pop-up-opcoes-three label[imagem_priorizar]').css({'display':'block'}); 		   
		  if(principal.trim() == 'S'){ 
		    $('.etec-pop-up-opcoes-three label[imagem_priorizar]').text('Despriorizar');  
		  }else{
		    $('.etec-pop-up-opcoes-three label[imagem_priorizar]').text('Priorizar');   
		  }
	      $('.etec-pop-up-opcoes-three label[imagem_desativar]').text('Desativar'); 
	   }else{
		  $('.etec-pop-up-opcoes-three label[imagem_priorizar]').css({'display':'none'}); 
	      $('.etec-pop-up-opcoes-three label[imagem_desativar]').text('Ativar'); 
	   }
	   
		    //salva as informacoes
	   $('#editar').attr({'value':id}); 
	   $('#desativar').attr({'value':id});
	   $('#priorizar').attr({'value':id});	   	   

  	   	        //mostra o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'visible'})
	   
  });

  

  $('.etec-img-fechar p').click(function(){
	   //esconde o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'hidden'}); 
	   
  });
  
                                          //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var caminho = document.getElementById('selecao-arquivo');
	  	  
	    //verifica se o campo foi preenchido
	  if(caminho.value == ''){
	    alert('Escolha uma imagem!')
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
 	 
}(jQuery))

