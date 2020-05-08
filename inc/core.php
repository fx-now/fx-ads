<?
define('TAG_TITLE','FX Ads');
define('LOGO','FX Ads');

function randomimg($width,$height){
  return "https://picsum.photos/$width/$height";
}

function getLonLat(){
    $sel = sel("cidades","id = '".$_SESSION["idcidade"]."'");
    $r = fetch($sel);
    $dados = $r["lon"].",".$r["lat"];
    return $dados;
}