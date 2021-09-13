<?php 
	session_start();
	if (isset($_GET['release'])) {
		$key = array_search($_GET['name'], $_SESSION['my-pokemon']);
		if ($key !== false) {
			unset($_SESSION['my-pokemon'][$key]);
			$_SESSION['my-pokemon'] = array_values($_SESSION['my-pokemon']);
			echo "<script> alert('Pokemon has been released') </script>";
		}
	}
?>
<div class="row mt-5 my-pokemon">
	<?php
		if (isset($_SESSION['my-pokemon'])) {
			if ($_SESSION['my-pokemon'] == null) {
				echo "<div class='col'><p class='text-center font-weight-bold'>You don't have any pokemons. Catch them now !</p></div>";
			}
			$list = $_SESSION['my-pokemon'];
			foreach ($list as $lists) :
	?>
	<div class="col-md-6">
		<div class="card border-0 mb-4 rounded shadow-sm">
		  <div class="card-body">
		    <p class="lead text-right"><strong><?= $lists ?></strong></p>
		    <a href="?page=pokemon-detail&name=<?= $lists ?>" class="btn btn-info">Details</a>
		    <a href="?page=my-pokemon&release=true&name=<?= $lists ?>" onclick="return confirm('This pokemon will be released ?')" class="btn btn-warning text-white">Release</a>
		  </div>
		</div>
	</div>
	<?php
			endforeach;
		}
	?>
</div>