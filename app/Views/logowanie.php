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
	<div class="text-center">
		<h3>Logowanie</h3>
		<h4>do panelu zarządzania</h4>
		<form method="POST" action="/login" class="w-50" style="margin: 0 auto;">
			<div class="form-group">
				<label for="exampleInputEmail1">Login:</label>
				<input name="login" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Hasło:</label>
				<input name="haslo" type="password" class="form-control" aria-describedby="haselko" id="exampleInputPassword1" required>
				<small id="haselko" class="form-text text-muted">Nikomu nie zdradzaj swojego hasła!</small>
			</div>
			<?php if(@$_SESSION['error']){ ?>
			<div class="alert alert-warning" role="alert">
				<?= $_SESSION['error']; ?>
			</div>
			<?php } ?>
			<button type="submit" class="btn btn-primary">Zaloguj</button>
		</form>
	</div>
</div>