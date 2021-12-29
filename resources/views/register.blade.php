<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <title>Registruj se</title>
</head>
<body>
	<nav>
		<a href="/login">Uloguj se</a>

		<a href="/newest">Najnoviji</a>

		<a href="/register">Registruj se</a>
		<div class="animation start-home"></div>
	</nav>
	<div class="card">
		<form action="/register" method="post" class="forma">
			@csrf
			<div class="reg">
				<label for="name">Ime: </label>
				<input type="text" name="name" id="name" placeholder="Vase ime..." value="{{ old('name')}}" class="box">
			</div>
			@error('name')
				<div class="upozorenje">
					{{ $message = "Ime mora biti uneto i imati manje od 255 karaktera!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="city">Grad: </label>
				<input type="text" name="city" id="city" placeholder="Grad..." value="{{ old('city')}}" class="box">
			</div>
			@error('city')
				<div class="upozorenje">
					{{ $message = "Grad mora biti unet i imati manje od 255 karaktera!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="phone_number">Broj telefona: </label>
				<input type="text" name="phone_number" id="phone_number" placeholder="Broj telefona..." value="{{ old('phone_number')}}" class="box">
			</div>
			@error('phone_number')
				<div class="upozorenje">
					{{ $message = "Broj mora biti unet i imati izmedju 8 i 11 karaktera!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="email">E-mail: </label>
				<input type="text" name="email" id="email" placeholder="Vas email..." value="{{ old('email')}}" class="box">
			</div>
			@error('email')
				<div class="upozorenje">
					{{ $message = "Email mora biti unet i validan!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="password">Lozinka: </label>
				<input type="password" name="password" id="password" placeholder="Vasa lozinka..." class="box">
			</div>
			@error('password')
				<div class="upozorenje">
					{{ $message = "Lozinka mora biti uneta!" }}
				</div>
			@enderror
			<br>
			<div class="reg">
				<label for="password_confirmation">Ponovite lozinku: </label>
				<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Vasa loznika..." class="box">
			</div>
			@error('password_confirmation')
				<div class="upozorenje">
					{{ $message = "Neispravna ponovljena lozinka!" }}
				</div>
			@enderror
			<br>
			<div class="dugme">
				<input type="submit" value="Registruj se!">
			</div>
		</form>
	</div>
</body>
</html>