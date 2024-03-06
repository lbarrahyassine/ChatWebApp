$(document).ready(function() {
    
    function loadMessages() {
        $.ajax({
            url: 'load_messages.php',
            success: function(data) {
                $('.discussion').html(data);
                // .discussion is the name of a div class in discussion.php that supposed to be refreshed automatically
            }
        });
    }

    
    setInterval(loadMessages, 250);

});
