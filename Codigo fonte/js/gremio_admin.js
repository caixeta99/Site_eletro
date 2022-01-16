$(function(){
  $('.etec-admin-pad-conteudo-unit-reduces').click(function(){
		 var id = $(this).attr('item_id');
		 $('.gremio_composicao').attr({'value':id}); 
		 $('.gremio_btn').click();
  });
}(jQuery))
