<!doctype html>
<html lang="en">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <? /*<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> */ ?>
      <link rel="stylesheet" type="text/css" href="inc/bootstrap.css">
      <script src="https://kit.fontawesome.com/6b484d26e5.js" crossorigin="anonymous"></script>
      <title><? if($_SESSION["idcidade"] == ""){ echo TAG_TITLE; }else{ echo campo("cidades", "nome", $_SESSION["idcidade"]); } ?></title>
    
      <script type="text/javascript" src="https://unpkg.com/openlayers"></script>
      <link rel="stylesheet" type="text/css" href="https://unpkg.com/openlayers/dist/ol.css">
      <link rel="stylesheet" type="text/css" href="https://unpkg.com/ol-geocoder/dist/ol-geocoder.min.css">
      <script type="text/javascript" src="https://unpkg.com/ol-geocoder"></script>
      <script type="text/javascript" src="https://unpkg.com/ol-popup@2.0.0"></script>
      <link rel="stylesheet" type="text/css" href="https://unpkg.com/ol-popup@2.0.0/src/ol-popup.css">
      <link rel="stylesheet" type="text/css" href="inc/css.css">
    
    
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
          <a class="navbar-brand" href="?home" style="font-weight: bold"><? if($_SESSION["idcidade"] == ""){ echo LOGO; }else{ echo campo("cidades", "nome", $_SESSION["idcidade"]); } ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="?home">In&iacute;cio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="?anunciar" style="font-weight:bold;color:orange">Anunciar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?perfil&u=<?= $_SESSION["login"] ?>">Minha conta</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?contato">Contato</a>
                </li>
              </ul>
            </form>
          </div>
        </nav>
    
    <div class="container" style="margin-top: -30px">
    <div class="row">
        <div class="row">
          <div class="col-md-2 border-right d-none d-sm-block" id="menus">
    <div class="alert alert-secondary" role="alert">
<?
  if(is_on() == true){
    $sel = sel("usuarios","usuario = '".str($_SESSION["login"])."'");
    $r = fetch($sel);
    ?>
      <img src="<?= get_gravatar($r["email"],80) ?>" class="img-thumbnail rounded"><br>
      Ol&aacute; <b><?= $r["usuario"] ?></b>!<br>
      <?
      if($r["nivel"] < 3){
        ?><a href="?admin" style="font-weight: bold; color: orange">Admin</a> &#183; <?
      }
      /*<a href="?perfil&u=<?= $r["usuario"] ?>">Perfil</a> &#183; */
      ?>
      <a href="?home&a=sair">Sair</a><br><br>
    <?
  }else{
    ?>
    <a href="?perfil">Entrar</a><br><br>
    <?
  }
  ?>
      <a href="?anunciar<? if($_GET["c"] != ""){ echo "&cat=".$_GET["c"]; $here = "&nbsp; aqui"; } ?>" class="btn btn-success btn-block" style="font-weight:bold">Anunciar<?= $here ?></a>
    </div>
            
            <h4>
              Eventos
            </h4>
            <?
            $selEv = sel("anuncios","idcidade = '".str($_SESSION["idcidade"])."' and categoria = '31' and status = 1","id DESC",3);
            if(total($selEv) == 0){
              echo "Nenhum evento cadastrado ainda.";
            }
            while($rEv = fetch($selEv)){
            ?>
            <a href="?posts&i=<?= $rEv["id"] ?>"><i class="fas fa-external-link-alt"></i> <?= $rEv["titulo"] ?></a><br>
            <? } ?><br><br>
            
            <h4>
              Not&iacute;cias
            </h4>
            <?
            $selNt = sel("anuncios","idcidade = '".str($_SESSION["idcidade"])."' and categoria = '7' and status = 1","id DESC",3);
            if(total($selEv) == 0){
              echo "Nenhuma not&iacute;cia publicada ainda.";
            }
            while($rNt = fetch($selNt)){
            ?>
            <a href="?posts&i=<?= $rNt["id"] ?>"><i class="fas fa-external-link-alt"></i> <?= $rNt["titulo"] ?></a><br>
            <? } ?><br>
            <br><br>
            <?
            $selBanner1 = sel("banners","idcidade = '".$_SESSION["idcidade"]."' and espaco = 1 and dataexpira > CURDATE() and status = 1","RAND()",1);
            if(total($selBanner1) == 0){
              ?>
                <a href="?anuncieaqui"><img src="<?= randomimg(120,60) ?>" class="img-thumbnail rounded"></a><br><a href="?anuncieaqui"><span class="badge badge-info">Anuncie aqui</span></a><br>
              <?
            }else{
              $f = fetch($selBanner1);
              ?>
                <a href="go.php?b=<?= $f["id"] ?>" target="_blank"><img src="upl/<?= $f["img"] ?>" class="img-thumbnail rounded"></a><br><a href="?anuncieaqui"><span class="badge badge-info">Anuncie aqui</span></a><br>
              <?
              if($r["nivel"] > 2 or is_on() == false){
                $upd = upd("banners","visualizacoes=visualizacoes+1",$f["id"]);
              }
            }
            ?>
          </div>

          <div class="col-md-8">
            <form class="card card-sm" method="post" action="?busca">
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">
                        <i class="fas fa-search h4 text-body"></i>
                    </div>
                    <!--end of col-->
                    <div class="col">
                        <input class="form-control form-control-lg" type="search" placeholder="O que voc&ecirc; est&aacute; procurando?" style="border: 0;box-shadow: none;" name="q">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success" type="submit">Pesquisar</button>
                    </div>
                    <!--end of col-->
                </div>
            </form><br>