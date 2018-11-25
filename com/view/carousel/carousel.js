setInterval(function() {
	moveToNextImage();
}, 3000);

function moveToPreviousImage() {
	var images = $("#carosel > img");

	var index = findIndexOfInlinedImage(images);
	
	$(images[index]).css("display", "none");
	
	if (index <= 0) {
		$(images[images.length - 1]).css("display", "inline");
	} else {
		$(images[--index]).css("display", "inline");
	}
}

function moveToNextImage() {
	var images = $("#carosel > img");

	var index = findIndexOfInlinedImage(images);
	
	$(images[index]).css("display", "none");
	
	if (index >= images.length - 1) {
		$(images[0]).css("display", "inline");
	} else {
		$(images[++index]).css("display", "inline");
	}
}

function findIndexOfInlinedImage(images) {
	for (var i = 0 ; i < images.length ; i++) {
		if ($(images[i]).css("display") === "inline") {
			return i;
		}
	}
}
