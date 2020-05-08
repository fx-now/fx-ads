<div class="row">
      <div class="col-md-12 col-12">
        <h2>
          An&uacute;ncie gratuitamente
        </h2>
<?
if($_POST["a"] == 1){
  $titulo = str($_POST["titulo"]);
  $descricao = str($_POST["descricao"]);
  $preco = str($_POST["preco"]);
  $categoria = str($_POST["categoria"]);
  if(empty($titulo) or empty($descricao) or empty($categoria)){
    ?>
     <div class="alert alert-primary" role="alert">Oops! Voc&ecirc; esqueceu de preencher um dos campos obrigat&oacute;rios: t&iacute;tulo, descri&ccedil;&atilde;o ou categoria.</div>
    <?
  }else{
    $upload = 1;
    if($_FILES["foto"]["name"] != ""){
      $target_dir = "upl/";
      $target_file = $target_dir . basename($_FILES["foto"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $check = getimagesize($_FILES["foto"]["tmp_name"]);
      if($check !== false) {
        if ($_FILES["foto"]["size"] > 10000000) { //10mb
            $msgerror = "Este &eacute; um arquivo muito grande (>10mb). Trate a imagem para que ela n&atilde;o demore tanto para carregar para os visitantes deste site.";
            $upload = 0;
        }else{
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $msgerror = "Imagens somente no formato JPG, JPEG, PNG & GIF.";
                $upload = 0;
            }else{
                $novoNomeImg = hash('sha512',$_FILES["foto"]["name"]).".$imageFileType";
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir.basename($novoNomeImg))) {
                    $upload = 1;
                } else {
                    $upload = 0; //informar suporte
                    $msgerror = "Tivemos um problema para enviar sua foto. Nosso suporte foi informado e em breve ser&aacute; resolvido. $imageFileType";
                    if(!is_dir($target_dir)){
                      $msgerror .= " N&atilde;o &eacute; um diret&oacute;rio v&aacute;lido.";
                    }
                    if(!is_writable($target_dir)){
                      $msgerror .= "N&atilde;o tem permiss&atilde;o de escrita.";
                    }
                }
            }
        }
      } else {
          $msgerror = "Esta foto n&atilde;o &eacute; um arquivo de imagem.";
          $upload = 0;
      }
    }
    
    if($upload == 1){
      $sel = sel("usuarios","usuario = '".str($_SESSION["login"])."'");
      $r = fetch($sel);
      if($r["nivel"] < 3){ $querystatus1 = ", status"; $querystatus2 = ", '1'"; $msgAdmin = " (como voc&ecirc; &eacute; o administrador, os an&uacute;ncios s&atilde;o publicados automaticamente)"; }
      $ins = ins("anuncios","idcidade, idusuario, titulo, descricao, foto, preco, categoria$querystatus1","'".str($_SESSION["idcidade"])."', '".str($r["id"])."', '$titulo', '$descricao', '$novoNomeImg', '$preco', '$categoria'$querystatus2");
      ?>
      <div class="alert alert-primary" role="alert">
        An&uacute;ncio aguardando modera&ccedil;&atilde;o! Em breve ser&aacute; publicado ;) <?= $msgAdmin ?>
      </div>
      <?
      unset($titulo,$descricao,$preco,$categoria);
    }else{
      ?>
        <div class="alert alert-primary" role="alert"><?= $msgerror ?></div>
      <?
    }
  }
}
?>
<form method="post" action="" id="formAds" enctype="multipart/form-data">
  <input type="hidden" name="a" value="1">
  <div class="form-group row">
    <label for="titulo" class="col-4 col-form-label">Título *</label> 
    <div class="col-8">
      <input id="titulo" name="titulo" placeholder="Título do seu anúncio" type="text" class="form-control" required="required" value="<?= $titulo ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="descricao" class="col-4 col-form-label">Descrição *</label> 
    <div class="col-8">
      <textarea id="descricao" name="descricao" cols="40" rows="5" class="form-control" aria-describedby="descricaoHelpBlock" required="required"><?= $descricao ?></textarea> 
      <span id="descricaoHelpBlock" class="form-text text-muted">Descreva seu anúncio</span>
    </div>
  </div>
  <div class="form-group row">
    <label for="titulo" class="col-4 col-form-label">Foto</label> 
    <div class="col-8">
      <input id="foto" name="foto" type="file" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="preco" class="col-4 col-form-label">Preço</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">R$</div>
        </div> 
        <input id="preco" name="preco" type="text" class="form-control" value="<?= $preco ?>"> 
        <div class="input-group-append">
          <div class="input-group-text">,00</div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="categoria" class="col-4 col-form-label">Categoria *</label> 
    <div class="col-8">
      <select id="categoria" name="categoria" class="custom-select">
        <?
        $selCat = sel("categorias","catmae <> 0","nome ASC");
        while($s = fetch($selCat)){
          ?>
        <option value="<?= $s["id"] ?>"<? if($categoria == $s["id"]){ echo " selected"; } if($categoria == "" && $_GET["cat"] == $s["id"]){ echo " selected"; } ?>><?= $s["nome"] ?> (<?= campo("categorias","nome",$s["catmae"]) ?>)</option>
          <?
        }
        ?>
      </select>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <?
      if(is_on() == false){
        echo "<a href='#' class='btn btn-secondary' style='cursor:not-allowed;'>Publicar (voc&ecirc; n&atilde;o est&aacute; logado)</a> <a href='?perfil' style='font-weight:bold'>Entrar</a>";
      }else{
        ?><button name="submit" type="submit" class="btn btn-primary">Publicar</button><?
      }
      ?>
    </div>
  </div>
</form>

<small>* campos obrigat&oacute;rios</small>
        
  </div>
  </div>