<?php
	function getPokemonList($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($curl);
		curl_close($curl);

		return json_decode($res,true);
	}

	$result = getPokemonList('https://pokeapi.co/api/v2/pokemon?limit=12&offset=0');

	if (isset($_GET['pagination'])) {
		if ($_GET['link'] !== "") {
			$link = $_GET['link'];
			$result = getPokemonList($link);
		}
	}

?>
<div class="row mt-5 list-pokemon">
	<?php
		$list = $result['results'];
		foreach ($list as $lists) :
	?>
	<div class="col-md-3">
		<a href="?page=pokemon-detail&name=<?= $lists['name'] ?>">
			<div class="card border-0 mb-4 rounded shadow-sm">
			  <div class="card-body">
			    <p class="lead text-right"><strong><?= $lists['name'] ?></strong></p>
			  </div>
			</div>
		</a>
	</div>
	<?php
		endforeach;
	?>
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