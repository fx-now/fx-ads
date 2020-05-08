<p>
  <b>&Uacute;ltimas publica&ccedil;&otilde;es: </b>
  <marquee>
    <?
    $selPosts = sel("anuncios","idcidade = '".$_SESSION["idcidade"]."'","id DESC",10);
    while($e = fetch($selPosts)){
      echo " <a href='?posts&i=".$e["id"]."' style='margin-right: 20px'><i class='fas fa-external-link-alt'></i> ".$e["titulo"]."</a> ";
    }
    ?>
  </marquee>
</p>

          <div id="map" tabindex="0"></div><br>


            <?
            $selBanner1 = sel("banners","idcidade = '".$_SESSION["idcidade"]."' and espaco = 3 and dataexpira > CURDATE() and status = 1","RAND()",1);
            if(total($selBanner1) == 0){
              ?>
          <center>
            <a href="?anuncieaqui"><img src="<?= randomimg(728,90) ?>" class="img-thumbnail rounded img-fluid"></a><br>
            <a href="?anuncieaqui"><span class="badge badge-info">Anuncie aqui</span></a>
          </center>
              <?
            }else{
              $f = fetch($selBanner1);
              ?>
          <center>
            <a href="go.php?b=<?= $f["id"] ?>" target="_blank"><img src="upl/<?= $f["img"] ?>" class="img-thumbnail rounded img-fluid"></a><br>
            <a href="?anuncieaqui"><span class="badge badge-info">Anuncie aqui</span></a>
          </center>
              <?
              if($r["nivel"] > 2 or is_on() == false){
                $upd = upd("banners","visualizacoes=visualizacoes+1",$f["id"]);
              }
            }
            ?>