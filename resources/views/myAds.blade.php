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
	<div class="drop">
		<menu>
			<menuitem>
				<a>Zivotinje</a>

				<menu>
					<menuitem>
						<a href="">Psi</a>
					</menuitem>
					
					<menuitem>
						<a href="">Macke</a>
					</menuitem>
					
					<menuitem>
						<a href="">Kucne ptice</a>
					</menuitem>
					
					<menuitem>
						<a href="">Sitne zivotinje</a>
					</menuitem>

					<menuitem>
						<a href="">Ribice</a>
					</menuitem>
					
					<menuitem>
						<a href="">Egzoticne zivotinje</a>
					</menuitem>
				</menu>
			</menuitem>	
		</menu>
	</div>
	<!-- <div style="float: right; position: relative; width: 200px; right: 30px; bottom: 100px;">
		<ul style="list-style-type: none;">
			<li style="margin-right: 10px; padding-top: 10px; padding-bottom: 10px;">
				<a href="/">Poruke</a>
			</li>
			<li style="margin-right: 10px; padding-top: 10px; padding-bottom: 10px;">
				<a href="/">Obavestenja</a>
			</li>
			<li style="margin-right: 10px; padding-top: 10px; padding-bottom: 10px;">
				<a href="/">Ocene</a>
			</li>
			<li style="margin-right: 10px; padding-top: 10px; padding-bottom: 10px;">
				<a href="/">Pratim</a>
			</li>
		</ul>
	</div> -->
	<div class="sadrzaj">
		<h2 class="naslov">Moji oglasi</h2>
		
		<div class="oglasi">
			<!-- Oglasi logovanog korisnika --> 
			@if(isset($ads))
				<table class="tabela">
					<tr>
						<th>Slika</th>
						<th>Opis</th>
						<th>Tip oglasa</th>
						<th>Cena</th>
						<th>Izmeni</th>
						<th>Obrisi</th>
					</tr>
					@foreach($ads as $ad)
					<tr>
						<td class="pic-col">
							<h3> {{ $ad->name }} </h3>
							@if($ad->image_path != null)
								<img src="{{ asset('images/' . $ad->image_path) }}" alt="{{$ad->id . '-' . 'picture'}}" width="120" height="120">
							@endif
							
							@if($ad->image_path == null)
								<img src="{{ asset('images/noPicture.jpg') }}" alt="{{$ad->id . '-' . 'picture'}}" width="120" height="120">
							@endif
						</td>
						<td>
							<p> {!! $ad->description !!}</p>
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
							<!-- Izmeni -->
							<div class="change-dugme">
								<a href="/advertisementEdit/{{{ $ad->id }}}"><i class="far fa-edit"></i></a>
							</div>
						</td>
						<td>
							<form action="/myAds" method="POST">
								@csrf
								<input type="hidden" name="ad_id" value="{{ $ad->id }}">
								<div class="logout-dugme">
									<button class="delete-dugme" type="submit"><i class="far fa-trash-alt"></i></button>
								</div>
							</form>
						</td>
					</tr>
					@endforeach
				</table>
				@else
					<p>Nemas ni jedan oglas, <a>napravi svoj prvi oglas</a>.</p>
				@endif
		</div>
	</div>
	<div class="makeAd">
		<a href="/makeAd"><i class="fas fa-plus"></i></a>
	</div>
	<div class="pagination">
		{{ $ads->links() }}
	</div>
	
	<script src="https://kit.fontawesome.com/be0e439fc6.js" crossorigin="anonymous"></script>
</body>
</html>