$(function(){
         //pop_up
  $('.etec-admin-pad-conteudo-unit-reduces').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var pagina = $(this).find('div[prestacao_contas_pagina]').text();
	   var ano = $(this).find('div[prestacao_contas_ano]').text();
	   	   
		    //salva as informacoes
	   $('#editar').attr({'value':id}); 
	   $('#itens').attr({'value':id});
	   $('.etec-pop-up-conteud').text(ano+' - '+pagina);

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
	  var ano = document.getElementById('prestacao_ano');
	  	  
	    //verifica se o campo foi preenchido
	  if(ano.value==''){
	    $('#prestacao_ano').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#prestacao_ano').click(function(){
	 $('#prestacao_ano').css({'color':'black'}); 
  });
  
}(jQuery))

