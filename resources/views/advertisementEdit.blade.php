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

				<a href="/myProfile">Moj nalog</a>
				<div class="animation start-home"></div>
	</nav>
	<h2 class="welcome">Izmeni oglas</h2>
    <div class="card-double-form">
        
        <form action="/advertisementEdit" method="POST" enctype="multipart/form-data" class="forma">
            @csrf
			<div class="double-form">
					<div class="form-left">
					<div class="reg">
						<input type="hidden" id="adId" name="adId" value="{{ $id }}">
						<label for="name">Nov naziv oglasa: </label>
						<input type="text" name="name" id="name" class="box">
						@error('name')
							<div class="upozorenje">
								{{ $message = "Max duzina naziva oglasa je 150" }}
							</div>
						@enderror
					</div>
					
					
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
						@error('price')
							<div class="upozorenje">
								{{ $message = "Vrednost ovog polja mora biti numericka!" }}
							</div>
						@enderror
					</div>
				</div>
				<br>
				<div class="form-right">
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
						<textarea name="description" id="description" rows="8" cols="50">
						</textarea>
						@error('description')
							{{ $message = "Max duzina opisa oglasa je 1000" }}
						@enderror
					</div>
					<br>
					<input type="file" name="image">
					@error('image')
						{{ $message = "Slika mora biti manja od 5MB, dozvoljeni formati su: .jpg, .png, .jpeg" }}
					@enderror
					<br>
				</div>
			</div>
			<div class="dugme">
				<input type="submit" value="Izmeni">
			</div>
        </form>
    </div>
</body>
</html>