<div class="row">
  <div class="col-md-12 col-12">
    <h2>
      Busca por <?= str($_POST["q"]) ?>
    </h2>
    <?
  if($_GET["q"] != ""){
    $termo = str($_GET["q"]); 
  }else{
    $termo = str($_POST["q"]); 
  }
    
    $buscaTermo = sel("pesquisas","idcidade = '".str($_SESSION["idcidade"])."' and termo = '$termo'");
    if(total($buscaTermo) == 0){
      $ins = ins("pesquisas","idcidade, termo, contador","'".str($_SESSION["idcidade"])."', '$termo', 1");
    }else{
      $w = fetch($buscaTermo);
      $upd = upd("pesquisas","contador=contador+1",$w["id"]);
    }
      
            // definir o numero de itens por pagina
            $itens_por_pagina = 12;
            // pegar a pagina atual
            if($_GET["pg"] == ""){ $pagina = 0; }else{ $pagina = $_GET["pg"]; }
            $pagina = intval($pagina);
            $buscaAds = sel("anuncios","idcidade = '".str($_SESSION["idcidade"])."' and (titulo LIKE '%$termo%' or descricao LIKE '%$termo%')","plano DESC, id DESC",($pagina*$itens_por_pagina).", $itens_por_pagina");
            $buscaAds2 = sel("anuncios","idcidade = '".str($_SESSION["idcidade"])."' and (titulo LIKE '%$termo%' or descricao LIKE '%$termo%')","plano DESC, id DESC");
            $num = mysql_num_rows($buscaAds); //total apenas do que está sendo exibido
            $num_total = mysql_num_rows($buscaAds2); //total do banco
            // definir numero de páginas
            $num_paginas = ceil($num_total/$itens_por_pagina);
//
    if(total($buscaAds) == 0){
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
                                            <a href="?busca&q=<?= $_GET["q"] ?>" aria-label="Primeira p&aacute;gina" class="page-link">
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
                                        <li class="page-item <?php echo $estilo; ?>" ><a href="?busca&q=<?= $_GET["q"] ?>&pg=<?php echo $i; ?>" class="page-link"><?php echo $i+1; ?></a></li>
                                            <?php } ?>
                                        <li class="page-item">
                                          <a href="?busca&q=<?= $_GET["q"] ?>&pg=<?php echo $num_paginas-1; ?>" aria-label="&Uacute;ltima p&aacute;gina" class="page-link">
                                            <span aria-hidden="true">&raquo;</span>
                                          </a>
                                        </li>
                                      </ul>
                                    </nav>         
            <? } 
    }
    ?>
  </div>
</div>