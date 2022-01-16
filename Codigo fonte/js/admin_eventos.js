$(function(){
	
  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var titulo = $(this).find('div[evento_titulo]').text();
	   var ativo = $(this).attr('ativo');
      
	   	   //define o botao de desativar/ativar
	   if(ativo.trim() == 'S'){
	      $('.etec-pop-up-opcoes-three label[desativar]').text('Desativar'); 
	   }else{
		  $('.etec-pop-up-opcoes-three label[desativar]').text('Ativar');
	   }
	   
		    //salva as informacoes
	   $('#editar').attr({'value':id}); 
	   $('#desativar').attr({'value':id});
	   $('#datas').attr({'value':id});
	   $('.etec-pop-up-conteud').text(titulo);
	   
	        //mostra o pop up 
	   $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'visible'}); 

  });

  $('.etec-img-fechar p').click(function(){
	   //esconde o pop up 
	   $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'hidden'});
	   
  });
  
                                            //pagina de cadastro
  $('.button2 input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var titulo = document.getElementById('evento_titulo');
	  var sinopse = document.getElementById('evento_sinopse');
	  var descricao = document.getElementById('evento_descricao');
	  
	    //verifica se o campo foi preenchido
	  if((titulo.value=='')||(sinopse.value=='')||(descricao.value=='')){
	    $('#evento_titulo').css({'color':'red'});
		$('#evento_sinopse').css({'color':'red'});
		$('#evento_descricao').css({'color':'red'});
	  }else{
		$('.button2 input').attr({'type':'submit'});
		$('.button2 input').click();
	  }
  });
  
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var titulo = document.getElementById('evento_titulo');
	  var sinopse = document.getElementById('evento_sinopse');
	  var descricao = document.getElementById('evento_descricao');
	  var data_evento = document.getElementById('evento_data');

	    //verifica se o campo foi preenchido
	  if((titulo.value=='')||(sinopse.value=='')||(descricao.value=='')||(data_evento.value=='')){
	    $('#evento_titulo').css({'color':'red'});
		$('#evento_sinopse').css({'color':'red'});
		$('#evento_descricao').css({'color':'red'});
		$('#evento_data').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#evento_titulo').click(function(){
	 $('#evento_titulo').css({'color':'black'}); 
  });
  
  $('#evento_sinopse').click(function(){
	 $('#evento_sinopse').css({'color':'black'}); 
  });
  
  $('#evento_descricao').click(function(){
	 $('#evento_descricao').css({'color':'black'}); 
  });
  
  $('#evento_data').click(function(){
	 $('#evento_data').css({'color':'black'}); 
  });
  
}(jQuery))

