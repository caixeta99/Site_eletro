$(function(){
  $('.etec-admin-pad-conteudo-unit').click(function(){	  		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var destaque = $(this).attr('prioridade');
	   var destinatario = $(this).find('div[aviso_destinatario]').text();
	   var ativo = $(this).attr('ativo');
	   
	      //define o botao de desativar/ativar
	   if(ativo.trim() == 'S'){
	      $('.etec-pop-up-opcoes-three label[aviso_desativar]').text('Desativar'); 
		  $('.etec-pop-up-opcoes-three label[aviso_priorizar]').css({'display':'block'}); 
		     //define o botao de prioridade
	      if(destaque.trim() == 'N'){
	         $('.etec-pop-up-opcoes-three label[aviso_priorizar]').text('Priorizar'); 
	      }else{
	         $('.etec-pop-up-opcoes-three label[aviso_priorizar]').text('Despriorizar'); 
	      }
	   }else{
	      $('.etec-pop-up-opcoes-three label[aviso_desativar]').text('Ativar'); 
		  $('.etec-pop-up-opcoes-three label[aviso_priorizar]').css({'display':'none'}); 
	   }
	   
	   
		    //salva as informacoes
	   $('#editar').attr({'value':id}); 
	   $('#desativar').attr({'value':id});
	   $('#priorizar').attr({'value':id});
	   $('.etec-pop-up-conteud').text(destinatario);
	   
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
	  var descricao = document.getElementById('aviso_descricao');
	  
	    //verifica se o campo foi preenchido
	  if(descricao.value == ''){
		$('#aviso_descricao').css({'color':'red'});
	  }else{ 
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
	  
  });
  
  $('#aviso_descricao').click(function(){
	 $('#aviso_descricao').css({'color':'black'});  
  });									
  
}(jQuery))

