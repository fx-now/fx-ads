<?
$sel = sel("cidades","id = '".str($_SESSION["idcidade"])."'");
$k = fetch($sel);

$idAd = str($_GET["i"]);
$selAd = sel("anuncios","id = '$idAd'");
$y = fetch($selAd);

if(is_on() == true){
  $selUsr = sel("usuarios","usuario = '".$_SESSION["login"]."'");
  $v = fetch($selUsr);

  //verifica se é dono do anúncio ou administrador
  if($v["nivel"] < 3){
    if($v["id"] == $y["idusuario"] or $v["nivel"] == 1){
      if($_POST["a"] == 1){ 
        $pagarpor = str($_POST["pagarpor"]);
        $saldo = $v["anunciospagos"]-$v["anunciosusados"];
        if($pagarpor > $saldo){
          ?>
          <div class="alert alert-secondary" role="alert">Voc&ecirc; n&atilde;o tem saldo (<?= $saldo ?> an&uacute;ncios restantes) para publicar este an&uacute;ncio por <?= $pagarpor ?> meses.</div>
          <? 
        }else{
          $idAd = str($_POST["idad"]);
          if($idAd != ""){
            if($v["id"] != $y["idusuario"] && $v["nivel"] != 1){
              echo "<p>Voc&ecirc; precisa ser dono deste an&uacute;ncio ou administrador desta cidade no site para fazer um upgrade no an&uacute;ncio.</p>";
              exit;
            }
          }else{
            $chave = hash('sha512',date("Y-m-d H:i:s").$titulo.$descricao);
            $ins = ins("anuncios","chave, idcidade, idusuario","'$chave', '".$_SESSION["idcidade"]."', '".$v["id"]."'");
            $selAdId = sel("anuncios","chave = '$chave'");
            $o = fetch($selAdId);
            $idAd = $o["id"];
            $upd = upd("anuncios","chave = ''",$idAd);
          }
          //basico
          $titulo = str($_POST["titulo"]);
          $descricao = str($_POST["descricao"]);
          $preco = str($_POST["preco"]);
          $categoria = str($_POST["categoria"]);
          //fotos
          if($_FILES["fotodestaque"]["name"] != ""){
            $target_dir = "upl/";
            $target_file = $target_dir . basename($_FILES["fotodestaque"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fotodestaque"]["tmp_name"]);
            if($check !== false) {
              if ($_FILES["fotodestaque"]["size"] > 10000000) { //10mb
                  $msgerror = "Este &eacute; um arquivo muito grande (>10mb). Trate a imagem para que ela n&atilde;o demore tanto para carregar para os visitantes deste site.";
                  $upload = 0;
              }else{
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                      $msgerror = "Imagens somente no formato JPG, JPEG, PNG & GIF.";
                      $upload = 0;
                  }else{
                      $novoNomeImg = hash('sha512',$_FILES["fotodestaque"]["name"]).".$imageFileType";
                      if (move_uploaded_file($_FILES["fotodestaque"]["tmp_name"], $target_dir.basename($novoNomeImg))) {
                          $upd = upd("anuncios","foto = '$novoNomeImg'",$idAd);
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
          if($_FILES["foto2"]["name"] != ""){
            $target_dir = "upl/";
            $target_file = $target_dir . basename($_FILES["foto2"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["foto2"]["tmp_name"]);
            if($check !== false) {
              if ($_FILES["foto2"]["size"] > 10000000) { //10mb
                  $msgerror = "Este &eacute; um arquivo muito grande (>10mb). Trate a imagem para que ela n&atilde;o demore tanto para carregar para os visitantes deste site.";
                  $upload = 0;
              }else{
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                      $msgerror = "Imagens somente no formato JPG, JPEG, PNG & GIF.";
                      $upload = 0;
                  }else{
                      $novoNomeImg = hash('sha512',$_FILES["foto2"]["name"]).".$imageFileType";
                      if (move_uploaded_file($_FILES["foto2"]["tmp_name"], $target_dir.basename($novoNomeImg))) {
                          $upd = upd("anuncios","foto2 = '$novoNomeImg'",$idAd);
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
          if($_FILES["foto3"]["name"] != ""){
            $target_dir = "upl/";
            $target_file = $target_dir . basename($_FILES["foto3"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["foto3"]["tmp_name"]);
            if($check !== false) {
              if ($_FILES["foto3"]["size"] > 10000000) { //10mb
                  $msgerror = "Este &eacute; um arquivo muito grande (>10mb). Trate a imagem para que ela n&atilde;o demore tanto para carregar para os visitantes deste site.";
                  $upload = 0;
              }else{
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                      $msgerror = "Imagens somente no formato JPG, JPEG, PNG & GIF.";
                      $upload = 0;
                  }else{
                      $novoNomeImg = hash('sha512',$_FILES["foto3"]["name"]).".$imageFileType";
                      if (move_uploaded_file($_FILES["foto3"]["tmp_name"], $target_dir.basename($novoNomeImg))) {
                          $upd = upd("anuncios","foto3 = '$novoNomeImg'",$idAd);
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
          if($_FILES["foto4"]["name"] != ""){
            $target_dir = "upl/";
            $target_file = $target_dir . basename($_FILES["foto4"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["foto4"]["tmp_name"]);
            if($check !== false) {
              if ($_FILES["foto4"]["size"] > 10000000) { //10mb
                  $msgerror = "Este &eacute; um arquivo muito grande (>10mb). Trate a imagem para que ela n&atilde;o demore tanto para carregar para os visitantes deste site.";
                  $upload = 0;
              }else{
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                      $msgerror = "Imagens somente no formato JPG, JPEG, PNG & GIF.";
                      $upload = 0;
                  }else{
                      $novoNomeImg = hash('sha512',$_FILES["foto4"]["name"]).".$imageFileType";
                      if (move_uploaded_file($_FILES["foto4"]["tmp_name"], $target_dir.basename($novoNomeImg))) {
                          $upd = upd("anuncios","foto4 = '$novoNomeImg'",$idAd);
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
          if($_FILES["foto5"]["name"] != ""){
            $target_dir = "upl/";
            $target_file = $target_dir . basename($_FILES["foto5"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["foto5"]["tmp_name"]);
            if($check !== false) {
              if ($_FILES["foto5"]["size"] > 10000000) { //10mb
                  $msgerror = "Este &eacute; um arquivo muito grande (>10mb). Trate a imagem para que ela n&atilde;o demore tanto para carregar para os visitantes deste site.";
                  $upload = 0;
              }else{
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                      $msgerror = "Imagens somente no formato JPG, JPEG, PNG & GIF.";
                      $upload = 0;
                  }else{
                      $novoNomeImg = hash('sha512',$_FILES["foto5"]["name"]).".$imageFileType";
                      if (move_uploaded_file($_FILES["foto5"]["tmp_name"], $target_dir.basename($novoNomeImg))) {
                          $upd = upd("anuncios","foto5 = '$novoNomeImg'",$idAd);
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
          //expediente
          $seg1 = str($_POST["seg1"]);
          $seg2 = str($_POST["seg2"]);
          $seg3 = str($_POST["seg3"]);
          $seg4 = str($_POST["seg4"]);

          $ter1 = str($_POST["ter1"]);
          $ter2 = str($_POST["ter2"]);
          $ter3 = str($_POST["ter3"]);
          $ter4 = str($_POST["ter4"]);

          $qua1 = str($_POST["qua1"]);
          $qua2 = str($_POST["qua2"]);
          $qua3 = str($_POST["qua3"]);
          $qua4 = str($_POST["qua4"]);

          $qui1 = str($_POST["qui1"]);
          $qui2 = str($_POST["qui2"]);
          $qui3 = str($_POST["qui3"]);
          $qui4 = str($_POST["qui4"]);

          $sex1 = str($_POST["sex1"]);
          $sex2 = str($_POST["sex2"]);
          $sex3 = str($_POST["sex3"]);
          $sex4 = str($_POST["sex4"]);

          $sab1 = str($_POST["sab1"]);
          $sab2 = str($_POST["sab2"]);
          $sab3 = str($_POST["sab3"]);
          $sab4 = str($_POST["sab4"]);

          $dom1 = str($_POST["dom1"]);
          $dom2 = str($_POST["dom2"]);
          $dom3 = str($_POST["dom3"]);
          $dom4 = str($_POST["dom4"]);

          //contato
          $telefone = str($_POST["telefone"]);
          $whatsapp = str($_POST["whatsapp"]);
          $email = str($_POST["email"]);
          $facebook = str($_POST["facebook"]);
          $twitter = str($_POST["twitter"]);
          $instagram = str($_POST["instagram"]);

          //finalizando

          $gmaps = str($_POST["gmaps"]);
          $teleentrega = str($_POST["teleentrega"]);
          $teleentregagratis = str($_POST["teleentregagratis"]);

          //atualiza banco
          $upd = upd("anuncios","titulo = '$titulo', descricao = '$descricao', preco = '$preco', categoria = '$categoria', plano = 1, dataexpira = '".date("Y-m-d",strtotime("+ $pagarpor month"))."', telefone = '$telefone', whatsapp = '$whatsapp', email = '$email', facebook = '$facebook', twitter = '$twitter', instagram = '$instagram', gmaps = '$gmaps', teleentrega = '$teleentrega', teleentregagratis = '$teleentregagratis', seg1 = '$seg1', seg2 = '$seg2', seg3 = '$seg3', seg4 = '$seg4', ter1 = '$ter1', ter2 = '$ter2', ter3 = '$ter3', ter4 = '$ter4', qua1 = '$qua1', qua2 = '$qua2', qua3 = '$qua3', qua4 = '$qua4', qui1 = '$qui1', qui2 = '$qui2', qui3 = '$qui3', qui4 = '$qui4', sex1 = '$sex1', sex2 = '$sex2', sex3 = '$sex3', sex4 = '$sex4', sab1 = '$sab1', sab2 = '$sab2', sab3 = '$sab3', sab4 = '$sab4', dom1 = '$dom1', dom2 = '$dom2', dom3 = '$dom3', dom4 = '$dom4'",$idAd);

          $upd = upd("usuarios","anunciosusados=anunciosusados+1",$v["id"]);
          ?>
          <div class="alert alert-secondary" role="alert">An&uacute;ncio publicado!</div>
          <? 
        }
      }
    }
  }
}
    ?>
            <h2>
              Destaque seu an&uacute;ncio!
            </h2>
            <p>
              Destacando seu an&uacute;ncio ele aparecer&aacute; sempre no topo das pesquisas, al&eacute;m de poder acrescentar mais fotos, telefone, Whatsapp e redes sociais!
            </p>


<?
  if(is_on() == true){
  if($v["anunciospagos"]-$v["anunciosusados"] > 0){
  ?>
    <a name="form"></a>
    <br><br>
    <form method="post" action="?upgrade" enctype="multipart/form-data">
      <input type="hidden" value="1" name="a">
      <input type="hidden" value="<?= $idAd ?>" name="idad">
      <h3>
        Administrador &raquo; Destaque
      </h3>
      <br>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#basico">B&aacute;sico</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#fotos">Fotos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#expediente">Expedi&ecirc;nte</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#contato">Contato</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#finalizando">Finalizando</a>
      </li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade show active" id="basico">
        <div class="form-group">
          <label class="col-form-label" for="titulo">T&iacute;tulo</label>
          <input type="text" class="form-control" placeholder="T&iacute;tulo do seu an&uacute;ncio ou com&eacute;rcio" name="titulo" value="<?= $y["titulo"] ?>">
        </div>
        <div class="form-group">
          <label for="descricao">Descri&ccedil;&atilde;o</label>
          <textarea class="form-control" name="descricao" rows="3"><?= $y["descricao"] ?></textarea>
        </div>
        <div class="form-group">
          <label class="control-label" for="preco">Preço</label>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">R$ </span>
              </div>
              <input type="text" class="form-control" name="preco" value="<?= $y["preco"] ?>">
              <div class="input-group-append">
                <span class="input-group-text">,00</span>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="exampleSelect1">Categoria</label>
          <select class="form-control" name="categoria">
            <?
            $selCat = sel("categorias","catmae <> 0","nome ASC");
            while($s = fetch($selCat)){
              ?>
            <option value="<?= $s["id"] ?>"<? if($y["categoria"] == $s["id"]){ echo " selected"; } ?>><?= $s["nome"] ?> (<?= campo("categorias","nome",$s["catmae"]) ?>)</option>
              <?
            }
            ?>
          </select>
        </div>
      </div>
      <div class="tab-pane fade" id="fotos">
        <div class="form-group">
          <label class="col-form-label" for="fotodestaque">Foto destaque</label>
          <input type="file" class="form-control" name="fotodestaque"><?
          if($y["foto"] != ""){
            $foto = im("upl/".$y["foto"],100,100); 
            echo "<p>Imagem atual: <br><img src='$foto' class='img-thumbnail'></p>";
          }
          ?>
        </div>
        <div class="form-group">
          <label class="col-form-label" for="foto2">Foto extra</label>
          <input type="file" class="form-control" name="foto2"><?
          if($y["foto2"] != ""){
            $foto = im("upl/".$y["foto2"],100,100); 
            echo "<p>Imagem atual: <br><img src='$foto' class='img-thumbnail'></p>";
          }
          ?>
        </div>
        <div class="form-group">
          <label class="col-form-label" for="foto3">Foto extra</label>
          <input type="file" class="form-control" name="foto3"><?
          if($y["foto3"] != ""){
            $foto = im("upl/".$y["foto3"],100,100); 
            echo "<p>Imagem atual: <br><img src='$foto' class='img-thumbnail'></p>";
          }
          ?>
        </div>
        <div class="form-group">
          <label class="col-form-label" for="foto4">Foto extra</label>
          <input type="file" class="form-control" name="foto4"><?
          if($y["foto4"] != ""){
            $foto = im("upl/".$y["foto4"],100,100); 
            echo "<p>Imagem atual: <br><img src='$foto' class='img-thumbnail'></p>";
          }
          ?>
        </div>
        <div class="form-group">
          <label class="col-form-label" for="foto5">Foto extra</label>
          <input type="file" class="form-control" name="foto5"><?
          if($y["foto5"] != ""){
            $foto = im("upl/".$y["foto5"],100,100); 
            echo "<p>Imagem atual: <br><img src='$foto' class='img-thumbnail'></p>";
          }
          ?>
        </div>
      </div>


      <div class="tab-pane fade" id="expediente">
        <div class="row">
          <div class="col-4">
            Segunda-feira
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="seg1" value="<?= $y["seg1"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="seg2" value="<?= $y["seg2"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="seg3" value="<?= $y["seg3"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="seg4" value="<?= $y["seg4"] ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Ter&ccedil;-feira
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="ter1" value="<?= $y["ter1"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="ter2" value="<?= $y["ter2"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="ter3" value="<?= $y["ter3"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="ter4" value="<?= $y["ter4"] ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Quarta-feira
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qua1" value="<?= $y["qua1"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qua2" value="<?= $y["qua2"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qua3" value="<?= $y["qua3"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qua4" value="<?= $y["qua4"] ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Quinta-feira
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qui1" value="<?= $y["qui1"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qui2" value="<?= $y["qui2"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qui3" value="<?= $y["qui3"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="qui4" value="<?= $y["qui4"] ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Sexta-feira
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sex1" value="<?= $y["sex1"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sex2" value="<?= $y["sex2"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sex3" value="<?= $y["sex3"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sex4" value="<?= $y["sex4"] ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            S&aacute;bado
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sab1" value="<?= $y["sab1"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sab2" value="<?= $y["sab2"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sab3" value="<?= $y["sab3"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="sab4" value="<?= $y["sab4"] ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-4">
           Domingo
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="dom1" value="<?= $y["dom1"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="dom2" value="<?= $y["dom2"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="dom3" value="<?= $y["dom3"] ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="dom4" value="<?= $y["dom4"] ?>">
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="contato">
        <div class="form-group">
          <label class="col-form-label" for="inputDefault">Telefone</label>
          <input type="tel" class="form-control" name="telefone" value="<?= $y["telefone"] ?>">
        </div>
        <div class="form-group">
          <label class="col-form-label" for="inputDefault">WhatsApp</label>
          <input type="tel" class="form-control" name="whatsapp" value="<?= $y["whatsapp"] ?>">
        </div>

        <div class="form-group">
          <label class="col-form-label" for="inputDefault">E-mail</label>
          <input type="email" class="form-control" name="email" value="<?= $y["email"] ?>">
        </div>


        <div class="form-group">
          <label class="control-label">Facebook</label>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">facebook.com/</span>
              </div>
              <input type="text" class="form-control" name="facebook" value="<?= $y["facebook"] ?>">
            </div>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label">Twitter</label>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">twitter.com/</span>
              </div>
              <input type="text" class="form-control" name="twitter" value="<?= $y["twitter"] ?>">
            </div>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label">Instagram</label>
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">instagram.com/</span>
              </div>
              <input type="text" class="form-control" name="instagram" value="<?= $y["instagram"] ?>">
            </div>
          </div>
        </div>

      </div>
      <div class="tab-pane fade" id="finalizando">
        <div class="form-group">
          <label for="pagarpor">Pagar por </label>
          <select class="form-control" name="pagarpor">
            <option value="1">1 m&ecirc;s</option>
            <option value="2">2 meses</option>
            <option value="3">3 meses</option>
            <option value="4">4 meses</option>
            <option value="5">5 meses</option>
            <option value="6">6 meses</option>
            <option value="12">12 meses</option>
          </select>
        </div>

        <div class="form-group">
          <label class="col-form-label" for="inputDefault">Link para Google Maps</label>
          <input type="text" class="form-control" name="gmaps" value="<?= $y["gmaps"] ?>">
        </div>

        <div class="form-group">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="teleentrega" name="teleentrega" value="1"<? if($y["teleentrega"] == 1){ echo " checked"; } ?>>
            <label class="custom-control-label" for="teleentrega">Tem tele-entrega</label>
          </div>
        </div>

        <div class="form-group">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="teleentregagratis" name="teleentregagratis" value="1"<? if($y["teleentregagratis"] == 1){ echo " checked"; } ?>>
            <label class="custom-control-label" for="teleentregagratis">Tele-entrega gr&aacute;tis</label>
          </div>
        </div>
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="assinar"></label>
      <div class="col-md-4">
        <button id="assinar" name="assinar" class="btn btn-primary">Salvar</button>
      </div>
    </div>
    </form>
<? 
  }else{
?>    
<div class="alert alert-secondary" role="alert">Voc&ecirc; tem <?= $v["anunciospagos"]-$v["anunciosusados"] ?> an&uacute;ncios pagos de saldo para usar.</div>
<div class="row">
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-c47d32f1-c030-4508-897d-f04a651b1175" class="btn btn-primary col-sm-6" target="_blank">+ 10 an&uacute;ncios<br>R$ 10<br>R$ 1 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-e8aa1cdb-4af0-4aa4-95c4-1f3172e53a1e" class="btn btn-primary col-sm-6" target="_blank">+ 20 an&uacute;ncios<br>R$ 18 (10% off)<br>R$ 0,90 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-d7f50811-1a46-4ef0-9a3b-d62cb1d91c19" class="btn btn-primary col-sm-6" target="_blank">+ 30 an&uacute;ncios<br>R$ 25,50 (15% off)<br>R$ 0,85 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-d5c816f4-f731-44f9-aabd-0170c0e56f46" class="btn btn-primary col-sm-6" target="_blank">+ 50 an&uacute;ncios<br>R$ 40 (20% off)<br>R$ 0,80 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-12f9165b-2356-4b07-872b-9d18d687b9de" class="btn btn-primary col-sm-12" target="_blank">+ 100 an&uacute;ncios<br>R$ 70 (30% off)<br>R$ 0,70 por an&uacute;ncio</a>
</div><?
  }
}