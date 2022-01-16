$(function(){
                                            //pagina de cadastro
  $('.button input').click(function(){
	  	    //verifica os valores que serao cadastrados
	  var data = document.getElementById('vestibular_data');
	  var hora = document.getElementById('vestibular_hora');
	  var periodo = document.getElementById('vestibular_periodo');
	  var taxa = document.getElementById('vestibular_taxa');
	  
	    //verifica se o campo foi preenchido
	  if((data.value=='')||(hora.value=='')||(periodo.value=='')||(taxa.value=='')){
		$('#vestibular_data').css({'color':'red'});
		$('#vestibular_hora').css({'color':'red'});
		$('#vestibular_periodo').css({'color':'red'});
		$('#vestibular_taxa').css({'color':'red'});
	  }else{
		$('.button input').attr({'type':'submit'});
		$('.button input').click();
	  }
  });
  
  $('#vestibular_data').click(function(){
	 $('#vestibular_data').css({'color':'black'}); 
  });
  
  $('#vestibular_hora').click(function(){
	 $('#vestibular_hora').css({'color':'black'}); 
  });
  
  $('#vestibular_taxa').click(function(){
	 $('#vestibular_taxa').css({'color':'black'}); 
  });
  
   $('#vestibular_periodo').click(function(){
	 $('#vestibular_periodo').css({'color':'black'}); 
  });
  
}(jQuery))

