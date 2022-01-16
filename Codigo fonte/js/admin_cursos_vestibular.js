$(function(){
  $('.etec-admin-pad-cont-unit-click').click(function(){
		   
		        //pega as informações
	   var id = $(this).closest('.etec-admin-pad-conteudo-unit').attr('item_id');
	   var titulo = $(this).closest('.etec-admin-pad-conteudo-unit').find('div[curso_titulo]').text();
	    
	       //salva as informacoes
	   $('#editar').attr({'value':id}); 
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
	  var nome = document.getElementById('curso_nome');
	  var vagas = document.getElementById('curso_vagas');
	  	  
	    //verifica se o campo foi preenchido
	  if((nome.value == '')||(vagas.value <= 0)){
	    $('#curso_nome').css({'color':'red'});
		$('#curso_vagas').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#curso_nome').click(function(){
	 $('#curso_nome').css({'color':'black'}); 
  });
  
  $('#curso_vagas').click(function(){
	 $('#curso_vagas').css({'color':'black'}); 
  });
}(jQuery))

