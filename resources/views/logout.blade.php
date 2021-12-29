<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uloguj se</title>
</head>
<body>
    <div>
        <form action="/login" method="post">
            @csrf
            <label for="email">E-mail: </label>
            <input type="text" name="email" id="email" placeholder="Vas email..." value="{{ old('email')}}">
            @error('email')
                <div>
                    {{ $message = "Email mora biti unet i validan!" }}
                </div>
            @enderror
            <br>
            <label for="password">Lozinka: </label>
            <input type="password" name="password" id="password" placeholder="Vasa lozinka...">
            @error('password')
                <div>
                    {{ $message = "Lozinka mora biti uneta!" }}
                </div>
            @enderror
            <br>
            @if(session()->has('status'))
            <div style="color: red; display: inline;">
                {{ session('status') }}
            </div>
            @endif
            <input type="submit" value="Uloguj se">
        </form>
    </div>
</body>
</html>