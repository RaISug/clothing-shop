$(".CategoryImageName").each(function() {
	var eParent = $(this).parent();

	$(this).css({
		"min-width" : $(eParent).css("width")
	});
});

$(".CategoryImage").hover(function() {
	var eCategoryImageName = $(this).prev();
	
	$(eCategoryImageName).css("display", "block");
}, function() {
	var eCategoryImageName = $(this).prev();
	
	$(eCategoryImageName).css("display", "none");
});


$(".CategoryImageName").hover(function() {
	$(this).css("display", "block");

	var eCategoryImage = $(this).next();
	$(eCategoryImage).css({
		"transform" : "scale(1.1)",
		"transition" : "transform 0.5s"
	});
}, function() {
	$(this).css("display", "none");

	var eCategoryImage = $(this).next();
	$(eCategoryImage).css({
		"transform" : "scale(1)"
	});
});

$(".CategoryImageName").click(function() {
	var sHref = $(this).data("href");
	
	window.location = sHref;
});
