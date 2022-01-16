$(function(){
	
  $('.etec-admin-pad-conteudo-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var ano = $(this).find('div[apm_ano]').text();
	   
				    //salva as informacoes
	   $('#apm_membros').attr({'value':id}); 
	   $('#apm_plano_trabalho').attr({'value':id});
	   $('.etec-pop-up-conteud').text(ano);
	   
	        //mostra o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'visible'});
	   
  });

  $('.etec-img-fechar p').click(function(){
	   //esconde o pop up 
       $('.etec-pop-up-tela-informacoes-fundo').css({'visibility':'hidden'}); 
	   
  });
  
}(jQuery))

