            <div class="row" style="margin-top: 30px;">
              <?
              $cont = 0;
              $selCat = sel("categorias","catmae = 0","ordem ASC");
              while($s = fetch($selCat)){
                  echo "<div class='col-md-4 col-6' style='text-align:left'>";
                  echo "<h4>".$s["nome"]."</h4>";
                  $selCats = sel("categorias","catmae = '".$s["id"]."'","nome ASC");
                  while($t = fetch($selCats)){
                      $cont = $cont+1;
                      if($cont < 6){
                        echo "<i class='fas fa-arrow-alt-circle-right' style='color:#158cba'></i> <a href='?posts&c=".$t["id"]."'>".$t["nome"]."</a><br>";
                      }elseif($cont == 6){
                        echo "<i class='fas fa-arrow-alt-circle-down' style='color:green'></i> <a href=\"javascript:;\" onclick=\"$('#listacat_".$s["id"]."').toggle()\" style='color:green'>Ver mais</a><br>
                        <div id='listacat_".$s["id"]."' style='display:none'><i class='fas fa-arrow-alt-circle-right' style='color:#158cba'></i> <a href='?posts&c=".$t["id"]."'>".$t["nome"]."</a><br>";
                      }elseif($cont > 6){
                        echo "<i class='fas fa-arrow-alt-circle-right' style='color:#158cba'></i> <a href='?posts&c=".$t["id"]."'>".$t["nome"]."</a><br>";
                      }
                  }
                  if($cont > 5){
                      echo "</div>";
                  }
                  $cont = 0;
                  echo "<br></div>";
              }
              ?>
            </div> 

            </div>

            <div class="col-md-2 border-left" id="menus">
              <div class="row">
                <div class="col-md-12 col-6">
                  <h4>Na cidade</h4>
                  <a href="?posts&c=8">Dicas de turismo</a><br>
                  <a href="?posts&c=31">Eventos</a><br>
                  <a href="?posts&c=7">Not&iacute;cias</a><br>
                  <a href="?posts&c=12">Pol&iacute;tica</a><br><br>
                </div>
                <div class="col-md-12 col-6">
                  <h4>
                    Cidades
                  </h4>
                    <?
                    $sel = sel("cidades","status = '1'","nomeuf ASC");
                    while($r = fetch($sel)){
                    ?>
                    <a href="?home&ci=<?= $r["id"] ?>"><i class="fas fa-university"></i> <?= $r["nomeuf"] ?></a><br>
                    <? 
                    }
                    ?><br>
                </div>
              </div>
                    <a href="?representantes" class="btn btn-info">Sua cidade n&atilde;o est&aacute; listada? Seja um representante $$$</a><br>
                    <br>
              
              <h4>
                Apoio
              </h4>

            <?
            $selBanner1 = sel("banners","idcidade = '".$_SESSION["idcidade"]."' and espaco = 2 and dataexpira > CURDATE() and status = 1","RAND()",1);
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
              
                <?
                $selCidade = sel("cidades","id = '".str($_SESSION["idcidade"])."'");
                $g = fetch($selCidade);
                if($g["googleplay"] != ""){
                  ?>
                    <center><a href='<?= $g["googleplay"] ?>' target='_blank'><img alt='Get it on Google Play' src='https://play.google.com/intl/pt-BR/badges/static/images/badges/en_badge_web_generic.png' style="max-width: 125px"/></a><br></center>
                  <?
                }
                ?>
            </div>
        </div>
      </div>
      <div style="clear:both"></div>
      <div id="copy">
        <p>
          &copy; 2019 -<?= date("Y") ?> <? if($_SESSION["idcidade"] == ""){ echo LOGO; }else{ echo campo("cidades", "nome", $_SESSION["idcidade"]); } ?><br>
          <small>Desenvolvido por <a href="https://fxnow.space/?r=fxads" target="_blank">FXNow</a></small>
        </p>
      </div>
    </div>
    <script src="inc/js.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">
      var olview = new ol.View({ center: ol.proj.fromLonLat([<?= getLonLat() ?>]), zoom: 13 }),
          baseLayer = new ol.layer.Tile({ source: new ol.source.OSM() }),
          map = new ol.Map({
            target: document.getElementById('map'),
            view: olview,
            layers: [baseLayer]
          });

      // popup
      var popup = new ol.Overlay.Popup();
      map.addOverlay(popup);

      //Listen when an address is chosen
      geocoder.on('addresschosen', function (evt) {
        console.info(evt);
        window.setTimeout(function () {
          popup.show(evt.coordinate, evt.address.formatted);
        }, 3000);
      });
      </script>
  </body>
</html>