$(function()  {
    $("input.deleteList").submit(function() {
        list_id = $(this).data('list_id');
        console.log(list_id);
    });
});