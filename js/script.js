$(document).ready(function(){
	$('input.deleteList').on('click', function(e){
		e.preventDefault();
			var list_id = $(this).data('list_id');
			console.log(list_id);
			$.ajax({
				type:'POST',
				url:'components/listDelete.php',
				data: {id:list_id}
			}).done(function(response){
				if(response.code===200){
					//selecteer de input met die data attribuut, en verwijder het buitenste element
					$('*[data-list_id="'+response.id+'"]').parent().parent().remove();
				};
			});
	})
})