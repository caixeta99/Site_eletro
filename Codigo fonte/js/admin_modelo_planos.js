$(function(){
  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var documento = $(this).find('div[documento]').text();
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
	   $('.etec-pop-up-conteud').text(documento);
	   
	        //mostra o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'visible'});
	   
  });

  $('.etec-img-fechar p').click(function(){
	   //esconde o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'hidden'}); 
	   
  });
  
  		//Paginá de edicao
  $('.button2 input').click(function(){
	  	    //verifica os valores que serao editados
	  var documento = document.getElementById('documento');
	  	  
	    //verifica se o campo foi preenchido
	  if(documento.value == ''){
	    $('#documento').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var documento = document.getElementById('documento');
	  var documento_arquivo = document.getElementById('selecao-arquivo');
	  	  
	    //verifica se o campo foi preenchido
	  if((documento.value == '')||(documento_arquivo.value == '')){
		  $('#documento').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#documento').click(function(){
	 $('#documento').css({'color':'black'}); 
  });

}(jQuery))

