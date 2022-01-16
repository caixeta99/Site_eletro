$(function(){
  $('.etec-admin-pad-conteudo-unit-reduces').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
       var titulo = $(this).find('div[data_evento]').text();
	   var ativo = $(this).attr('ativo');

	   	   //define o botao de desativar/ativar
	   if(ativo == 'S'){
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
  
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var data = document.getElementById('data_evento_data');
	  	  
	    //verifica se o campo foi preenchido
	  if(data.value==''){
	    $('#data_evento_data').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#data_evento_data').click(function(){
	 $('#data_evento_data').css({'color':'black'}); 
  });
  
}(jQuery))

