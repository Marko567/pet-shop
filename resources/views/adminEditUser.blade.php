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
		<div class="menu-form">
			<form action="/adminEditUser" method="post" class="admin-forma">
				@csrf
				<div class="reg">
					<label for="name">Ime: </label>
					<input type="text" name="name" id="name" value="{{ $user->name }}" class="box">
				</div>
				@error('name')
					<div class="upozorenje">
					{{ $message = "Ime mora imati manje od 255 karaktera!" }}
					</div>
				@enderror
				<br>
				<div class="reg">
					<label for="email">E-mail: </label>
					<input type="text" name="email" id="email" value="{{ $user->email }}" class="box">
				</div>
				@error('email')
					<div class="upozorenje">
					{{ $message = "E-mail mora biti jedinstven i validan!" }}
					</div>
				@enderror
				<br>
				<div class="reg">
					<label for="city">Mesto/Grad:</label>
					<input type="text" name="city" id="city" value="{{ $user->city }}" class="box">
				</div>
				@error('city')
					<div class="upozorenje">
					{{ $message = "Ime grada mora imati manje od 255 karaktera!" }}
					</div>
				@enderror
				<br>
				<div class="reg">
					<label for="phone_number">Broj telefona: </label>
					<input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number }}" class="box">
				</div>
				@error('phone_number')
					<div class="upozorenje">
					{{ $message = "Telefon mora imati izmedju 8 i 11 cifara!" }}
					</div>
				@enderror
				<br>
				<input type="hidden" name="user_id" value="{{$user->id}}">
				<div class="dugme">
				<input type="submit" value="Izmeni">
				</div>
			</form>
			@if(session('success'))
				<div>
					{{ session('success') }}
				</div>
			@endif
		</div>
	</div>
</body>
</html>