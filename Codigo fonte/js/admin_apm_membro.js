$(function(){
  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var nome = $(this).find('div[apm_membro_nome]').text();
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
	  var nome = document.getElementById('membro_nome');
	  var cargo = document.getElementById('membro_cargo');
	  var rg = document.getElementById('membro_rg');
	  	  
	    //verifica se o campo foi preenchido
	  if((nome.value=='')||(cargo.value=='')||(rg.value=='')){
	    $('#membro_nome').css({'color':'red'});
		$('#membro_cargo').css({'color':'red'});
		$('#membro_rg').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#membro_nome').click(function(){
	 $('#membro_nome').css({'color':'black'}); 
  });
  
  $('#membro_cargo').click(function(){
	 $('#membro_cargo').css({'color':'black'}); 
  });
  
  $('#membro_rg').click(function(){
	 $('#membro_rg').css({'color':'black'}); 
  });
}(jQuery))

