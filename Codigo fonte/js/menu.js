$(function(){
	     			
	
                        //eventos para o menu responsivo do celular obs:todos os eventos sao iguais, mas atuam em lugares diferentes
						
	$('#escola').click(function(){//evento do btn escola
    	var width = parseInt($('body').css('width'));//pega o tamanho da tela
	    if(width<=768){  //verifica se esta no modo tablet/celular
	     if(parseInt($('#escola ul').css('max-height')) == 0){//verifica se ja esta aberto o sub menu do btn escola, se sim ira fecha-lo, se n ira abri-lo
	   
	     $('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});     //esconde outros sub menus

	   
	     $('#escola ul').css({'max-height':'500px'});              //abre o sub menu escola
 	     $('#escola ul').css({'height':'auto'});	
		 
		}else{
		$('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});       //esconde o sub menu escola
		}
		}
	});
	
	$('#servicos').click(function(){
	   var width = parseInt($('body').css('width'));	
	    if(width<=768){
	     if(parseInt($('#servicos ul').css('max-height'))==0){
			 
	     $('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});
	   
	     $('#servicos ul').css({'max-height':'500px'});
 	     $('#servicos ul').css({'height':'auto'});	
 			
		}else{
		$('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});
		}
		}
	});
	$('#informacoes').click(function(){
		var width = parseInt($('body').css('width'));
     	if(width<=768){
	     if(parseInt($('#informacoes ul').css('max-height'))==0){	
	   
	     $('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});	
	   
	     $('#informacoes ul').css({'max-height':'500px'});
 	     $('#informacoes ul').css({'height':'auto'});		

		 }else{
		$('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});
		}
		}
	});
		$('#cursos').click(function(){
		var width = parseInt($('body').css('width'));
	    if(width<=768){
	     if(parseInt($('#cursos ul').css('max-height'))==0){	
	   
	     $('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});
	
	     $('#cursos ul').css({'max-height':'500px'});
 	     $('#cursos ul').css({'height':'auto'});	

		 }else{
		$('.etec-menu-tree-main-link ul ul').css({'max-height':'0px'});
		}
		}
	});
	
});