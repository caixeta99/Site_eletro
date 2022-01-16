$(function(){
	  //seleciona o primeiro evento
  $('.gradu-cont-inf-pont').first().addClass('gradu-selected');
  var nome = $('.gradu-selected').attr('aluno');
  var curso = $('.gradu-selected').attr('curso');
  var depoimento = $('.gradu-selected').attr('depoimento');
  var img = $('.gradu-selected').attr('imagem');
  $('.gradu-cont-img img').attr({'src':img});
  $('.gradu-cont-inf-name').text(nome);
  $('.gradu-cont-inf-cur').text(curso);
  $('.gradu-cont-inf-dep').text(depoimento);
  
  
      //evento ao clicar no ponto do graduado
  $('.gradu-cont-inf-pont-pon').click(function(){
	  $('.gradu-selected').removeClass('gradu-selected');
	  $(this).closest('.gradu-cont-inf-pont').addClass('gradu-selected');
	  
  var nome = $('.gradu-selected').attr('aluno');
  var curso = $('.gradu-selected').attr('curso');
  var depoimento = $('.gradu-selected').attr('depoimento');
  var img = $('.gradu-selected').attr('imagem');
  $('.gradu-cont-img img').attr({'src':img});
  $('.gradu-cont-inf-name').text(nome);
  $('.gradu-cont-inf-cur').text(curso);
  $('.gradu-cont-inf-dep').text(depoimento);
  });
  
  
  //funcao que vai para o proximo graduado
  var nextgradu = function(){
  	   if($('.gradu-cont-inf-pont.gradu-selected').next('.gradu-cont-inf-pont').size()){
			$('.gradu-cont-inf-pont.gradu-selected').each(function(){
				$(this).next('.gradu-cont-inf-pont').addClass('gradu-selected');
				$(this).removeClass('gradu-selected');
			});
		}else{
			$('.gradu-cont-inf-pont.gradu-selected').each(function(){
				$(this).removeClass('gradu-selected');
				$('.gradu-cont-inf-pont:eq(0)').addClass('gradu-selected');
			});

		}
  var nome = $('.gradu-selected').attr('aluno');
  var curso = $('.gradu-selected').attr('curso');
  var depoimento = $('.gradu-selected').attr('depoimento');
  var img = $('.gradu-selected').attr('imagem');
  $('.gradu-cont-img img').attr({'src':img});
  $('.gradu-cont-inf-name').text(nome);
  $('.gradu-cont-inf-cur').text(curso);
  $('.gradu-cont-inf-dep').text(depoimento);
  }
  
    // INICIALIZAÇÃO AUTOMÁTICA DOs graduados
  var graduAuto = setInterval(nextgradu, 6000);

  $('.gradu-cont-inf,.gradu-cont-img').hover(function(){
	 clearInterval(graduAuto);
  },function(){
	 graduAuto = setInterval(nextgradu, 6000);			
  });
});