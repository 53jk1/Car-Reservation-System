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
	<h2 class="text-center">Zarezerwuj już dziś</h2>
	<h3 class="text-center">swój egzemplarz</h3>
	<hr class="my-2" />
	<div class="row">
		<div class="col-md-6 d-flex flex-column">
			<h2><?= $Samochod['marka']; ?></h2>
			<img src="<?= $Samochod['obrazek']; ?>" class="w-100" />
		</div>
		<div class="col-md-6">
			<p>Marka: <strong><?= $Samochod['marka']; ?></strong></p>
			<p>Model: <strong><?= $Samochod['model']; ?></strong></p>
			<p>Rok produkcji: <strong><?= $Samochod['produkcja']; ?></strong></p>
			<hr />
			<p class="small">Dostępny za <i><span id="stawka"><?= $Samochod['stawka']; ?></span> zł</i> za jedną godzinę wypożyczenia</p>
			<h3>Kalkulator wypożyczenia</h3>
			<form class="row align-items-center" method="POST" action="/wypozycz">
				<div class="col">
					<?php if($Samochod['status'] == '1'){ ?>
					<input type="hidden" name="id" value="<?= $Samochod['id']; ?>" />
					<input type="submit" class="btn btn-success btn-lg" value="Wypożycz" />
					<?php } else { ?>
					<input type="submit" class="btn btn-success btn-lg" value="Już zarezerwowany" disabled="" />
					<?php } ?>
				</div>
				<div class="col">
					<label for="select">Wybierz czas wypożyczenia</label>
					<select class="custom-select" id="select" name="czas" <?php if($Samochod['status'] == '0'){ echo('disabled'); }?>>
						<option value="1" selected>Jedna godzina</option>
						<option value="2">Dwie godziny</option>
						<option value="3">Trzy godziny</option>
						<option value="4">Cztery godziny</option>
						<option value="5">Pięć godzin</option>
						<option value="6">Sześć godzin</option>
						<option value="7">Siedem godzin</option>
						<option value="8">Osiem godzin</option>
						<option value="9">Dziewięć godzin</option>
					</select>
					<p class="py-3">Razem: <strong><span id="razem" class="display-4"></span> zł</strong></p>
					<p class="m-0 p-0 small">Podana cena zawiera podatek VAT</p>
				</div>
			</form>
		</div>
	</div>
	<hr class="my-2" />
	<?php if($Samochod['status'] == '1'){ ?>
	<h3>Aktualna lokalizacja pojazdu:</h3>
		<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCITLKrOc8V6exZLS90zxLVCsAr-GUa-Yw&q=<?= $Samochod['miejsce_dokladne']; ?>" allowfullscreen></iframe>
	<?php } ?>
</div>