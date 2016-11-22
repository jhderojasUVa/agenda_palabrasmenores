
<div class="container">
<div class="col-md-12">    
<?
if (isset($error)) {
  ?><span style="color:red;"><?echo$error?></span><?
}
?>
  </div>

  <div class="col-md-12">
    <form action="login" method="POST">
        <label for="usuario">Usuario</label><input type="text" name="usuario" id="usuario"><br/>
        <label for="password">Contraseña</label><input type="password" name="password" id="password"><br/>
        <input type="submit" value="acceder">
    </form>
  </div>
</div>

