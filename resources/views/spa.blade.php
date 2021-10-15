<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Investor </title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <meta id="access"  content="{{  json_encode( session('access') !== null ) }}">
    <link id="swap" rel="stylesheet" href="">

</head>
<body>
    
    <div id="app">
        <app></app>
    </div>

<script src="{{ mix('js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/6765ee156c.js" crossorigin="anonymous"></script>
</body>
</html>