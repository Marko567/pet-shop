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
    <br>
    <div class="drop">
		<menu>
			<menuitem>
				<a>Zivotinje</a>

				<menu>
					<menuitem>
						<a href="/welcome/psi">Psi</a>
					</menuitem>
					
					<menuitem>
						<a href="/welcome/macke">Macke</a>
					</menuitem>
					
					<menuitem>
						<a href="/welcome/domace ptice">Kucne ptice</a>
					</menuitem>
					
					<menuitem>
						<a href="/welcome/sitne zivotinje">Sitne zivotinje</a>
					</menuitem>

					<menuitem>
						<a href="/welcome/ribice">Ribice</a>
					</menuitem>
					
					<menuitem>
						<a href="/welcome/egzoticne zivotinje">Egzoticne zivotinje</a>
					</menuitem>
				</menu>
			</menuitem>	
		</menu>
	</div>
	<div class="sadrzaj">
		<div class="oglasi">
			<table class="tabela">
					<tr>
						<th>Oglas</th>
						<th>Tip oglasa</th>
						<th>Cena</th>
						<th>Vlasnik oglasa</th>
						<th>Mesto/Grad</th>
						<th>Telefon</th>
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
								<!-- Ime korisnika koji je postavio oglas -->
								@foreach($users as $user)
									@if($user->id == $ad->user_id)
										{{ $user->name }}
									@endif
								@endforeach
							</td>
							<td>
								<!-- Grad korisnika koji je postavio oglas -->
								@foreach($users as $user)
									@if($user->id == $ad->user_id)
										{{ $user->city }}
									@endif
								@endforeach
							</td>
							<td>
								@foreach($users as $user)
									@if($user->id == $ad->user_id)
										{{ $user->phone_number }}
									@endif
								@endforeach
							</td>
						</tr>
					@endforeach
			</table>
			<div class="pagination">
				{{ $advertisements->links() }}
			</div>
		</div>
	</div>
</body>
</html>
