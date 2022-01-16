$(function(){
  $('.etec-admin-pad-conteudo-unit').click(function(){
	        //pega as informações
	   var id = $(this).attr('item_id');

		    //salva as informacoes
	   $('.opcoes input[id_alunos]').attr({'value':id}); 
	   $('.opcoes input[id_depoimentos]').attr({'value':id});

	        //mostra o pop up 
       $('.tela-informacoes').css({'visibility':'visible'});
	   
  });

  $('.fechar p').click(function(){
	   //esconde o pop up 
       $('.tela-informacoes').css({'visibility':'hidden'}); 
	   
  });
  

}(jQuery))

