<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <title>petKP</title>
  
</head>
<body class="admin">
	<div class="admin-kontent">
		<h2 class="welcome">Stranica Administratora</h2>
		<ul  class="menu">
			<li>
				<a href="/adminView">Nazad</a>
			</li>
			<li>
			<a>
				<form action="/logout" method="post">
					@csrf
					<input type="submit" value="Izloguj se" class="admin-logout">
				</form>
			</a>
			</li>
		</ul>
		<div>
			<div class="menu-form">
				<h2>Izmeni oglas</h2>
				<form action="/adminAdEdit" method="POST" enctype="multipart/form-data" class="admin-forma">
					@csrf
					
					<input type="hidden" name="adId" value="{{ $ad_id }}">
					<div class="reg">
						<label for="name">Nov naziv oglasa: </label>
						<input type="text" name="name" id="name" class="box">
					</div>
					@error('name')
						<div class="upozorenje">
						{{ $message = "Max duzina naziva oglasa je 150" }}
						</div>
					@enderror
					<br>
					<div class="reg">
						<label for="adType">Nov tip oglasa: </label>
						<br>
						<input type="radio" id="sell" name="adType" value="sell">
						<label for="sell">Prodajem</label>
						<br>
						<input type="radio" id="offer" name="adType" value="offer">
						<label for="offer">Kupujem</label>
					</div>
					<br>
					<div class="reg">
						<label for="price">Cena: </label>
						<input type="text" name="price" id="price" class="box">
					</div>
					@error('price')
						<div class="upozorenje">
						{{ $message = "Vrednost ovog polja mora biti numericka!" }}
						</div>
					@enderror
					<br>
					<div class="reg">
						<label for="currency">Valuta: </label>
						<br>
						<label for="din.">Dinar </label>
						<input type="radio" name="currency" id="din." value="din.">
						<label for="€">Euro </label>
						<input type="radio" name="currency" id="€" value="€">
					</div>
					<br>
					<div class="reg">
						<label for="description">Opis oglasa: </label>
						<textarea name="description" id="description" rows="8" cols="50" class="box"></textarea>
					</div>
					@error('description')
						<div class="upozorenje">
						{{ $message = "Max duzina opisa oglasa je 1000" }}
						</div>
					@enderror
					<br>
					<div class="reg">
						<input type="file" name="image">
						@error('image')
							{{ $message = "Slika mora biti manja od 5MB, dozvoljeni formati su: .jpg, .png, .jpeg" }}
						@enderror
						<br>
					</div>
					<div class="dugme">
						<input type="submit" value="Izmeni">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>