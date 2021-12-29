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
    <div class="card-double-form">
        <form action="/makeAd" method="POST" enctype="multipart/form-data" class="forma">
            @csrf
			<div class="double-form">
				<div class="form-left">
					<div class="reg">
						<label for="name">Naziv oglasa: </label>
						<input type="text" name="name" id="name" class="box">
					</div>
					<br>
					<div class="reg">
						<label for="category">Izaberite kategoriju: </label>
						<select name="category" id="category" class="selectcategory">
							<option value="0" disabled="true" selected="true">-Izaberi kategoriju-</option>
							@foreach ($categories as $category)
								echo "<option value="{{ $category->id }}">{{ $category->name }}</option>";
							@endforeach
						</select>
					</div>
					<br>
					<div class="reg">
						<label for="group">Grupa: </label>
						<select name="group" id="group" class="group">
							<option value="0" disabled="true" selected="true">-Grupa-</option>
						</select>
					</div>
					<br>
					<div class="reg">
						<input type="radio" id="sell" name="adType" value="sell">
						<label for="sell">Prodajem</label>
						<br>
						<input type="radio" id="offer" name="adType" value="offer">
						<label for="offer">Kupujem</label>
					</div>
				</div>
				<br>
				<div class="form-right">
					<div class ="reg">
						<label for="price">Cena: </label>
						<input type="text" name="price" id="price" class="box">
					</div>
					<br>
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
						<textarea name="description" id="description" rows="8" cols="50" class="text-area">
						</textarea>
					</div>
					<br>
					<div class="reg">
						<input type="file" name="image">	
					</div>
				</div>
				
			</div>
			<div class="dugme">
			<input type="submit" value="Postavi">
			</div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change','.selectcategory', function() {

                var cat_id = $(this).val();
                var div = $(this).parent();

                var op=" ";

                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('findGroupName')!!}',
                    data: {'id':cat_id},
                    success: function(data) {
                        op += '<option value=0 selected disabled>-Izaberi grupu-</option>';
                        for(var i = 0; i < data.length; i++) {
                            op += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                        }
                        div.find('.group').html(" ");
                        div.find('.group').append(op);
                    },
                    error:function() {

                    }
                });
            })
        });
    </script>
</body>
</html>