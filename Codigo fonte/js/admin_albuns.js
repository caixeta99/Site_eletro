$(function(){
  $('.tabela tr').click(function(){
	   if($(this).attr('item_id')!='cabecalho'){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var titulo = $(this).find('td[titulo]').text();
	   var ativo = $(this).attr('ativo');
	   var caminho = $(this).attr('caminho');

	   	   //define o botao de desativar/ativar
	   if(ativo.trim() == 'S'){
	      $('.opcoes label[desativar]').text('Desativar');
	   }else{
	      $('.opcoes label[desativar]').text('Ativar'); 
	   }
	   
		    //salva as informacoes
	   $('.opcoes input[id_editar_album]').attr({'value':id}); 
	   $('.opcoes input[id_desativar_album]').attr({'value':id});
	   
	   $('.inf p[titulo]').text(titulo);   
	   
	   	          //se houver caminho para imagens ira mostra-la, se n houver ira mostrar a imagens padrao
	   if(caminho != ""){
	     $('.imagem img').attr({'src':caminho});
	   }else{
	     $('.imagem img').attr({'src':'Imagens/Imagem nao encontrada/Imagem_album.jpg'});
	   }
	   
	        //mostra o pop up 
       $('.tela-informacoes').css({'visibility':'visible'});
	   }
  });

  $('.fechar p').click(function(){
	   //esconde o pop up 
	   $('.imagem img').attr({'src':''});
       $('.tela-informacoes').css({'visibility':'hidden'}); 
	   
  });
  
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var titulo = document.getElementById('album_titulo');
	  
	    //verifica se o campo foi preenchido
	  if(titulo.value==''){
	    $('#album_titulo').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#album_titulo').click(function(){
	 $('#album_titulo').css({'color':'black'}); 
  });
}(jQuery))

