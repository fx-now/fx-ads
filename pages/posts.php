<div class="row">
      <div class="col-md-12 col-12">
        <?
        $cat = str($_GET["c"]);
        $idAd = str($_GET["i"]);
        
        $selAdm = sel("usuarios","usuario = '".$_SESSION["login"]."'");
        $v = fetch($selAdm);
        if($v["nivel"] > 2){
          $statusads = " and status = 1";
        }
        
        if($idAd == "" && $cat != ""){
          $selCat = sel("categorias","id = $cat");
          $r = fetch($selCat);
          if($r["catmae"] != "0"){
            $selCatMae = sel("categorias","id = ".$r["catmae"]);
            $s = fetch($selCatMae);
            $catmae = $s["nome"]." &raquo; ";
          }
          ?>
          <h2>
            <?= $catmae.$r["nome"] ?>
          </h2>
          <?
//
            
            // definir o numero de itens por pagina
            $itens_por_pagina = 12;
            // pegar a pagina atual
            if($_GET["pg"] == ""){ $pagina = 0; }else{ $pagina = $_GET["pg"]; }
            $pagina = intval($pagina);
            $buscaAds = sel("anuncios","idcidade = '".str($_SESSION["idcidade"])."' and categoria = '$cat'$statusads","plano DESC, id DESC",($pagina*$itens_por_pagina).", $itens_por_pagina");
            $buscaAds2 = sel("anuncios","idcidade = '".str($_SESSION["idcidade"])."' and categoria = '$cat'$statusads","plano DESC, id DESC");
            $num = mysql_num_rows($buscaAds); //total apenas do que está sendo exibido
            $num_total = mysql_num_rows($buscaAds2); //total do banco
            // definir numero de páginas
            $num_paginas = ceil($num_total/$itens_por_pagina);
//
          if($num_total == 0){
            ?><div class="alert alert-secondary" role="alert">N&atilde;o h&aacute; publica&ccedil;&otilde;es aqui.</div><?
          }else{
            echo "<div class='row'>";
            $contador=0;
            while($t = fetch($buscaAds)){
              $contador=$contador+1;
              $data = explode(" ",$t["data"]);
              $sel = sel("usuarios","id = '".$t["idusuario"]."'");
              $u = fetch($sel);
              if($t["foto"] != ""){ $foto = im("upl/".$t["foto"],100,100); }else{ $foto = randomimg(100,100); }
              #echo "<i class='fas fa-arrow-alt-circle-right' style='color:#158cba'></i> <a href='?posts&i=".$t["id"]."'>".$t["titulo"]."</a> (".data($data[0]).", ".$data[1].", por <a href='?perfil&u=".$u["usuario"]."'>".$u["usuario"]."</a>)<br>";
              if($t["status"] == 0){ $color = " background-color: #ffccdd"; }else{ $color = ""; }
              #if($t["plano"] == 1){ $grid = 12; $color = "background-color: #ccc"; }else{ $grid = 3;  }
              if($t["plano"] == 1){ 
                $grid = 12; 
                $style = "background-color: #eee; margin-bottom: 20px; padding: 20px;"; 
                $style2 = " style='float:left; margin-right: 10px;'"; 
              }else{ 
                $grid = 3; 
                $style = "text-align: center;"; 
                $style2 = "";
              }
              echo "<div class='col-md-$grid' style='$style'>
                <a href='?posts&i=".$t["id"]."'><img src='$foto' class='img-thumbnail'$style2>";
              if($t["plano"] == 0){ echo "<br>"; }
              echo $t["titulo"]."</a>";
                if($t["plano"] == 1){ 
                  echo "<br>".$t["descricao"];
                  echo "<br>"; 
                }
                if($t["plano"] == 1){ 
                  if($t["telefone"] != ""){ echo " <a href='?posts&i=".$t["id"]."' title='Ver telefone' style='margin: 5px;'><i class='fas fa-phone'></i></a> "; }
                  if($t["whatsapp"] != ""){ echo " <a href='?posts&i=".$t["id"]."' title='Ver WhatsApp' style='margin: 5px;'><i class='fab fa-whatsapp'></i></a> "; }
                  if($t["email"] != ""){ echo " <a href='?posts&i=".$t["id"]."' title='Ver e-mail' style='margin: 5px;'><i class='far fa-envelope'></i></a> "; }
                  if($t["facebook"] != ""){ echo " <a href='?posts&i=".$t["id"]."' title='Ver Facebook' style='margin: 5px;'><i class='fab fa-facebook-square'></i></a> "; }
                  if($t["twitter"] != ""){ echo " <a href='?posts&i=".$t["id"]."' title='Ver Twitter' style='margin: 5px;'><i class='fab fa-twitter'></i></a> "; }
                  if($t["instagram"] != ""){ echo " <a href='?posts&i=".$t["id"]."' title='Ver Instagram' style='margin: 5px;'><i class='fab fa-instagram'></i></a> "; }
                  if($t["gmaps"] != ""){ echo " <a href='?posts&i=".$t["id"]."' title='Ver mapa' style='margin: 5px;'><i class='fas fa-map-marked-alt'></i></a> "; }
                  if($t["teleentrega"] == 1){ echo " <a href='?posts&i=".$t["id"]."' title='Tele-entrega"; if($t["teleentregagratis"] == 1){ echo " gr&aacute;tis"; } echo "' style='margin: 5px;'><i class='fas fa-motorcycle'></i></a> "; }
                }
                #if($t["plano"] == 0){ echo "<br>"; }
                if($t["preco"] > 0 && $t["plano"] == 0){ echo "<br><span class='badge badge-info' style='font-size: 12px;'>R$ ".$t["preco"]."</span>"; }
                echo "</div>";
            }
            echo "</div>";
            if($num_total > 0){ ?>
                                  <div style="clear:both"></div><br><br>
                                    <nav>
                                      <ul class="pagination">
                                        <li class="page-item">
                                            <a href="?posts&c=<?= $_GET["c"] ?>" aria-label="Primeira p&aacute;gina" class="page-link">
                                            <span aria-hidden="true">&laquo;</span>
                                          </a>
                                        </li>
                                        <?php 
                                        for($i=0;$i<$num_paginas;$i++){
                                        $estilo = "";
                                        if($pagina == $i){
                                            $estilo = "btn-success";
                                        }
                                        ?>
                                        <li class="page-item <?php echo $estilo; ?>" ><a href="?posts&c=<?= $_GET["c"] ?>&pg=<?php echo $i; ?>" class="page-link"><?php echo $i+1; ?></a></li>
                                            <?php } ?>
                                        <li class="page-item">
                                          <a href="?posts&c=<?= $_GET["c"] ?>&pg=<?php echo $num_paginas-1; ?>" aria-label="&Uacute;ltima p&aacute;gina" class="page-link">
                                            <span aria-hidden="true">&raquo;</span>
                                          </a>
                                        </li>
                                      </ul>
                                    </nav>         
            <? } 
          }
        }else{
          if($v["nivel"] < 3){
            $selAds = sel("anuncios","id = '".str($_GET["i"])."'");
            $l = fetch($selAds);
            if($v["idcidade"] == $l["idcidade"]){
              if($_GET["ac"] == "pub"){
                $upd = upd("anuncios","status = 1",str($_GET["i"]));
                ?><div class="alert alert-secondary" role="alert">An&uacute;ncio publicado!</div><?
              }
              if($_GET["ac"] == "del"){
                $upd = del("anuncios",str($_GET["i"]));
                ?><div class="alert alert-secondary" role="alert">An&uacute;ncio deletado!</div><?
              }
            }
          }
          
          $buscaAds = sel("anuncios","id = '".str($_GET["i"])."'$statusads","id DESC");
          if(total($buscaAds) == 0){
            ?><div class="alert alert-secondary" role="alert">N&atilde;o h&aacute; publica&ccedil;&otilde;es aqui.</div><?
          }else{
            while($t = fetch($buscaAds)){
              #echo "<i class='fas fa-arrow-alt-circle-right' style='color:#158cba'></i> <a href='?posts&i=".$t["id"]."'>".$t["titulo"]."</a><br>";
              ?>
              <div class="card bg-light mb-3">
                <div class="card-header"><?= $t["titulo"] ?></div>
                <div class="card-body">
                  <p class="card-text">
                  <?
                  if($t["foto"] != ""){ echo "<a href='upl/".$t["foto"]."' target='_blank'><img src='".im("upl/".$t["foto"],200,200)."' class='img-thumbnail float-left' style='margin-right: 5px'></a>"; }
                  ?>
                  <?= $t["descricao"] ?> 
                    <?
                    if($t["plano"] == 1){
                      if($t["teleentrega"] == 1){ 
                        echo " <a href='#' class='badge badge-warning' title='Tele-entrega"; 
                        if($t["teleentregagratis"] == 1){ 
                          echo " gr&aacute;tis"; 
                        } 
                        echo "' style='margin: 5px; font-size: 13px'><i class='fas fa-bookmark'></i> Tele-entrega"; 
                        if($t["teleentregagratis"] == 1){ 
                          echo " gr&aacute;tis"; 
                        } 
                        echo "</a> "; 
                      }
                      if($t["endereco"] != ""){ echo "<p>".$t["endereco"].", ".$t["bairro"];
                      if($t["telefone"] != ""){ echo "<br><a href='tel:".$t["telefone"]."' target='_blank' title='Ver telefone'><i class='fas fa-phone'></i> ".$t["telefone"]."</a>"; }
                      echo "</p>"; }
                      if($t["endereco"] == "" && $t["telefone"] != ""){
                        echo "<p><a href='tel:".$t["telefone"]."' target='_blank' title='Ver telefone'><i class='fas fa-phone'></i> ".$t["telefone"]."</a></p>"; 
                      }
                    }
                    ?><br><br>
                  <? if($t["preco"] > 0){ echo "<span class='badge badge-info' style='font-size: 20px'>R$ ".$t["preco"]."</span>"; } ?></p>
                  
                  <div style="clear:both"></div><br>
                <?
                if($t["plano"] == 1){ 
                  echo "<div class='btn-group' role='group'>";
                  if($t["telefone"] != ""){ echo " <a href='tel:".$t["telefone"]."' target='_blank' title='Ver telefone' class='btn btn-success'><i class='fas fa-phone'></i> Ligar</a> "; }
                  if($t["whatsapp"] != ""){ echo " <a href='https://wa.me/".$t["whatsapp"]."' target='_blank' title='Ver WhatsApp' class='btn btn-success'><i class='fab fa-whatsapp'></i> WhatsApp</a> "; }
                  if($t["facebook"] != ""){ echo " <a href='https://facebook.com/".$t["facebook"]."' target='_blank' title='Ver Facebook' class='btn btn-primary'><i class='fab fa-facebook-square'></i> Facebook</a> "; }
                  if($t["twitter"] != ""){ echo " <a href='https://twitter.com/".$t["twitter"]."' target='_blank' title='Ver Twitter' class='btn btn-primary'><i class='fab fa-twitter'></i> Twitter</a> "; }
                  if($t["instagram"] != ""){ echo " <a href='https://instagram.com/".$t["instagram"]."' target='_blank' title='Ver Instagram' class='btn btn-danger'><i class='fab fa-instagram'></i> Instagram</a> "; }
                  if($t["email"] != ""){ echo " <a href='mailto:".$t["email"]."' title='Ver e-mail' class='btn btn-warning'><i class='far fa-envelope'></i> E-mail</a> "; }
                  echo "</div>";
                }
              if($t["gmaps"] != ""){
                ?>
                  <br><br>
                  <iframe src="<?= $t["gmaps"] ?>" style="width: 100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" class='img-thumbnail'></iframe>
                  <div style="clear:both"></div>
                  <?
              }
              
                  $data = explode(" ",$t["data"]);
              
                  $sel = sel("usuarios","id = '".$t["idusuario"]."'");
                  $u = fetch($sel);
              
                  echo "<p><br><small style='font-weight: normal !important;'>Publicado em ".data($data[0]).", ".$data[1].", por <a href='?perfil&u=".$u["usuario"]."'>".$u["usuario"]."</a>";
              
                  #if($v["nivel"] < 3){ 
                    $selCidade = sel("cidades","id = '".$t["idcidade"]."'");
                    $x = fetch($selCidade);
                    $selCat = sel("categorias","id = '".$t["categoria"]."'");
                    $y = fetch($selCat);
                    echo ", em <a href='?posts&c=".$t["categoria"]."' class='badge badge-info' style='font-size: 12px;'><i class='fas fa-arrow-alt-circle-right'></i> ".$y["nome"]."</a>, em <a href='?home&ci=".$t["idcidade"]."' class='badge badge-info' style='font-size: 12px;'><i class='fas fa-university'></i> ".$x["nomeuf"]."</a>"; 
                  #}
              
                  echo "</small></p>";
              
                  if($t["foto"] != ""){ echo "<a href='upl/".$t["foto"]."' target='_blank'><img src='".im("upl/".$t["foto"],100,100)."' class='img-thumbnail float-left' style='margin-right: 5px'></a>"; }
                  if($t["foto2"] != ""){ echo "<a href='upl/".$t["foto2"]."' target='_blank'><img src='".im("upl/".$t["foto2"],100,100)."' class='img-thumbnail float-left' style='margin-right: 5px'></a>"; }
                  if($t["foto3"] != ""){ echo "<a href='upl/".$t["foto3"]."' target='_blank'><img src='".im("upl/".$t["foto3"],100,100)."' class='img-thumbnail float-left' style='margin-right: 5px'></a>"; }
                  if($t["foto4"] != ""){ echo "<a href='upl/".$t["foto4"]."' target='_blank'><img src='".im("upl/".$t["foto4"],100,100)."' class='img-thumbnail float-left' style='margin-right: 5px'></a>"; }
                  if($t["foto5"] != ""){ echo "<a href='upl/".$t["foto5"]."' target='_blank'><img src='".im("upl/".$t["foto5"],100,100)."' class='img-thumbnail float-left' style='margin-right: 5px'></a>"; }
              
                  ?><div style="clear:both"></div><?
              
                  if($v["nivel"] < 3){ //é administrador
                      if($v["idcidade"] == $t["idcidade"] or $v["nivel"] == 1){//é administrador deste anúncio ou é super admin
                        echo "<br><br>Admin: <div class='btn-group' role='group'>";
                        if($t["status"] == 0){
                          echo "<a href='?posts&i=".$t["id"]."&ac=pub' class='btn btn-primary'>Publicar</a>";
                        }
                        echo "<a href='?upgrade&i=".$t["id"]."' class='btn btn-primary'>Upgrade</a>";
                        echo "<a href='?posts&i=".$t["id"]."&ac=del' class='btn btn-danger'>Excluir</a>";
                        echo "</div>";
                      }
                  }
              
                  $updView = upd("anuncios","views = views+1",$t["id"]);
              
              if($t["comentarios"] == 1){
                  ?>
                  <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://fxguia.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                          <? } ?>  
                </div>
              </div>
              <?
            }
          }
        }
        ?>
      </div>
</div>