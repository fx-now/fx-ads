<?
if(is_on() == false){
  if($_POST["a"] == 1){
    $usuario = str($_POST["usuario"]);
    $senha = hash("sha512",str($_POST["senha"]));
    $buscaUsr = sel("usuarios","usuario = '$usuario'");
    if(total($buscaUsr) > 0){
      login($usuario, $senha, "?perfil&u=$usuario");
      ?>
    <div class="alert alert-primary" role="alert">
      Entrando...
    </div>
      <?
    }else{
      ?>
    <div class="alert alert-primary" role="alert">
      Este usu&aacute;rio n&atilde;o existe!
    </div>
      <?
    }
  }
  ?>
        <h2>
          Entrar
        </h2>
        <form method="post" action="">
          <input type="hidden" name="a" value="1">
          <div class="form-group row">
            <label for="usuario" class="col-4 col-form-label" style="text-align: right">Usuário</label> 
            <div class="col-8">
              <input id="usuario" name="usuario" type="text" class="form-control" aria-describedby="usuarioHelpBlock" required="required"> 
              <span id="usuarioHelpBlock" class="form-text text-muted">Ex.: joaosilva</span>
            </div>
          </div>
          <div class="form-group row">
            <label for="senha" class="col-4 col-form-label" style="text-align: right">Senha</label> 
            <div class="col-8">
              <input id="senha" name="senha" type="password" class="form-control" required="required">
            </div>
          </div> 
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit" class="btn btn-primary">Entrar</button>
              <a href="?cadastrar" class="btn btn-success">Cadastrar</a>
            </div>
          </div>
        </form>
  <?
}else{
  if($_GET["u"] == ""){ echo "<meta http-equiv='refresh' content='0;URL=?home'>"; exit; }else{ $usuario = str($_GET["u"]); }
  $sel = sel("usuarios","usuario = '$usuario'");
  $r = fetch($sel);
  ?>
        <h2>
          <?= $r["usuario"] ?>
        </h2>
  <?
}