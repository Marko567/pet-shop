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
		<div class="admin-tabela">
			@if(!$advertisements->isEmpty())
				<table BORDER="1" WIDTH="100%" style="border-collapse: collapse;">
					<tr>
						<th>Oglas</th>
						<th>Tip oglasa</th>
						<th>Cena</th>
						<th>Izmeni</th>
						<th>Obrisi</th>
					</tr>
					@foreach($advertisements as $ad)
					<tr>
						<td class="pic-col">
							<h3> {{ $ad->name }} </h3>
							@if($ad->image_path != null)
								<img src="{{ asset('images/' . $ad->image_path) }}" alt="{{$ad->id . '-' . 'picture'}}" width="120" height="120">
							@endif
							
							@if($ad->image_path == null)
								<img src="{{ asset('images/noPicture.jpg') }}" alt="{{$ad->id . '-' . 'picture'}}" width="120" height="120">
							@endif
							
							<p> {{ $ad->description }}</p>
						</td>
						<td>
							@if($ad->adType == 'offer')
								<span> Kupujem </span>
							@endif
							@if($ad->adType == 'sell')
								<span> Prodajem </span>
							@endif
						</td>
						<td>
							{{ $ad->price . " " . $ad->currency}}
						</td>
						<td>
							<a href="/adminAdEdit/{{{ $ad->id }}}">Izmeni</a>
						</td>
						<td>
							<form action="/adminShowAds/{{$ad->user_id}}" method="POST">
								@csrf
								<input type="hidden" name="ad_id" value="{{ $ad->id }}">
								<input type="submit" value="Obrisi oglas">
							</form>
						</td>
					</tr>
					@endforeach
				</table>
			@endif
			@if($advertisements->isEmpty())
				<div>
					<h2>Korisnik trenutno nema oglasa za prikazivanje</h2>
				</div>
			@endif    
		</div>
	</div>
</body>
</html>