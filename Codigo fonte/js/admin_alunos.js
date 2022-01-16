$(function(){
  $('.composit-gremir-unit').click(function(){
		   
	        //pega as informações
	   var id = $(this).attr('item_id');
	   var nome = $(this).find('div[nome]').text();
	   var modalidade = $(this).find('div[modalidade]').text();
	   var faculdade = $(this).find('div[faculdade]').text();
	   var ativo = $(this).attr('ativo');
	   var caminho = $(this).find('img').attr('src');
       
	      //define o botao de desativar/ativar
	   if(ativo.trim() == 'S'){
	      $('.opcoes label[desativar]').text('Desativar');
	   }else{
	      $('.opcoes label[desativar]').text('Ativar'); 
	   }
	   
		    //salva as informacoes
	   $('.opcoes input[id_editar_aluno]').attr({'value':id}); 
	   $('.opcoes input[id_desativar_aluno]').attr({'value':id});
	   
	   $('.inf p[nome]').text(nome);  
	   $('.inf p[modalidade]').text(modalidade);  
	   $('.inf p[faculdade]').text(faculdade);   

	   	          //se houver caminho para imagens ira mostra-la, se n houver ira mostrar a imagens padrao
	   if(caminho != ""){
	     $('.imagem img').attr({'src':caminho});
	   }else{
	     $('.imagem img').attr({'src':'Imagens/Imagem nao encontrada/icone_de_rosto.jpg'});
	   }
	   
	        //mostra o pop up 
       $('.tela-informacoes').css({'visibility':'visible'});	
  });

  $('.fechar p').click(function(){
	   //esconde o pop up 
	   $('.imagem img').attr({'src':''});
       $('.tela-informacoes').css({'visibility':'hidden'}); 
	   
  });
  
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var nome = document.getElementById('aluno_nome');
	  var modalidade = document.getElementById('aluno_modalidade');
	  var faculdade = document.getElementById('aluno_faculdade');
	  
	    //verifica se o campo foi preenchido
	  if((nome.value=='')||(modalidade.value=='')||(faculdade.value=='')){
	    $('#aluno_nome').css({'color':'red'});
		$('#aluno_modalidade').css({'color':'red'});
		$('#aluno_faculdade').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#aluno_nome').click(function(){
	 $('#aluno_nome').css({'color':'black'}); 
  });
  $('#aluno_modalidade').click(function(){
	 $('#aluno_modalidade').css({'color':'black'}); 
  });
  $('#aluno_faculdade').click(function(){
	 $('#aluno_faculdade').css({'color':'black'}); 
  });
}(jQuery))

