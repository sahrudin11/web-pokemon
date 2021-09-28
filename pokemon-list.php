<?php
	function getPokemonList($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($curl);
		curl_close($curl);

		return json_decode($res,true);
	}

	function getPic($pic)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $pic);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($curl);
		curl_close($curl);

		return json_decode($res,true);
	}

	$total = 5;
	$result = getPokemonList('https://pokeapi.co/api/v2/pokemon?limit='.$total.'&offset=0');

	if (isset($_POST['countBtn'])) {
		$total = $_POST['count'];
		$result = getPokemonList('https://pokeapi.co/api/v2/pokemon?limit='.$total.'&offset=0');
	}

	if (isset($_GET['pagination'])) {
		if ($_GET['link'] !== "") {
			$link = $_GET['link'];
			$result = getPokemonList($link);
		}
	}

	$totalPage = $result['count'] / $total;

?>
<div class="row mt-5">
	<div class="col">
		<form action="" method="post">
	    	<select name="count" id="count">
	    		<option value="5">5</option>
	    		<option value="25">25</option>
	    		<option value="50">50</option>
	    	</select>
	    	<button type="submit" class="btn btn-info" name="countBtn">Ok</button>
	    </form>
	</div>
</div>
<div class="row mt-3 list-pokemon">
	<?php
		$list = $result['results'];
		foreach ($list as $lists) :
	?>
	<div class="col-md-3">
		<a href="?page=pokemon-detail&name=<?= $lists['name'] ?>">
			<div class="card border-0 mb-4 rounded shadow-sm">
			  <div class="card-body">
			    <p class="lead text-right"><strong><?= $lists['name'] ?></strong></p>
			    <?php
			    	$pic = getPic($lists['url']);
			    ?>
			    <img src="<?= $pic['sprites']['front_default'] ?>" alt="<?= $result['name'] ?>" class="img">
			  </div>
			</div>
		</a>
	</div>
	<?php
		endforeach;
	?>
</div>
<div class="row">
	<div class="col">
		<p>Total : <?= $result['count']; ?> Pokemons</p>
	</div>
</div>
<div class="row">
	<div class="col d-flex justify-content-center">
		<nav aria-label="...">
		  <ul class="pagination">
		    <li class="page-item mx-2">
		    <form action="" method="get">
		    	<input type="hidden" name="link" value="<?= $result['previous'] ?>">
		    	<button type="submit" class="btn btn-info" name="pagination">Prev</button>
		    </form>
		    </li>
		    <?php
		    	for ($i=1; $i <= $totalPage; $i++) :
		    ?>
		    <?= $i ?>
		    <!-- <a href="" class="btn btn-sm btn-info"><?= $i ?></a> -->
		    <?php
		    	endfor;
		    ?>
		    <li class="page-item mx-2">
		      <form action="" method="get">
		    	 <input type="hidden" name="link" value="<?= $result['next'] ?>">
		    	 <button type="submit" class="btn btn-info" name="pagination">Next</button>
		      </form></a>
		    </li>
		  </ul>
		</nav>
	</div>
</div>