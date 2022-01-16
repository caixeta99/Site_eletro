$(function(){
    $('.etec-event-imgs-btn').click(function(){  
	
	   var estado = $('.eve-imgs-unit-mais').css('display');
	   if(estado == 'none'){
		 $('.eve-imgs-unit-mais').css({'display':'block'});
		 $(this).text('Ver menos');

	   }else{
	     $('.eve-imgs-unit-mais').css({'display':'none'});
		 $(this).text('Ver mais');
	   }
	  
	});
	
	 $('.etec-event-imgs-main img').click(function(){
      //verifica o tamanho da tela 
	   var width = parseInt($('body').css('width'));
	   if(width>700){
		   
       var imagem = $(this).attr('src'); 
	   $('#imagem').attr({'src':imagem});
        
	   	  //esconde os botoes do menu
	   $('.slider-prev').css({'visibility':'hidden'}); 
	   $('.slider-next').css({'visibility':'hidden'});
	   
	   $('.etec-event-imgs-btn').css({'opacity':'0.1'}); 
	   $('.etec-event-imgs-unit').css({'background-color':'#000'});
	   $('.etec-event-imgs-unit img').css({'opacity':'0.1'}); 
	   $('.pop_up_fundo').css({'visibility':'visible'}); 
	   $('.pop_up').css({'visibility':'visible'}); 
	 }
  });
  
  $(window).resize(function() {
      //verifica o tamanho da tela 
	   var width = parseInt($('body').css('width'));
	   if(width <= 700){
		 sair();	
	   }
  });
  
  $('.fechar-album img').click(function(){
      sair();	    
  });
  
  var sair = function(){
  	  //mostra os botoes do menu
	   $('.slider-prev').css({'visibility':'visible'}); 
	   $('.slider-next').css({'visibility':'visible'});
	   
	   $('.etec-event-imgs-btn').css({'opacity':'1'}); 
	   $('.etec-event-imgs-unit').css({'background-color':'#FFF'});
	   $('.etec-event-imgs-unit img').css({'opacity':'1'}); 
	   $('.pop_up_fundo').css({'visibility':'hidden'}); 
	   $('.pop_up').css({'visibility':'hidden'}); 
	   $('#imagem').attr({'src':''});
  }
  
});