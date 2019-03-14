

function load_most_popular_div(data) {
	let mpop = $("#mpop");
	$.each(data, function(div_id, content) {
		mpop.append(`<div id="${div_id}"></div>`)
		obj = $(`#${div_id}`);
		$.each(content, function(tag, content) {
			if (tag == "img") {
				obj.append(`<img src="${content}">`)
			} else {
				obj.append(`<${tag}>${content}</${tag}>`)
			}
		})
	})
}



function get_most_popular_json() {
	$.getJSON('most_popular.json')

		.done(function(data) {
			load_most_popular_div(data);
		})

		.fail(function() {
			alert("fail");
		})

		.always(function() {
			alert("it always");
		})
}


//get_most_popular_json();