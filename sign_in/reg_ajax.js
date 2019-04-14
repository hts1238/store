$(document).ready(function() {
    $("#but_submit").click(function() {
        event.preventDefault();
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var password_f = $("#first_password").val().trim();
        var password_s = $("#second_password").val().trim();

        if( name != "" && email != "" && password_f != "" && password_s != "" ) {
            $.ajax({
                url:'reg.php',
                type:'POST',
                data:{name:name,email:email,password_f:password_f,password_s:password_s},
                success:function(response) {
                    var msg = "";
                    if(response == "You have successfully registered") {
                        window.location = "home.html";
                    } else {
                        msg = response;
                    }
                    $("#message").html(msg);
                }
            });
        }
    });
});