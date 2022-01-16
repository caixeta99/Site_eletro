$(function(){
	  //seleciona o primeiro evento
  $('.etec-eventos_index').first().addClass('selected_ev');
  $('.etec-event-content-list-pont-unit').first().addClass('select_pont');
  var img = $('.selected_ev').attr('imagem');
  var link_ev = 'Evento_Item?A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465ZZa32Xs45DDAWM='+$('.selected_ev').attr('id_ev');
  $('.link_evento').attr({'href':link_ev});
  $('.etec-event-content-img img').attr({'src':img});
  $('.etec-event-title').text($('.etec-eventos_index').first().find('.etec-event-content-list-unit-info').text());
       //evento ao clicar no evento
  $('.etec-eventos_index').click(function(){
	  $('.selected_ev').removeClass('selected_ev');
	  $(this).addClass('selected_ev');
	  
	  var img = $('.selected_ev').attr('imagem');
	  var link_ev = 'Evento_Item?A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465ZZa32Xs45DDAWM='+$('.selected_ev').attr('id_ev');
      $('.link_evento').attr({'href':link_ev});
      $('.etec-event-content-img img').attr({'src':img});
	  $('.etec-event-title').text($(this).find('.etec-event-content-list-unit-info').text());
  });
  
  $('.etec-event-content-list-pont-unit').click(function(){
	 var id = $(this).attr('evento');
	 $('.select_pont').removeClass('select_pont');
	 $(this).addClass('select_pont');
	 var evento = document.getElementById(id); 
	 evento.click();
  });
  
  //funcao que vai para o proximoevento
  var nextevento = function(){
	   if($('.etec-eventos_index.selected_ev').next('.etec-eventos_index').size()){
			$('.etec-eventos_index.selected_ev').each(function(){
				$(this).next('.etec-eventos_index').addClass('selected_ev');
				$(this).removeClass('selected_ev');
			});
			$('.etec-event-content-list-pont-unit.select_pont').each(function(){
				$(this).next('.etec-event-content-list-pont-unit').addClass('select_pont');
				$(this).removeClass('select_pont');
			});
			
		}else{
			$('.etec-eventos_index.selected_ev').each(function(){
				$('.etec-eventos_index').removeClass('selected_ev');
				$('.etec-eventos_index:eq(0)').addClass('selected_ev');
			});
			
			$('.etec-event-content-list-pont-unit.select_pont').each(function(){
				$('.etec-event-content-list-pont-unit').removeClass('select_pont');
				$('.etec-event-content-list-pont-unit:eq(0)').addClass('select_pont');
			});
		}
		var img = $('.selected_ev').attr('imagem');
		var link_ev = 'Evento_Item?A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465ZZa32Xs45DDAWM='+$('.selected_ev').attr('id_ev');
        $('.link_evento').attr({'href':link_ev});
		$('.etec-event-title').text($('.selected_ev').find('.etec-event-content-list-unit-info').text());
        $('.etec-event-content-img img').attr({'src':img});
  }
  
  // INICIALIZAÇÃO AUTOMÁTICA DOS EVENTOS
  var eventoAuto = setInterval(nextevento, 5000);

  $('.etec-event-content-img img,.etec-eventos_index,.etec-event-content-list-pont-unit').hover(function(){
	 clearInterval(eventoAuto);
  },function(){
	 eventoAuto = setInterval(nextevento, 5000);			
  });
  
});