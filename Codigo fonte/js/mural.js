$(function(){

    $('.etec-avi-fix').click(function(){
	   var estado = $(this).closest('.etec-mural-avi').find('.etec-avi-sub').css('display');
	   if(estado == 'none'){
		 $(this).closest('.etec-mural-avi').find('.etec-avi-sub').css({'display':'block'});
		 $(this).text('Reduzir');

	   }else{
	     $(this).closest('.etec-mural-avi').find('.etec-avi-sub').css({'display':'none'});
		 $(this).text('Lista Completa');
	   }
	  
	});
	
});