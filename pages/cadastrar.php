<?
if(is_on() == false){
  if($_POST["a"] == 1){
    $usuario = str($_POST["usuario"]);
    $senha = hash("sha512",str($_POST["senha"]));
    $buscaUsr = sel("usuarios","usuario = '$usuario'");
    if(total($buscaUsr) > 0){
      ?>
    <div class="alert alert-primary" role="alert">
      Este usu&aacute;rio j&aacute; est&aacute; cadastrado!
    </div>
      <?
    }else{
      $ins = ins("usuarios","idcidade, usuario, senha","'".str($_SESSION["idcidade"])."', '$usuario', '$senha'");
      login($usuario, $senha, "?perfil");
      ?>
    <div class="alert alert-primary" role="alert">
      Voc&ecirc; est&aacute; cadastrado! Clique <a href="?perfil">aqui</a> para entrar.
    </div>
      <?
    }
  }
  ?>
        <h2>
          Cadastrar
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
              <button name="submit" type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </div>
        </form>
  <?
}else{
  ?>
        <meta http-equiv="refresh" content="0;URL=?perfil">
  <?
}