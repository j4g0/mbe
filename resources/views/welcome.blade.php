<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>Laravel</title>

    </head>
    <body>
      <div id="app"></div>
        
      <script src="{{ asset('js/app.js') }}"></script>
      <!-- Icons -->
			<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
			<script>
				feather.replace()
			</script>
    </body>
</html>
