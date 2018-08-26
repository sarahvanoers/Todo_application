$(document).ready(function(){
	
	// ---------------------
	// DELETE LIST
	// ---------------------
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
	// ---------------------
	// CREATE LIST
	// ---------------------
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
	// ---------------------
	// CREATE COMMENT
	// ---------------------
	$('input.commentBtn').on('click', function(e){
        // als je een submit knop hebt refresht de pagina --> e.preventDefault(); om te vermijden
        e.preventDefault();
        //Haal textfield input en id op uit de home
	var userid = $(this).parent().find('.userId').val();
	var taskid = $(this).parent().find('.taskId').val();
	var comment = $(this).parent().find('.commentPost').val();
	var firstname = $(this).parent().find('.firstnameComment').val();
	var lastname = 	$(this).parent().find('.lastnameComment').val();
       
        console.log(userid, taskid, comment, firstname, lastname);
        //Verzend id en text input naar ajax/CommentCreate.php
        $.ajax({
            type:'POST',
            url:'ajax/commentCreate.php',
            //check post --> ajax/commentCreate.php
            data: {
                userid:userid,
                taskid:taskid,
                comment:comment
            }
        }).done(function(response){
            console.log(response);
            //response is het antwoord van ajax/CommentCreate.php
            if(response.code===200){
                //er gebeurt alleen iets als de code 200 is, wat ik dus gebruikt hebben voor het geslaagd toevoegen van een lijst
                //voeg de nieuwe lijst toe als het geslaagd is in de databank
                //modal verbergen
                //$('.modal-list').modal('toggle');
                console.log($('*[data-comments="' + response.task_id + '"]'));
                //input veld leeg maken
				$('.commentPost').val('');
				//toevoegen aan html lijstje
				//prepend voeg het bovenaan toe
				$('*[data-comments= "' + response.taskid +'"]').prepend('<h6 class="nameUserComment">'+firstname+' '+lastname+'</h6><p>'+response.comment+'</p>');
				//$(this).parent().find('.setComment').prepend('<h6 class="nameUserComment">'+firstname+' '+lastname+'</h6><p>'+response.comment+'</p>');
            };     
        });
	})
	// ---------------------
	// CREATE STATUS -- DONE TODO BUTTON
	// ---------------------
	$('button.done_button').on('click', function(e){
        // als je een submit knop hebt refresht de pagina --> e.preventDefault(); om te vermijden
        e.preventDefault();
        //Haal textfield input en id op uit de home
        var done_button = $(this).data('done_id');
       
        console.log(done_button,);
        //Verzend id en text input naar ajax/statusCreate.php
        $.ajax({
            type:'POST',
            url:'ajax/statusCreate.php',
            //check post --> ajax/statusCreate.php
            data: {
                status:done_button
            }
        }).done(function(response){
            console.log(response);
            //response is het antwoord van ajax/statusCreate.php
            if(response.code===200){
                //er gebeurt alleen iets als de code 200 is, wat ik dus gebruikt hebben voor het geslaagd toevoegen van een lijst
                //voeg de nieuwe lijst toe als het geslaagd is in de databank
               
				console.log(response);
				// verandert de tekst in de button 
				// maar bij refresh is het terug weg nakijken!
				$("#btn_done").html('Done');
				//$('*[data-done_id="'+response.taskid+'"]').html('Done');

				// data)done_id is net hetzelfde als in de html 
				$('*[data-done_id="'+response.taskid+'"]').addClass('taskDone');
				
            };    
        });
    })
	// ---------------------
	// DELETE TASK
	// ---------------------
	$('input.deleteTask').on('click', function(e){
		e.preventDefault();
			var task_id = $(this).data('task_id');
			console.log(task_id);
			$.ajax({
				type:'POST',
				url:'ajax/taskDelete.php',
				data: {id:task_id}
			}).done(function(response){
				if(response.code===200){
					//selecteer de input met die data attribuut, en verwijder het buitenste element
					$('*[data-task_id="'+response.id+'"]').remove();
					location.reload(); //page refresh in javascript
				};
			});
	})

	$('#exampleModalCenter3').on('show.bs.modal', function(e) {

		console.log('modal is open');
		//get data-id attribute of the clicked element
		var taskId = $(e.relatedTarget).data('task_id');
		console.log(taskId);
		//populate the textbox
		$(e.currentTarget).find('input[name="taskId"]').val(taskId);

		// https://stackoverflow.com/questions/10626885/passing-data-to-a-bootstrap-modal
		$.ajax({
			type:'POST',
			url:'ajax/getTask.php',
			// deze naam kies jezelf (key) {} is een object, en in een object zit
			// {
			// 	"naam" : "inhoud"
			// }
			data: {taskid:taskId}
		}).done(function(response){
			if(response){
				console.log(response)

				// //selecteer de input met die data attribuut, en verwijder het buitenste element
				// $('*[data-task_id="'+response.id+'"]').remove();
				// location.reload(); //page refresh in javascript
				$('input[name="change_title"]').val(response.title);
				$('input[name="change_working_hours"]').val(response.working_hours);
				$('input[name="change_dateOfTheDeadline"]').val(response.date);
				$('input[name="list_id"]').val(parseInt(response.list_id));

			};
		});

	});
})