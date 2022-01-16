$(function(){

    $('.cal-fix').click(function(){
	   var estado = $(this).closest('.calendar-unit').closest('.calenda-mes').find('.cal-sub').css('display');
	   if(estado == 'none'){
		 $(this).closest('.calendar-unit').closest('.calenda-mes').find('.cal-sub').css({'display':'block'});
		 $(this).find('img').attr({'src':'Imagens/Imagens estaticas/Icones/ponteiro-cima.png'});

	   }else{
	     $(this).closest('.calendar-unit').closest('.calenda-mes').find('.cal-sub').css({'display':'none'});
		 $(this).find('img').attr({'src':'Imagens/Imagens estaticas/Icones/ponteiro-baixo.png'});
	   }
	  
	});
	
});