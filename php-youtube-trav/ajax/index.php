<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Search User</title>
	<link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
	<script>
		function showSuggestion(str) {
			if(str.length == 0) {
				document.getElementById('output').innerHTML = '';
			} else {
				// AJAX request
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open('GET', 'suggest.php?q='+str, true);

				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						document.getElementById('output').innerHTML = this.responseText;
					}
				}

				xmlhttp.send();
			}
		}
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="#">Navbar</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarColor01">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Features</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Pricing</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">About</a>
	      </li>
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="text" placeholder="Search">
	      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>
	</nav>

	<div class="container">
		<h1>Search Users</h1>
		<form>
			Search User: <input type="text" name="" class="form-control" placeholder="Enter user to search" onkeyup="showSuggestion(this.value)">
		</form>
		<br>
		<br>
		<p>Suggestions: <span id="output" style="font-weight: bold;"></span></p>
	</div>
</body>
</html>