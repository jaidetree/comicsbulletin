$(document).ready(function(){ 
    $('.l-header .search').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var query = $(this).find('input[type="text"]').val();

        window.location = url + encodeURI(query);
    });
});
