$.each($(".headerLink > li > button"), function() {
	var sElementId = $(this).attr("id");
	var sElementIndex = sElementId.substring(sElementId.length - 1);

	$("#" + sElementId).hover(function() {
		$("#dropdown" + sElementIndex).css({
			display: "block",
			left: $("#" + sElementId).position().left - 4
		});
	}, function() {
		$("#dropdown" + sElementIndex).css("display", "none");
	});
});

$.each($(".headerLink > li > div"), function() {
	var sElementId = $(this).attr("id");
	var sElementIndex = sElementId.substring(sElementId.length - 1);

	$("#" + sElementId).hover(function() {
		$("#" + sElementId).css("display", "block");
		$("#link" + sElementIndex).css({
			"background-color" : "#969696"
		});
	}, function() {
		$("#" + sElementId).css("display", "none");
		$("#link" + sElementIndex).css({
			"background-color" : "#333"
		});
	});
});

$(".navigationButtons").hover(function() {
	$(this).css("background-color", "#969696");
}, function() {
	$(this).css("background-color", "#333");
});
