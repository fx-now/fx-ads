<?
if(is_on() == true){
    $sel = sel("usuarios","usuario = '".str($_SESSION["login"])."'");
    $r = fetch($sel);
    if($r["nivel"] > 2){ exit; }
  ?>
<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <a href="?admin" class="btn btn-secondary">Painel</a>
    <a href="?admin&p=banners" class="btn btn-secondary">Banners</a>
    <a href="?admin&p=destaques" class="btn btn-secondary">Destaques</a>
<? if($r["nivel"] == 1){ ?>
    <div class="btn-group" role="group">
      <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Super admin
      </button>
      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <a class="dropdown-item" href="?admin&p=cidades">Cidades</a>
        <a class="dropdown-item" href="?admin&p=representantes">Representantes</a>
      </div>
    </div>
<? } ?>
    <div class="btn-group" role="group">
      <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Publicar
      </button>
      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <a class="dropdown-item" href="?anunciar">An&uacute;ncio</a>
        <a class="dropdown-item" href="?anunciar&cat=8">Dica de turismo</a>
        <a class="dropdown-item" href="?anunciar&cat=31">Evento</a>
        <a class="dropdown-item" href="?anunciar&cat=7">Not&iacute;cia</a>
        <a class="dropdown-item" href="?anunciar&cat=12">Pol&iacute;tica</a>
      </div>
    </div>
  <? 
  if($r["nivel"] == 2){ $querycidade = "idcidade = '".$r["idcidade"]."' and ";  }
  $buscaAdsMod = sel("anuncios",$querycidade."status = 0");
  $totalMod = total($buscaAdsMod);
  ?>
    <a href="?admin&p=moderacao" class="btn btn-<? if($totalMod > 0){ echo "warning"; }else{ echo "secondary"; } ?>">Aguardando modera&ccedil;&atilde;o (<?
  echo $totalMod;
  ?>)</a>
    <a href="?home&a=sair" class="btn btn-secondary">Sair</a>
  </div>
<br><br>
<?
  if($_GET["p"] == ""){
    ?>
    <div class="alert alert-secondary" role="alert">Voc&ecirc; tem <?= $r["anunciospagos"]-$r["anunciosusados"] ?> an&uacute;ncios pagos de saldo para usar.</div>
<div class="row">
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-c47d32f1-c030-4508-897d-f04a651b1175" class="btn btn-primary col-sm-6" target="_blank">+ 10 an&uacute;ncios<br>R$ 10<br>R$ 1 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-e8aa1cdb-4af0-4aa4-95c4-1f3172e53a1e" class="btn btn-primary col-sm-6" target="_blank">+ 20 an&uacute;ncios<br>R$ 18 (10% off)<br>R$ 0,90 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-d7f50811-1a46-4ef0-9a3b-d62cb1d91c19" class="btn btn-primary col-sm-6" target="_blank">+ 30 an&uacute;ncios<br>R$ 25,50 (15% off)<br>R$ 0,85 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-d5c816f4-f731-44f9-aabd-0170c0e56f46" class="btn btn-primary col-sm-6" target="_blank">+ 50 an&uacute;ncios<br>R$ 40 (20% off)<br>R$ 0,80 por an&uacute;ncio</a>
    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=501892612-12f9165b-2356-4b07-872b-9d18d687b9de" class="btn btn-primary col-sm-12" target="_blank">+ 100 an&uacute;ncios<br>R$ 70 (30% off)<br>R$ 0,70 por an&uacute;ncio</a>
</div>
     <?
  }
  ?>
  <?
    if($r["nivel"] == 1){
      if($_GET["p"] == "cidades"){
        if($_GET["ac"] == "del"){
          $del = del("cidades",str($_GET["id"]));
          ?>
          <div class="alert alert-primary" role="alert">Cidade #<?= $_GET["id"] ?> deletada!</div>
          <?
        }
        if($_POST["acao"] == "0"){
          $nome = str($_POST["nome"]);
          $nomeuf = str($_POST["nomeuf"]);
          $lat = str($_POST["lat"]);
          $lon = str($_POST["lon"]);
          $idadm = str($_POST["idadm"]);
          $telefone = str($_POST["telefone"]);
          $email = str($_POST["email"]);
          $facebook = str($_POST["facebook"]);
          $twitter = str($_POST["twitter"]);
          $instagram = str($_POST["instagram"]);
          $ins = ins("cidades","nome, nomeuf, lat, lon, idadm, telefone, email, facebook, twitter, instagram","'$nome', '$nomeuf', '$lat', '$lon', '$idadm', '$telefone', '$email', '$facebook', '$twitter', '$instagram'");
          ?>
          <div class="alert alert-primary" role="alert">Cidade online!</div>
          <?
        }
        if($_POST["acao"] > 0){
          $idcidade = str($_POST["acao"]);
          $nome = str($_POST["nome"]);
          $nomeuf = str($_POST["nomeuf"]);
          $lat = str($_POST["lat"]);
          $lon = str($_POST["lon"]);
          $idadm = str($_POST["idadm"]);
          $telefone = str($_POST["telefone"]);
          $email = str($_POST["email"]);
          $facebook = str($_POST["facebook"]);
          $twitter = str($_POST["twitter"]);
          $instagram = str($_POST["instagram"]);
          $ins = upd("cidades","nome = '$nome', nomeuf = '$nomeuf', lat = '$lat', lon = '$lon', idadm = '$idadm', telefone = '$telefone', email = '$email', facebook = '$facebook', twitter = '$twitter', instagram = '$instagram'",$idcidade);
          ?>
          <div class="alert alert-primary" role="alert">Cidade atualizada!</div>
          <?
        }
        ?>
        <h3>Cidades</h3>
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <?
        $sel = sel("cidades","");
        while($j = fetch($sel)){
          ?>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-university"></i> <?= $j["nomeuf"] ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a class="dropdown-item" href="javascript:;" onclick="carregaCidade('<?= $j["id"] ?>', '<?= $j["nome"] ?>', '<?= $j["nomeuf"] ?>', '<?= $j["lat"] ?>', '<?= $j["lon"] ?>', '<?= $j["idadm"] ?>', '<?= $j["telefone"] ?>', '<?= $j["email"] ?>', '<?= $j["facebook"] ?>', '<?= $j["instagram"] ?>', '<?= $j["twitter"] ?>')">Editar</a>
              <a class="dropdown-item" href="?admin&p=cidades&ac=del&id=<?= $j["id"] ?>">Excluir</a>
            </div>
          </div>
          <?
        }
        ?>
        </div>
<br><br>
<h4>
  Novo
</h4>
        <form method="post" action="?admin&p=cidades">
          <input type="hidden" name="acao" id="acao" value="0">
          <input type="text" name="nome" id="nome" placeholder="Nome do site" class="form-control">
          <input type="text" name="nomeuf" id="nomeuf" placeholder="Cidade/UF" class="form-control">
          <input type="text" name="lat" id="lat" placeholder="Latitude" class="form-control">
          <input type="text" name="lon" id="lon" placeholder="Longitude" class="form-control">
          <select name="idadm" id="idadm" class="form-control">
            <?
            $selAdmins = sel("usuarios","nivel < 3");
            while($y = fetch($selAdmins)){
              echo "<option value='".$y["id"]."'>".$y["usuario"]."</option>";
            }
            ?>
          </select>
          <input type="text" name="telefone" id="telefone" placeholder="Whatsapp para contato com os clientes" class="form-control">
          <input type="text" name="email" id="email" placeholder="E-mail para contato com os clientes" class="form-control">
          <input type="text" name="facebook" id="facebook" placeholder="Facebook" class="form-control">
          <input type="text" name="instagram" id="instagram" placeholder="Instagram" class="form-control">
          <input type="text" name="twitter" id="twitter" placeholder="Twitter" class="form-control">
          <input type="submit" value="Salvar" class="btn btn-primary">
        </form>
        <?
      }
      
      if($_GET["p"] == "representantes"){
        if($_GET["ac"] == "remove"){
          $upd = upd("usuarios","nivel = 3",str($_GET["rep"]));
          ?>
          <div class="alert alert-primary" role="alert">Representante removido!</div>
          <?
        }
        
        if($_POST["idadm"] != ""){
          $upd = upd("usuarios","idcidade = '".str($_POST["cidade"])."', nivel = 2",str($_POST["idadm"]));
          $upd = upd("cidades","idadm = '".str($_POST["idadm"])."'",str($_POST["cidade"]));
          ?>
          <div class="alert alert-primary" role="alert">Representante adicionado!</div>
          <?
        }
        ?>
        <h3>Representantes</h3>
        <?
        $sel = sel("usuarios","nivel = 2");
        while($r = fetch($sel)){
          echo "<a href='?perfil&u=".$r["usuario"]."'><i class='fas fa-user'></i> ".$r["usuario"]."</a> <a href='?admin&p=representantes&rep=".$r["id"]."&ac=remove' class='btn btn-danger btn-sm'>remover</a><br>";
        }
        ?><br><br>
<h4>
  Novo
</h4>
        <form method="post" action="?admin&p=representantes">
          <select name="idadm" id="idadm" class="form-control">
            <?
            $selAdmins = sel("usuarios","nivel = 3");
            while($y = fetch($selAdmins)){
              echo "<option value='".$y["id"]."'>".$y["usuario"]."</option>";
            }
            ?>
          </select>
          <select name="cidade" id="cidade" class="form-control">
            <?
            $selAdmins = sel("cidades","");
            while($y = fetch($selAdmins)){
              echo "<option value='".$y["id"]."'>".$y["nomeuf"]."</option>";
            }
            ?>
          </select>
          <input type="submit" value="Salvar" class="btn btn-primary">
        </form>
        <?
      }
    }
  
    
    if($_GET["p"] == "banners"){
      if($_POST["a"] == 1){
          $saldo = $r["anunciospagos"]-$r["anunciosusados"];
          if($saldo == 0){
            echo "Voc&ecirc; n&atilde;o tem mais saldo para publicar an&uacute;ncios! Adicione cr&eacute;ditos!";
            exit;
          }
          $upd = upd("usuarios","anunciosusados=anunciosusados+1",$r["id"]);
          if($_FILES["banner"]["name"] != ""){
            $target_dir = "upl/";
            $target_file = $target_dir . basename($_FILES["banner"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["banner"]["tmp_name"]);
            if($check !== false) {
              if ($_FILES["banner"]["size"] > 10000000) { //10mb
                  $msgerror = "Este &eacute; um arquivo muito grande (>10mb). Trate a imagem para que ela n&atilde;o demore tanto para carregar para os visitantes deste site.";
                  $upload = 0;
              }else{
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                      $msgerror = "Imagens somente no formato JPG, JPEG, PNG & GIF.";
                      $upload = 0;
                  }else{
                      $novoNomeImg = hash('sha512',$_FILES["banner"]["name"]).".$imageFileType";
                      if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_dir.basename($novoNomeImg))) {
                          $upd = ins("banners","idcidade, espaco, img, link, dataexpira", "'".$_SESSION["idcidade"]."', '".str($_POST["espaco"])."', '$novoNomeImg', '".str($_POST["link"])."', '".date("Y-m-d",strtotime("+ 1 month"))." 00:00:00'");
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
        if($upload == 0){ echo $msgerror; }else{ 
          ?>
          <div class="alert alert-secondary" role="alert">Banner publicado!</div>
          <?  }
      }
      
      if($_GET["a"] == "del"){
        //verifica se este anúncio pertence a cidade do administrador
        $sel = sel("banners","id = '".str($_GET["b"])."' and idcidade = '".$_SESSION["idcidade"]."'");
        //exclui anúncio
        if(total($sel) > 0){
          $del = del("banners",str($_GET["b"]));
          ?>
          <div class="alert alert-secondary" role="alert">Banner deletado!</div>
          <?
        }
      }
      ?>
        <h3>Banners</h3>

        <table class="table table-hover">
          <thead>
            <tr class="table-active">
              <th scope="col">Banner</th>
              <th scope="col">Expira</th>
            </tr>
          </thead>
          <tbody>
            <?
            $selAd = sel("banners","idcidade = '".$_SESSION["idcidade"]."'","status DESC");
            while($j = fetch($selAd)){
            ?>
            <tr>
              <th scope="row"><a href="<?= $j["link"] ?>"><img src="upl/<?= $j["img"] ?>" style="max-width: 100%;"></a><br>
              <?= $j["visualizacoes"] ?> views | <?= $j["cliques"] ?> cliques | <a href="?admin&p=banners&a=del&b=<?= $j["id"] ?>">Excluir</a></th>
              <td><? $data = explode(" ",$j["dataexpira"]); echo data($data[0]); ?><br><a href="?admin&p=banners&a=upd&b=<?= $j["id"] ?>">+ 1 m&ecirc;s</a></td>
            </tr>
            <?
            }
            ?>
          </tbody>
        </table> 

<form method="post" action="?admin&p=banners" enctype="multipart/form-data">
  <input type="hidden" name="a" value="1">
  <b>Imagem: </b><input type="file" name="banner">
  <b>Local: </b><select name="espaco">
    <option value="1">120x60 Menu direito</option>
    <option value="2">120x60 Menu esquerdo</option>
    <option value="3">728x90 P&aacute;gina inicial</option>
  </select><br>
  <b>Link: </b><input type="text" name="link" placeholder="https://www.">
  <input type="submit" value="Salvar" class="btn btn-primary">
</form>
      <?
    }
  
    
    if($_GET["p"] == "destaques"){
      if($_GET["a"] == "down"){
        $upd = mysql_query("UPDATE anuncios SET plano = 0 WHERE idcidade = '".$_SESSION["idcidade"]."' and id = '".str($_GET["i"])."'") or die(mysql_error());
        ?>
        <div class="alert alert-secondary" role="alert">An&uacute;ncio atualizado para o plano gratuito.</div>
        <? 
      }
      ?>
        <h3>An&uacute;ncios destacados</h3>
        <table class="table table-hover">
          <thead>
            <tr class="table-active">
              <th scope="col">T&iacute;tulo</th>
              <th scope="col">Expira</th>
              <th scope="col"> </th>
            </tr>
          </thead>
          <tbody>
            <?
            $selAd = sel("anuncios","idcidade = '".$_SESSION["idcidade"]."' and plano = 1");
            while($j = fetch($selAd)){
            ?>
            <tr>
              <th scope="row"><a href="?posts&i=<?= $j["id"] ?>"><?= $j["titulo"] ?></a></th>
              <td><? $data = explode(" ",$j["dataexpira"]); echo data($data[0]); ?></td>
              <td>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-success">A&ccedil;&otilde;es</button>
                  <div class="btn-group" role="group">
                    <button id="btnGroupDrop2" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                      <a href="?upgrade&i=<?= $j["id"] ?>" class="dropdown-item">Editar</a>
                      <a href="?admin&p=destaques&a=down&i=<?= $j["id"] ?>" class="dropdown-item">Downgrade</a>
                      <a href="?posts&i=<?= $j["id"] ?>&ac=del" class="dropdown-item">Excluir</a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?
            }
            ?>
          </tbody>
        </table> 
      <?
    }
  
    if($_GET["p"] == "moderacao"){
      ?>
        <h3>Modera&ccedil;&atilde;o</h3>
      <?
          if($r["nivel"] == 2){
            $querycidade = "idcidade = '".$r["idcidade"]."' and ";
          }
          $buscaAds = sel("anuncios",$querycidade."status = 0","id DESC");
          if(total($buscaAds) == 0){
            ?><div class="alert alert-secondary" role="alert">N&atilde;o h&aacute; publica&ccedil;&otilde;es aqui.</div><?
          }else{
            echo "<div class='row'>";
            while($t = fetch($buscaAds)){
              $data = explode(" ",$t["data"]);
              $sel = sel("usuarios","id = '".$t["idusuario"]."'");
              $u = fetch($sel);
              if($t["foto"] != ""){ $foto = im("upl/".$t["foto"],100,100); }else{ $foto = randomimg(100,100); }
              echo "<div class='col-md-3' style='text-align: center;'>
                <a href='?posts&i=".$t["id"]."'><img src='$foto' class='img-thumbnail'><br>".$t["titulo"]."</a><br>";
              if($t["preco"] != "0.00"){ echo "<span class='badge badge-info'>R$ ".$t["preco"]."</span>"; }
              echo "</div>";
            }
            echo "</div>";
          }
    }
}