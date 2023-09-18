<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/script.js"></script>
</head>
<body>
<header>
    <h1 style="color: lightgreen;">Registrazione obbligatoria prima di poter fare il LOGIN</h1>
</header>
<form action="registrazione2.php" method="POST">
<h2 style="padding: 10px; color: lightgreen; text-align: center; background-color: rgb(24, 92, 59); margin: 0; margin-bottom: 10%;">REGISTRATI</h2>
<div class="contenitoreAccesso">
    <b><label style="font-size: 14pt; font-style: bold; color: lightgreen;">Username:</label></b><input type="text" name="username" id="username" placeholder="inserire lo username"  required><br><br><br>  
    <b><label style="font-size: 14pt; font-style: bold; color: lightgreen;">Password:</label></b><input type="password" name="pwd" id="pwd" placeholder="inserire una password a scelta"  required ><br><br><br><br>
    <input type="submit" id="btnRegistrati" value="Registrati"><br><br><br>
  <p style="color: rgb(24, 92, 59);">Hai un account?<a href="index.html">Login</a></p>
</div>
</form>
<footer>

</footer>

</body>
</html>
