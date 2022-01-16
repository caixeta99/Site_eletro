$(function(){
	    //soma dos margin e padding laterais
	var MarginPadding = 20;
	
	    //tamanho dos botoes
	var btnwidth = 0;
	
	    //margem laterais
	var margins = 2.4;	
	var porcentagem = 100-(margins*2);
		
    var img = 4;
	var ident = 0 ;

	
	                              
	                                 //redimensiona a div geral de eventos 
	var bwidth = parseInt($('body').width());
	//alert(bwidth);
	var cursomargin = parseInt((bwidth/100)*margins);
	var cursowidth =  parseInt((bwidth/100)*porcentagem); 
	                        
	$('.etec-cursos').css({'margin-left':+cursomargin+'px'});
	$('.etec-cursos').css({'width':+cursowidth+'px'});

                                   //reposiciona os botoes
    $('.prev-cursos').css({'left':+cursomargin+'px'});
	$('.next-cursos').css({'right':+cursomargin+'px'});
									 
	                               //redimensiona as imagens
	if(bwidth>=1150){
		img = 4;
	}
	
    if((bwidth>=768)&&(bwidth<1150)){
		img = 3;
	}
	
	if((bwidth>525)&&(bwidth<768)){
		img = 2;
	}
	
	if(bwidth<=525){
		img = 1;
	}
	
    var widthitem = parseInt((cursowidth-((img-1)*MarginPadding))/img);
	$('.etec-cursos_item').css({'width':+widthitem+'px'});
	$('.etec-cursos_img img').css({'height':+parseInt(widthitem)+'px'});
	
		                              //define o width do div que contem as imagens
    var width = (parseInt($('.etec-cursos_img .etec-cursos_item').outerWidth())+ parseInt($('.etec-cursos_img .etec-cursos_item').css('margin-right'))) * ($('.etec-cursos_img .etec-cursos_item').length+1);
	$('.etec-cursos_img').css({'width':+width+'px'});
	                               
		                               //redimensionamento dos botoes
    $('.nav-cursos').css({'margin-top':+(widthitem/2)+'px'});								   

	
	
	$(window).resize(function(){

	
	                                 //redimensiona a div geral de eventos 
	var bwidth = parseInt($('body').width());
	//alert(bwidth);
	var cursomargin = parseInt((bwidth/100)*margins);
	var cursowidth =  parseInt((bwidth/100)*porcentagem); 
	                        
	$('.etec-cursos').css({'margin-left':+cursomargin+'px'});
	$('.etec-cursos').css({'width':+cursowidth+'px'});

                                   //reposiciona os botoes
    $('.prev-cursos').css({'left':+cursomargin+'px'});
	$('.next-cursos').css({'right':+cursomargin+'px'});
									 						 
	
	                               //redimensiona as imagens
	if(bwidth>=1150){
		img = 4;
	}
	
    if((bwidth>=768)&&(bwidth<1150)){
		img = 3;
	}
	
	if((bwidth>525)&&(bwidth<768)){
		img = 2;
	}
	
	if(bwidth<=525){
		img = 1;
	}
	
    var widthitem = parseInt((cursowidth-((img-1)*MarginPadding))/img);
	$('.etec-cursos_item').css({'width':+widthitem+'px'});	
	$('.etec-cursos_img img').css({'height':+parseInt(widthitem)+'px'});

		
			                              //define o width do div que contem as imagens
    var width = (parseInt($('.etec-cursos_img .etec-cursos_item').outerWidth())+ parseInt($('.etec-cursos_img .etec-cursos_item').css('margin-right'))) * ($('.etec-cursos_img .etec-cursos_item').length+1);
	$('.etec-cursos_img').css({'width':+width+'px'});
	
		                               //redimensionamento dos botoes
    $('.nav-cursos').css({'margin-top':+(widthitem/2)+'px'});								   
	var count = ($('.etec-cursos_img .etec-cursos_item').length) - img;
	                          //retira a diferenca para reposicionar as imagens
    if(ident>count)
	{
	ident = count;	 
	}
	
	                       //reposiciona as imagens ao redimensionar a tela
	$('.etec-cursos_img').css({'margin-left':'-'+(ident*(widthitem+MarginPadding))+ 'px'}); 

	

	
	});

    
	var cursos_auto = setInterval(function(){next_curso();}, 3000);

	$('.etec-cursos_img,.nav-cursos').hover(function(){
			clearInterval(cursos_auto);
		},function(){
			cursos_auto = setInterval(next_curso, 3000);			
	});
		
	$('.next-cursos').click(function(){
	    next_curso();
	});
	
	var next_curso = function(){
		var count = ($('.etec-cursos_img .etec-cursos_item').length) - img;
	    var slide = parseInt($('.etec-cursos_img .etec-cursos_item').outerWidth())+ MarginPadding;
		if(ident<count){
	    ident ++;
		$('.etec-cursos_img').animate({'margin-left': '-=' + slide + 'px'},'500');
		}else{
		$('.etec-cursos_img').animate({'margin-left': '+=' + ident * slide + 'px'},'500');
		ident = 0;
		}
	};
	
	$('.prev-cursos').click(function(){
		var count = ($('.etec-cursos_img .etec-cursos_item').length) - img;
	    var slide = parseInt($('.etec-cursos_img .etec-cursos_item').outerWidth())+ MarginPadding;
		
		if(ident>0){
	    ident --;
		$('.etec-cursos_img').animate({'margin-left': '+=' + slide + 'px'},'500');
		}
	});
});