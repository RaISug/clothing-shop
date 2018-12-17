var modal = document.getElementById('productModal');

var productImages = document.getElementsByClassName('productImage');
var modalImgage = document.getElementById("modalImage");
var captionText = document.getElementById("caption");

for (var i = 0; i < productImages.length; i++) {
	productImages[i].onclick = function() {
		modal.style.display = "block";

		modalImgage.src = this.src;

		captionText.innerHTML = this.alt;
	}
}