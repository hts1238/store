$(document).ready(function() {
    $("#but_submit").click(function() {
        event.preventDefault();
        var email = $("#email").val().trim();
        var password = $("#password").val().trim();

        if( email != "" && password != "" ) {
            $.ajax({
                url:'log_in.php',
                type:'POST',
                data:{email:email,password:password},
                success:function(response) {
                    var msg = "";
                    if(response == 1) {
                        window.location = "home.html";
                    } else{
                        msg = "Invalid email or password!";
                    }
                    $("#message").html(msg);
                }
            });
        }
    });
});