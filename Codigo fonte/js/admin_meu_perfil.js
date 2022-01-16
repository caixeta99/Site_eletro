$(function(){
 $('#salvar_alteracoes input').click(function(){
	 	    //verifica os valores que serao alterados
	  var login = document.getElementById('login_usuario');
	    //verifica se o campo foi preenchido
	  if(login.value.length<=8){
	    $('#login_usuario').css({'color':'red'});
		alert('O login deve possuir pelo menos 8 caracteres.');
	  }else{
		$('#salvar_alteracoes input').attr({'type':'submit'});
		$('#salvar_alteracoes input').click();
	  } 
 });
 
 $('#login_usuario').click(function(){
	 $('#login_usuario').css({'color':'black'}); 
  });
  
  $('#salvar_alteracoes_senha input').click(function(){
          //verifica os valores que serao alterados
	  var senha_atual = document.getElementById('senha_atual');
	  var nova_senha = document.getElementById('nova_senha');
	  
	    //verifica se o campo foi preenchido
	  if((senha_atual.value.length<=8)||(nova_senha.value.length<=8)){
	    $('#senha_atual').css({'color':'red'});
		$('#nova_senha').css({'color':'red'});
	    alert('A senha deve possuir pelo menos 8 caracteres.');
	  }else{
		$('#salvar_alteracoes_senha input').attr({'type':'submit'});
		$('#salvar_alteracoes_senha input').click();
	  } 
  }); 
  
  $('#senha_atual').click(function(){
	 $('#senha_atual').css({'color':'black'}); 
  });
  
  $('#nova_senha').click(function(){
	 $('#nova_senha').css({'color':'black'}); 
  });
   
}(jQuery))

