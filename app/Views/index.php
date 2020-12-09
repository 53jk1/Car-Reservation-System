<div class="container">
	<div class="row">
		<div class="col text-left d-flex flex-column">
			<a href="/" class="text-dark" title="Powrót na stronę główną"><h2><strong>Wypożyczalnia</strong></h2>
			<h3><strong>Samochodów</strong></h3></a>
		</div>
		<div class="col text-right">
			<?php if(@$_SESSION['zalogowany']){ ?>
				<a href="/admin">Panel administracyjny</a>
			<?php } else { ?>
				<a href="/login">Logowanie</a>
			<?php } ?>
		</div>
	</div>
</div>
<div class="container p-3 border rounded bg-white">
	<?php if(@$_SESSION['wypozyczono']){ ?>
	<div class="alert alert-success" role="alert">
		<?= $_SESSION['wypozyczono']; ?>
	</div>
	<?php } ?>
	<div id="carouselExampleControls" class="carousel slide d-block bg-dark" style="max-height: 400px; border-radius: 5px;" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="/obrazki/welcome.jpg" class="d-block" style="margin: 0 auto; max-height: 390px;">
			</div>
			<?php foreach($PrzykladoweSamochody as $Samochod) { ?>
				<div class="carousel-item">
					<a href="/car/<?= $Samochod['id']; ?>"><img src="<?= $Samochod['obrazek'] ?>" class="d-block" alt="<?= $Samochod['marka'] ?>" style="margin: 0 auto; max-height: 390px;"></a>
				</div>
			<?php } ?>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<h2 class="text-center mt-3">Zarezerwuj już dziś</h2>
	<h3 class="text-center mb-1">swój egzemplarz</h3>
	<div class="d-flex flex-wrap justify-content-around">
		<?php foreach($WszystkieSamochody as $Samochod) { ?>
			<div class="border border-secondary rounded p-2 m-1 d-flex flex-column" style="width: 300px">
				<img src="<?= $Samochod['obrazek'] ?>" alt="<?= $Samochod['marka'] ?>" class="w-100" />
				<p class="p-0 m-0">Marka: <?= $Samochod['marka'] ?> | Model: <?= $Samochod['model'] ?></p>
				<p class="border-bottom p-0 m-0 mb-1">Rok produkcji: <?= $Samochod['produkcja'] ?></p>
				<?php if($Samochod['status'] == 1) { ?>
					<a href="/car/<?= $Samochod['id']; ?>" class="btn btn-success my-2" role="button" title="Pojazd gotowy do rezerwacji">Wypożycz</a>
					<p>Już za <?= $Samochod['stawka']; ?> zł/h</p>
				<?php } else { ?>
					<a href="/car/<?= $Samochod['id']; ?>" class="btn btn-success disabled" tabindex="-1" role="button" aria-disabled="true" title="Pojazd jest aktualnie zarezerwowany">Pojazd zarezerwowany</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>