$(function(){
  $('caption').click(function(){	   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var nome = $(this).text();
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
	  var nome = document.getElementById('funcionario_nome');
	  var funcao = document.getElementById('funcionario_funcao');
	  
	    //verifica se o campo foi preenchido
	  if((nome.value == '')||(funcao.value == '')){
	    $('#funcionario_nome').css({'color':'red'});
		$('#funcionario_funcao').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#funcionario_nome').click(function(){
	 $('#funcionario_nome').css({'color':'black'}); 
  });
  
  $('#funcionario_funcao').click(function(){
	 $('#funcionario_funcao').css({'color':'black'}); 
  });
}(jQuery))

