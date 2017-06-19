<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to Congress</title>
	<link rel="stylesheet" type="text/css" href={{ asset('css/bootstrap.css') }}>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<style>
		html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color:#B3E5FC;
        }

        body {
            display: table;
        }

        .text {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            color:black;
            font-family: 'Raleway', sans-serif;
        }
        .login {
        	font-size: 1.5em;
			width: 10%;
			color:black;
			background-color:white;
        	padding-top: 1%;
			padding-bottom: 1%;
			border-radius: 0;
			border:2px solid black;
			transition: all .3s ease;
        }

        .login:hover {
			color:white;
			background-color:black;
			transition: all .3s ease;
        }
	</style>
</head>
<body>
	<div class="text">
		<h1>Welcome to Congress<br>The Contest Registration Website<br></h1>
		<a href="login" class="btn login">Login</a> <a href="register" class="btn login">Register</a>

	</div>
	<script type="text/javascript" href={{ asset('js/bootstrap.js') }}></script>
</body>
</html>