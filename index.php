<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pokemon!</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg shadow-sm bg-white navbar-dark">
		<div class="container">
		  <button class="navbar-toggler text-info" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav mx-auto">
		      <li class="nav-item mx-3">
		        <a class="nav-link text-info" href="?page=pokemon-list">Pokemon List</a>
		      </li>
		      <li class="nav-item mx-3">
		        <a class="nav-link text-info" href="?page=my-pokemon">My Pokemon</a>
		      </li>
		    </ul>
		  </div>
	  </div>
	</nav>

	<div class="container px-0" id="main">
		<?php 
			// Link Navigasi
			if(isset($_GET['page'])) {
				
				$page = $_GET['page'];

				switch ($page) {
					case 'pokemon-list':
						include 'pokemon-list.php';
						break;

					case 'pokemon-detail':
						include 'pokemon-detail.php';
						break;

					case 'my-pokemon':
						include 'my-pokemon.php';
						break;
					
					default:
						include '404.php';
						break;
				}
			}else{
				include 'pokemon-list.php';
			}
		?>
	</div>
	
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>