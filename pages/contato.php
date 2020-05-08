        <h2>
          Contato
        </h2>
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