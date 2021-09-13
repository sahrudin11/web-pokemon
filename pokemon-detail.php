<?php
	session_start();

	if (isset($_POST['catch'])) {
		$prob = rand(0,1);
		if ($prob == 1) {
			echo "<script> alert('Pokemon catched !') </script>";
			$_SESSION['my-pokemon'][] = $_POST['pokemon'];
		}else{
			echo "<script> alert('Oh no, you missed') </script>";
		}
	}

	$pokeName = $_GET['name'];
	$pokeUrl = 'https://pokeapi.co/api/v2/pokemon/'.$pokeName;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $pokeUrl);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($curl);
	curl_close($curl);

	$result = json_decode($res,true);
	$countAbilities = count($result['abilities']) + 1;

?>
<div class="row mt-5 detail-pokemon">
	<div class="col-md-6">
		<div class="card border-0 mb-4 rounded shadow-sm py-1">
		  <div class="card-body">
		  	<div class="row">
		  		<div class="col">
		  			<img src="<?= $result['sprites']['front_default'] ?>" alt="<?= $result['name'] ?>" class="img">
		  			<img src="<?= $result['sprites']['back_default'] ?>" alt="<?= $result['name'] ?>" class="img">
		  			<img src="<?= $result['sprites']['front_shiny'] ?>" alt="<?= $result['name'] ?>" class="img">
		  			<img src="<?= $result['sprites']['back_shiny'] ?>" alt="<?= $result['name'] ?>" class="img">
		  			<form action="" method="post">
		  				<input type="hidden" name="pokemon" value="<?= $result['name'] ?>">
		  				<button type="submit" name="catch" class="btn btn-info btn-block mt-3 text-uppercase">Catch !</button>
		  			</form>
		  		</div>
		  	</div>
		  </div>
		</div>
	</div>
	<div class="col-md-6">
		<table class="table table-bordered">
		  <tbody>
		  	<tr>
		  		<td><strong>Name</strong></td><td><?= $result['name'] ?></td>
		  	</tr>
		  	<tr>
		  		<td><strong>Type</strong></td><td><?= $result['types'][0]['type']['name'] ?></td>
		  	</tr>
		  	<tr>
		  		<td rowspan="<?= $countAbilities ?>"><strong>Abilities</strong></td>
		  	</tr>
		  	<?php
		  		$abilities = $result['abilities'];
		  		foreach ($abilities as $ability) :
		  	?>
		  	<tr>
		  		<td><?= $ability['ability']['name']; ?></td>
		  	</tr>
		  	<?php
		  		endforeach;
		  	?>
		  </tbody>
		</table>
	</div>
</div>