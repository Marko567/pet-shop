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
				<a href="/adminChangeGroup">Dodaj novu grupu</a>
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
			<table BORDER="1" WIDTH="100%" style="border-collapse: collapse;">
            <tr>
                <th> Ime</th>
                <th> E-mail</th>
                <th> Grad</th>
                <th> Telefon </th>
                <th> Vreme kreiranja naloga </th>
                <th>Izmeni</th>
                <th>Obrisi</th>
                <th>Oglasi</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td> {{ $user->name }}</td>
                <td> {{ $user->email }}</td>
                <td> {{ $user->city }}</td>
                <td> {{ $user->phone_number }}</td>
                <td> {{ $user->created_at }} </td>
                <td> <a href="adminEditUser/{{ $user->id }}"> Izmeni</a></td>
                <td> <a href="delete/{{ $user->id }}"> Obrisi</a></td>
                <td> <a href="/adminShowAds/{{ $user->id }}">Vidi</a></td>
            </tr>
            @endforeach
        </table>
		<div>
	</div>
	
</body>
</html>