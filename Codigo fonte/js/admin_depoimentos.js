$(function(){
  $('.tabela tr').click(function(){
	   if($(this).attr('item_id')!='cabecalho'){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var aluno = $(this).find('td[aluno]').text();
	   var depoimento = $(this).find('td[depoimento]').text();
	   var ativo = $(this).attr('ativo');

	   	   //define o botao de desativar/ativar
	   if(ativo.trim() == 'S'){
	      $('.opcoes label[desativar]').text('Desativar'); 
	   }else{
	      $('.opcoes label[desativar]').text('Ativar'); 
	   }
	   
		    //salva as informacoes
	   $('.opcoes input[id_editar_depoimentos]').attr({'value':id}); 
	   $('.opcoes input[id_desativar_depoimentos]').attr({'value':id});
	   
	   $('.inf p[aluno]').text(aluno); 
	   $('.inf p[depoimento]').text(depoimento);   
	   
	        //mostra o pop up 
       $('.tela-informacoes').css({'visibility':'visible'});
	   }
  });

  $('.fechar p').click(function(){
	   //esconde o pop up 
       $('.tela-informacoes').css({'visibility':'hidden'}); 
	   
  });
  
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var dep = document.getElementById('depoimento');
	  	 
	    //verifica se o campo foi preenchido
	  if(dep.value == ''){	  
	    $('#depoimento').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#depoimento').click(function(){
	 $('#depoimento').css({'color':'black'}); 
  });
  
}(jQuery))

