<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <title>petKP</title>
</head>
<body>
	<nav>
		<a href="/logout">
					<form action="/logout" method="post">
						@csrf
						<button type="submit" class="logout-dugme">IZLOGUJ SE</button>
					</form>
				</a>
				<a href="/myAds">Moji oglasi</a>

				<a href="/myProfile">Nazad na profil</a>
				<div class="animation start-home"></div>
	</nav>
    <h2 class="welcome">Izmeni profil </h2>
	<div class="card">
		<form action="/myProfileEdit" method="post" class="forma">
			@csrf
			<br>
			<div class="reg">
				<label for="name">Novo ime: </label>
				<input type="text" name="name" id="name" class="box">
			</div>
			@error('name')
				<div class="upozorenje">
				{{ $message = "Ime mora imati manje od 255 karaktera!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="email">Nov E-mail: </label>
				<input type="text" name="email" id="email" class="box">
			</div>
			@error('email')
				<div class="upozorenje">
				{{ $message = "E-mail mora biti jedinstven i validan!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="city">Novo Mesto/Grad</label>
				<input type="text" name="city" id="city" class="box">
			</div>
			@error('city')
				<div class="upozorenje">
				{{ $message = "Ime grada mora imati manje od 255 karaktera!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="phone_number">Nov broj telefona: </label>
				<input type="text" name="phone_number" id="phone_number" class="box">
			</div>
			@error('phone_number')
				<div class="upozorenje">
				{{ $message = "Telefon mora imati izmedju 8 i 11 cifara!" }}
				</div>
			@enderror
			<br>
			<div class="dugme">
			<input type="submit" value="Izmeni">
			</div>
		</form>
	</div>
</body>
</html>