<!DOCTYPE html>
<html lang="es">
<head>
  <title>Entrada al gestor</title>
</head>
<body>
<?
if (isset($error)) {
  ?><span style="color:red;">LA HAS CAGAO, USUARIO o COTNRASÑEA MAL</span><?
}
?>
<form action="/admin/index/index" method="POST">
<input type="text" name="usuario"><br/>
<input type="password" name="password"><br/>
<input type="submit" value="enviar">
</form>
</body>
</html>
