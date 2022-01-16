$(function(){
     $('.aluno_depoimento img').click(function(){
	        //pega as informações
	   var depoimento = $(this).closest('.aluno_depoimento').attr('depoimento');
	   var nome = $(this).closest('.composit-gremir-unit').find('.nome_graduado').text();
       var modalidade = $(this).closest('.composit-gremir-unit').find('.modalidade_graduado').text();
       var faculdade = $(this).closest('.composit-gremir-unit').find('.faculdade_graduado').text();
	   var caminho = $(this).closest('.composit-gremir-unit').find('.imagem_graduado img').attr('src');

	   $('.graduados-inf p[nome]').text(nome);   
           $('.graduados-inf p[modalidade]').text(modalidade);   
           $('.graduados-inf p[faculdade]').text(faculdade);   
           $('.graduados-dep p').text(depoimento);   
           $('.graduados-img img').attr({'src':caminho});    
	   
	        //mostra o pop up 
       $('.tela-informacoes').css({'visibility':'visible'});
  });

  $('.fechar p').click(function(){
	   //esconde o pop up 
       $('.graduados-img img').attr({'src':''});
       $('.tela-informacoes').css({'visibility':'hidden'}); 
	   
  });
});