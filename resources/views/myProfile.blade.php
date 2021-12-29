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

				<a href="/myProfileEdit">Izmeni profil</a>
				<div class="animation start-home"></div>
	</nav>
    <div>
        <div>
            <h1 class="welcome">Moj profil</h1>
        </div>
        <div class="info">
            <table class="tabela">
                
                <tr>
                    <td> Ime: </td>
                    <td> {{ $user->name }} </td>
                </tr>
                <tr>
                    <td> E-mail: </td>
                    <td> {{ $user->email }} </td>
                </tr>
                <tr>
                    <td> Mesto/Grad: </td>
                    <td> {{ $user->city }}</td>
                </tr>
                <tr>
                    <td> Broj telefona: </td>
                    <td> {{ $user->phone_number }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>