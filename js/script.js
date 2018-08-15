$(function()  {
	$("input.deleteList").click(function() {
		var list_id = $(this).data('list_id');
		console.log(list_id);
		$.ajax({
			type:'POST',
			url:'components/listDelete.php',
			data:'id=' + list_id,
			success:function(data) {
				if(data) {
					console.log("YEE")
				} else {
					console.log("BOO")
				}
			}
		})
	});
});