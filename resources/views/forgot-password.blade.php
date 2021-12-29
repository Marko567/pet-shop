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
        <form action="/forgot-password" method="post" class="forma">
            @csrf
            <p>Email tvog naloga:</p>
			<div class="reg">
				<label for="email">E-mail:</label>
				<input type="text" name="email" id="email" class="box">
			</div>
            <br>
            @error('email')
                <div class="upozorenje">
                    {{ $message = "Mail mora biti validan!"}}
                </div>
            @enderror
            <br>
			<div class="dugme">
				<input type="submit" value="Posalji">
			</div>
        </form>
        <br>
        @if(session()->has('status'))
            <div class="uspeh">
                {{ $message = "Link za resetovanje sifre uspesno poslat!" }}
            </div>
        @endif
    </div>
</body>
</html>