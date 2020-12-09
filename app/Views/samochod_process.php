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
	<h2 class="text-center"><?= $Samochod['marka']; ?> <?= $Samochod['model']; ?></h2>
	<h3 class="text-center">Rezerwacja pojazdu</h3>
	<hr class="my-2" />
	<form action="/wypozycz" method="POST">
		<input type="hidden" name="etapII" value="true" />
		<input type="hidden" name="id" value="<?= $Samochod['id']; ?>" />
		<table class="table">
			<tbody>
				<tr>
					<td>Marka</td>
					<td><input type="text" name="marka" value="<?= $Samochod['marka']; ?>" readonly class="w-100"></td>
				</tr>
				<tr>
					<td>Model</td>
					<td><input type="text" name="model" value="<?= $Samochod['model']; ?>" readonly class="w-100"></td>
				</tr>
				<tr>
					<td>Rok produkcji</td>
					<td><input type="text" name="produkcja" value="<?= $Samochod['produkcja']; ?>" readonly class="w-100"></td>
				</tr>
				<tr>
					<td>Czas wypożyczenia</td>
					<td><input type="text" name="czas" value="<?= $Czas; ?> h" readonly class="w-100"></td>
				</tr>
				<tr>
					<td>Koszt</td>
					<td><input type="text" name="koszt" value="<?= $Koszt; ?> zł (łącznie)" readonly class="w-100"></td>
				</tr>
				<tr>
					<td>Imię</td>
					<td><input type="text" name="imie" placeholder="Wpisz swoje imię..." required class="w-100"</td>
				</tr>
				<tr>
					<td>Adres email</td>
					<td><input type="email" name="email" placeholder="Podaj adres email..." required class="w-100"></td>
				</tr>
				<tr>
					<td>Lokalizacja pojazdu</td>
					<td class="small">Jestem świadomy, że pojazd znajduje się aktualnie pod tym adresem:<br />
						<i><?= $Samochod['miejsce_dokladne']; ?></i><br />
						oraz oświadczam, że dostanę się do niego we własnym zakresie, na swój koszt.</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" class="btn btn-success w-100" value="Rezerwuj!" />
					</td>
				</tr>
				</tr>
			</tbody>
		</table>
	</form>
</div>