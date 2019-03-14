$elem = $('#slides');

$elem.vegas({
    slides: [
        { src: 'styles/img/slide1.jpg' },
        { src: 'styles/img/slide2.jpg' },
        { src: 'styles/img/slide3.jpg' },
        { src: 'styles/img/slide5.jpg' },
        { src: 'styles/img/slide6.jpg' },
        { src: 'styles/img/slide7.jpg' },
        { src: 'styles/img/slide8.jpg' },
        { src: 'styles/img/slide9.jpg' }
    ],
    animation: 'random',
    timer: false,
    delay: 6000,
    shuffle: true,
    animationDuration: 5000,
    walk: function() {$elem.vegas('shuffle')}
});

function go(to) {

	links = {
		"sign up" : "signin/login.php",
		"the site guide" : "guide/main.html",
		"start shopping" : "main.html"
	};

    if (to == "start shopping")
        $("html").load(links[to]);
    else
	   location.href = links[to];
}