$(document).ready(function() {
    
    function loadMessages() {
        $.ajax({
            url: 'load_messages.php',
            success: function(data) {
                $('.discussion').html(data);
            }
        });
    }

    
    setInterval(loadMessages, 500);
});
