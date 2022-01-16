$(function(){

  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var nome = $(this).find('div[nome_membro]').text();
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
	   $('.etec-pop-up-conteud').text(nome);
	   
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
	  var nome = document.getElementById('corpo_docente_nome');
	  var email = document.getElementById('corpo_docente_email');
	  	  
	    //verifica se o campo foi preenchido
	  if((nome.value=='')||(email.value=='')){
	    $('#corpo_docente_nome').css({'color':'red'});
		$('#corpo_docente_email').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#corpo_docente_nome').click(function(){
	 $('#corpo_docente_nome').css({'color':'black'}); 
  });
  
  $('#corpo_docente_email').click(function(){
	 $('#corpo_docente_email').css({'color':'black'}); 
  });
}(jQuery))

