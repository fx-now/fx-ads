<?
$sel = sel("cidades","id = '".str($_SESSION["idcidade"])."'");
$k = fetch($sel);
?>
        <h2>
          Anuncie!
        </h2>
    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

    <section class="pricing py-5">
      <div class="container">
        <div class="row">
          <!-- Free Tier -->
          <div class="col-lg-6">
            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">Gr&aacute;tis</h5>
                <h6 class="card-price text-center">R$ 0<span class="period">/m&ecirc;s</span></h6>
                <hr>
                <ul class="fa-ul">
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>1 foto</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Nome e descri&ccedil;&atilde;o</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Pre&ccedil;o (se aplic&aacute;vel)</li>
                  <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Telefone/WhatsApp</li>
                  <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>E-mail</li>
                  <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Links para redes sociais</li>
                  <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Localiza&ccedil;&atilde;o no mapa</li>
                  <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Hor&aacute;rio de expedi&ecirc;nte</li>
                  <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Categoria tele-entrega</li>
                  <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Ativar/Desativar coment&aacute;rios</li>
                </ul>
                <a href="?anunciar" class="btn btn-block btn-primary text-uppercase">Anunciar</a>
              </div>
            </div>
          </div>
          <!-- Plus Tier -->
          <div class="col-lg-6">
            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">Premium</h5>
                <h6 class="card-price text-center">R$ <?= $k["valordestaque"] ?><span class="period">/m&ecirc;s</span></h6>
                <hr>
                <ul class="fa-ul">
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>5 fotos</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Nome e descri&ccedil;&atilde;o</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Pre&ccedil;o (se aplic&aacute;vel)</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Telefone/WhatsApp</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>E-mail</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Links para redes sociais</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Localiza&ccedil;&atilde;o no mapa</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Hor&aacute;rio de expedi&ecirc;nte</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Categoria tele-entrega</li>
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>Ativar/Desativar coment&aacute;rios</li>
                </ul>
                <a href="?contato" class="btn btn-block btn-success text-uppercase">Solicitar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


<p>
  Voc&ecirc; pode ainda anunciar com banners:
</p>

            <h3>
              Banner 120x60px
            </h3>
            <p>
              Veicula&ccedil;&atilde;o em todas as p&aacute;ginas, nos menus laterais (voc&ecirc; escolhe em qual quer anunciar).
            </p>
<center>
            <?
            $selBanner1 = sel("banners","idcidade = '".$_SESSION["idcidade"]."' and (espaco = 1 or espaco = 2) and dataexpira > CURDATE() and status = 1","RAND()",1);
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
</center>
            <h3>
              Banner 728x90px
            </h3>
            <p>
              Veicula&ccedil;&atilde;o na p&aacute;gina inicial.
            </p>
<center>
            <?
            $selBanner1 = sel("banners","idcidade = '".$_SESSION["idcidade"]."' and espaco = 3 and dataexpira > CURDATE() and status = 1","RAND()",1);
            if(total($selBanner1) == 0){
              ?>
                <a href="?anuncieaqui"><img src="<?= randomimg(728,90) ?>" class="img-thumbnail rounded img-fluid"></a><br><a href="?anuncieaqui"><span class="badge badge-info">Anuncie aqui</span></a><br>
              <?
            }else{
              $f = fetch($selBanner1);
              ?>
                <a href="go.php?b=<?= $f["id"] ?>" target="_blank"><img src="upl/<?= $f["img"] ?>" class="img-thumbnail rounded img-fluid"></a><br><a href="?anuncieaqui"><span class="badge badge-info">Anuncie aqui</span></a><br>
              <?
              if($r["nivel"] > 2 or is_on() == false){
                $upd = upd("banners","visualizacoes=visualizacoes+1",$f["id"]);
              }
            }
            ?>
</center>

<p><br>
  Voc&ecirc; ainda pode contratar outros servi&ccedil;os para fazer um upgrade no seu neg&oacute;cio! Veja as op&ccedil;&otilde;es:
</p>
<p style="margin-left: 30px; border-left: solid 4px #ccc; padding-left: 5px;">
  <i class="far fa-check-square"></i> Cria&ccedil;&atilde;o de site, com hospedagem, dom&iacute;nio e e-mail @suaempresa.com inclusos;<br>
  <i class="far fa-check-square"></i> Cria&ccedil;&atilde;o de aplicativo para celular;<br>
  <i class="far fa-check-square"></i> Cria&ccedil;&atilde;o de loja online;<br>
  <i class="far fa-check-square"></i> Cria&ccedil;&atilde;o de site e, ou app para com&eacute;rcios com tele-entrega (e pedidos online);<br>
  <i class="far fa-check-square"></i> CRM para gest&atilde;o do seu com&eacute;rcio;<br>
  <i class="far fa-check-square"></i> Sistema e, ou app para gest&atilde;o de consult&oacute;rios m&eacute;dicos, com prontu&aacute;rio eletr&ocirc;nico, em servidor especial para este fim;<br>
  <i class="far fa-check-square"></i> Solicite um or&ccedil;amento para sua demanda;<br>
</p>

        <p>
          Para mais informa&ccedil;&otilde;es entre em contato conosco:
        </p>
        <p style="margin-left: 30px; border-left: solid 4px #ccc; padding-left: 5px;">
          <?
          $selContato = sel("cidades","id = '".$_SESSION["idcidade"]."'");
          $r = fetch($selContato);
          if(!empty($r["telefone"])){ echo "<b>WhatsApp/Fone: </b>".$r["telefone"]."<br>"; }
          if(!empty($r["email"])){ echo "<b>E-mail: </b><a href='mailto:".$r["email"]."'>".$r["email"]."</a><br>"; }
          if(!empty($r["facebook"])){ echo "<a href='https://facebook.com/".$r["facebook"]."'><i class='fab fa-facebook-f'></i>/".$r["facebook"]."</a><br>"; }
          if(!empty($r["instagram"])){ echo "<a href='https://instagram.com/".$r["instagram"]."'><i class='fab fa-instagram'></i>/".$r["instagram"]."</a><br>"; }
          if(!empty($r["twitter"])){ echo "<a href='https://twitter.com/".$r["twitter"]."'><i class='fab fa-twitter'></i>/".$r["twitter"]."</a>"; }
          ?>
        </p>