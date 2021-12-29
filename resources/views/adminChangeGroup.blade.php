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
			<h3>Unesi novu grupu: </h3>
			<br>
			<form action="/adminView2" method="post" class="admin-forma">
				@csrf
				<div class="reg">
					<label for="category_name">Ime kategorije: </label>
					
					<select name="category_id" id="category_id">
						<option value="0" disabled="true" selected="true">-Izaberi kategoriju-</option>
						@foreach ($categories as $category)
							echo "<option value="{{ $category->id }}">{{ $category->name }}</option>";
						@endforeach
					</select>
				</div>
				<br>
				@error('category_name')
					<div class="upozorenje">
						{{ $message = "Morate odabrati kategoriju!" }}
					</div>
				@enderror
				<br>
				<div class="reg">
					<label for="group_name">Ime nove grupe: </label>
					<input type="text" name="group_name" id="group_name" placeholder="Ime nove grupe..." class="box">
				</div>
				<br>
				@error('group_name')
					<div class="upozorenje">
						{{ $message = "Uneta grupa vec postoji!" }}
					</div>
				@enderror
				<br>
				<div class="dugme">
					<input type="submit" value="Dodaj novu grupu">
				</div>
				<br>
				@if(session('success'))
					<div class="uspeh">
						{{ session('success') }}
					</div>
				@endif
			</form>
		</div>
	</div>
</body>
</html>