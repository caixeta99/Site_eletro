$(function(){
  
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var horario_i = document.getElementById('horario_i');
	  var horario_f = document.getElementById('horario_f');
	  
	    //verifica se o campo foi preenchido
	  if(((horario_i.value != '')&&(horario_f.value==''))||((horario_i.value == '')&&(horario_f.value != ''))){
	    alert('Preencha ou deixe vazio ambos os campos');
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  

}(jQuery))

