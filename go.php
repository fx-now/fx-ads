<?
session_start();
error_reporting(0); // E_ALL
ini_set("display_errors",0);
/**
 * @name fx ads
 * @author Original by FX Now <fxnowteam@protonmail.com> <https://fxnow.space/>
 * @version 1.0.1
 */
include("inc/core.php");
include("inc/bigboss.php");
con("w3v4g8","lbt14ax2#$");
db("w3v4g8_fxads");

$sel = sel("banners","id = '".str($_GET["b"])."'");
if(total($sel) > 0){
  $r = fetch($sel);
  $upd = upd("banners","cliques=cliques+1",$r["id"]);
  echo "<meta http-equiv='refresh' content='0;URL=".$r["link"]."'>";
}