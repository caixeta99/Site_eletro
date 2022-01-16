$(function(){
	
  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var descricao = $(this).find('div[processo_seletivo_descricao]').text();
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
	   $('.etec-pop-up-conteud').text(descricao);
	   
	        //mostra o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'visible'});
	   
  });

  $('.etec-img-fechar p').click(function(){
	   //esconde o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'hidden'}); 
	   
  });
  
                                            //pagina de cadastro\ edicao
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var nome = document.getElementById('vps_nome');
	  var data_i = document.getElementById('vps_data_i');
	  
	    //verifica se o campo foi preenchido
	  if((nome.value=='')||(data_i.value=='')){
	    $('#vps_nome').css({'color':'red'});
		$('#vps_data_i').css({'color':'red'});
		
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#vps_nome').click(function(){
	 $('#vps_nome').css({'color':'black'}); 
  });
  
  $('#vps_data_i').click(function(){
	 $('#vps_data_i').css({'color':'black'}); 
  });

  
}(jQuery))

