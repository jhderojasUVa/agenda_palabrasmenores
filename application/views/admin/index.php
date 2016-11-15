<!DOCTYPE html>
<html lang="es">
<head>
  <title>Entrada al gestor</title>
  <!-- Estilos -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/resources/css/estilos.css" />
  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?
if (isset($error)) {
  ?><span style="color:red;"><?echo$error?></span><?
}
?>
<div class="container">
  <div class="col-md-12">
    <form action="login" method="POST">
        <label for="usuario">Usuario</label><input type="text" name="usuario" id="usuario" required=""><br/>
        <label for="password">Contraseña</label><input type="password" name="password" id="password" required=""><br/>
        <input type="submit" value="acceder">
    </form>
  </div>
</div>
</body>
</html>
