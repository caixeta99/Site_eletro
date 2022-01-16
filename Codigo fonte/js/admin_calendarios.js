$(function(){
  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var data = $(this).find('div[calendario_data]').text();
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
	   $('.etec-pop-up-conteud').text(data);
	   
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
	  var data = document.getElementById('calendario_data');
	  var descricao = document.getElementById('calendario_descricao');
	  	  
	    //verifica se o campo foi preenchido
	  if((data.value=='')||(descricao.value=='')){
	    $('#calendario_data').css({'color':'red'});
		$('#calendario_descricao').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#calendario_descricao').click(function(){
	 $('#calendario_descricao').css({'color':'black'}); 
  });
  
  $('#calendario_data').click(function(){
	 $('#calendario_data').css({'color':'black'}); 
  });
}(jQuery))

