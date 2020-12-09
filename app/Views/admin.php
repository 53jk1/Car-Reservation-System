<div class="container">
	<div class="row">
		<div class="col text-left d-flex flex-column">
			<a href="/" class="text-dark" title="Powrót na stronę główną"><h2><strong>Wypożyczalnia</strong></h2>
			<h3><strong>Samochodów</strong></h3></a>
		</div>
		<div class="col text-right">
			<a href="/logout">Wyloguj</a>
		</div>
	</div>
</div>
<div class="container p-3 border rounded bg-white">
	<h3>Panel administracyjny</h3>
	<?php if(@$_SESSION['edytowano']){ ?>
	<div class="alert alert-success" role="alert">
		<?= $_SESSION['edytowano']; ?>
	</div>
	<?php } ?>
	<p>Jesteś adminem, możesz zarządzać samochodami, w tabeli poniżej:</p>
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col" class="small">ID</th>
				<th scope="col" class="small">Marka i model</th>
				<th scope="col" class="small">Rok produkcji</th>
				<th scope="col" class="small">Cena za 1 godzinę</th>
				<th scope="col" class="small">Dostępność</th>
				<th scope="col" class="small">Aktualne miejsce</th>
				<th scope="col" class="small">Zdjęcie</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($WszystkieSamochody as $Samochod){ ?>
			<tr>
				<form method="POST" action="/admin" name="<?= $Samochod['id']; ?>" id="<?= $Samochod['id']; ?>">
					<th scope="row" class="small">
						<?= $Samochod['id']; ?>
						<input type="hidden" name="id" value="<?= $Samochod['id']; ?>">
					</th>
					<td>
						<input type="text" class="form-control form-control-sm" name="marka" value="<?= $Samochod['marka']; ?>" size=12 required>
						<input type="text" class="form-control form-control-sm" name="model" value="<?= $Samochod['model']; ?>" size=12 required>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="produkcja" value="<?= $Samochod['produkcja']; ?>" size=6 required>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="stawka" value="<?= $Samochod['stawka']; ?>" size=4 required>
						<p>zł/h</p>
					</td>
					<td>
						<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" id="status-<?= $Samochod['id']; ?>" name="status" <?php if($Samochod['status'] == '1'){echo 'checked';} ?>>
							<label class="custom-control-label" for="status-<?= $Samochod['id']; ?>">Dostępność</label>
						</div>
					</td>
					<td>
						<span class="small">Miejscowość:</span> <input type="text" class="form-control form-control-sm" name="miejsce_krotko" value="<?= $Samochod['miejsce_krotko']; ?>" required>
						<span class="small">Pełen adres:</span> <textarea type="text" class="form-control form-control-sm" name="miejsce_dokladne" required><?= $Samochod['miejsce_dokladne']; ?></textarea>
					</td>
					<td>
						<input type="text" class="form-control form-control-sm" name="obrazek" value="<?= $Samochod['obrazek']; ?>" size=4 required>
						<hr class="p-3">
						<input type="submit" class="btn btn-info btn-sm" value="Zapisz dane pojazdu" size=8>
					</td>
				</form>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>