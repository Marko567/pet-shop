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
		<a href="/login">Uloguj se</a>

		<a href="/newest">Najnoviji</a>

		<a href="/register">Registruj se</a>
		<div class="animation start-home"></div>
	</nav>
    <div class="card">
        <form action="/reset-password" method="post" class="forma">
            @csrf
			<div class="reg">
				<label for="email">E-mail: </label> 
				<input type="text" name="email" id="email" placeholder="Vas email..." value="{{ old('email')}}" class="box">
			</div>
            <br>
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
            <br>
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
            <br>
            @if(session('error'))
                <div class="upozorenje">
                    {{ session('error') }}
                </div>
            @endif
            <br>
            <input type="hidden" name="token" value="{{ $token }}">
			<div class="dugme">
				<input type="submit" value="Registruj se!">
			</div>
        </form>
    </div>
</body>
</html>