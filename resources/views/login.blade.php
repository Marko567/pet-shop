<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <title>Uloguj se</title>
</head>
<body>
	<nav>
		<a href="/login">Uloguj se</a>

		<a href="/newest">Najnoviji</a>

		<a href="/register">Registruj se</a>
		<div class="animation start-home"></div>
	</nav>
    <div class="card">
        <form action="/login" method="post" class="forma">
            @csrf
			<p>Loguj se da pregledas svoje oglase:</p>
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
            @if(session()->has('status'))
            <div style="color: red; display: inline;">
                {{ session('status') }}
            </div>
            @endif
            <br>
			<div class="dugme">
				<input type="submit" value="Uloguj se">
			</div>
			<div class="forgot reg">
				<a href="/forgot-password">Zaboravljena lozinka ?</a>
			</div>
        </form>

    </div>
</body>
</html>