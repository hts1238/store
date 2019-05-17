$(function() {
    let $button = $("nav.header button");
    let $header = $("nav.header");
    let $menu = $("div.header");
    let menu_is_open = false;
    
    $button.on("click", function() {
        if (menu_is_open) {
            $menu.css({
                "height" : "0"
            })
            $header.css({
                "box-shadow" : "0 5px 30px #0004"
            })
            menu_is_open = false;
        } else {
            $menu.css({
                "height" : "auto"
            })
            $header.css({
                "box-shadow" : "none"
            })
            menu_is_open = true;
        }
    })
})