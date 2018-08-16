$(document).ready(function(){
	$('input.deleteList').on('click', function(e){
		e.preventDefault();
			var list_id = $(this).data('list_id');
			console.log(list_id);
			$.ajax({
				type:'POST',
				url:'ajax/listDelete.php',
				data: {id:list_id}
			}).done(function(response){
				if(response.code===200){
					//selecteer de input met die data attribuut, en verwijder het buitenste element
					$('*[data-list_id="'+response.id+'"]').parent().parent().remove();
					location.reload(); //page refresh in javascript
				};
			});
	})

	$('input.listBtn').on('click', function(e){
		// als je een submit knop hebt refresht de pagina --> e.preventDefault(); om te vermijden
		e.preventDefault();
		//Haal titel en input op uit het modal
		var title = $('.listTitle').val();
		var userid = $('.userId').val();
		console.log(e);
		//Verzend titel en input naar ajax/listCreate.php
		$.ajax({
			type:'POST',
			url:'ajax/listCreate.php',
			//check post --> ajax/listCreate.php
			data: {
				title:title,
				userid:userid
			}
		}).done(function(response){
			//response is het antwoord van ajax/listCreate.php
			if(response.code===200){
				//er gebeurt alleen iets als de code 200 is, wat ik dus gebruikt hebben voor het geslaagd toevoegen van een lijst
				//voeg de nieuwe lijst toe als het geslaagd is in de databank
				//modal verbergen
				$('.modal-list').modal('toggle');
				console.log(response);
				//input veld leeg maken
				$('.listTitle').val('');
				//toevoegen aan html lijstje
				$('.appendList').append('<li class="list-group-item">' +response.title+ '<span class="listAlign"><input type="submit" href="listDelete.php" class="deleteList" data-list_id="'+response.listid+'" value="&times;"></span></li>');
				
				//nodig om meteen terug te deleten
				$('input.deleteList').on('click', function(e){
					e.preventDefault();
						var list_id = $(this).data('list_id');
						console.log(list_id);
						$.ajax({
							type:'POST',
							url:'ajax/listDelete.php',
							data: {id:list_id}
						}).done(function(response){
							if(response.code===200){
								//selecteer de input met die data attribuut, en verwijder het buitenste element
								$('*[data-list_id="'+response.id+'"]').parent().parent().remove();
							};
						});
				})
			};
		});
	})
})