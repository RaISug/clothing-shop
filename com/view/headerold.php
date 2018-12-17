<DOCTYPE html>
<html>

	<style>
	
	   #header-link {
	       text-decoration: none;

	       color: none;
	   }
       
       #header-link:hover {
           text-decoration: underline;
       }

	   #header-link:hover + .dropdown {
	       display: block;
	   }
	   
	   .dropdown {
	       display: none;

           position:fixed;

           background-color: white;

           margin: -1px;

           border: 1px solid black;
	   }

       .dropdown:hover {
	       display: block;
	   }
	
	   #header-link-2:hover + .dropdown-2 {
	       display: block;
	   }
	   
	   .dropdown-2 {
	       display: none;

           position:fixed;

           background-color: white;

           margin: -1px;
           padding: 5px;

           border: 1px solid black;
	   }

       .fivePixelPadding {
           padding: 5px;
       }

       .fillParentWidth {
           min-width: 100%;
       }

       .linkWithoutIndent {
           padding: 0;
       }

       .linkWithoutBullets {
           list-style-type: none;
       }
	</style>
	
	<div>
		<a id="header-link" href="#">Test link</a>
		<div class="dropdown">
			<ul class="linkWithoutIndent linkWithoutBullets fullParentWidth">
				<li><a class="fivePixelPadding" href="#">Sub Link 1</a></li>
				<li><a class="fivePixelPadding" href="#">Sub Link 2</a></li>
				<li><a class="fivePixelPadding" href="#">Sub Link 3</a></li>
			</ul>
		</div>
		<a id="header-link-2" href="#">Test link</a>
		<div class="dropdown-2">
			rabotitiiii!!!!
		</div>
	</div>
	
	<script>
		(function() {
			var link = document.getElementById("header-link-2");

			var distanceFromLeftBorder = link.getBoundingClientRect().left;

			document.getElementsByClassName("dropdown-2")[0].style['left'] = distanceFromLeftBorder;
		})();
	</script>