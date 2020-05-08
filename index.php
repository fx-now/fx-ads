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
if($_GET["ci"] != ""){ $_SESSION["idcidade"] = str($_GET["ci"]); }else{ if($_SESSION["idcidade"] == ""){ $_SESSION["idcidade"] = 1; } }
if($_GET["a"] == "sair"){ logoff(); }
include("theme/header.php");
$page = url($_SERVER['REQUEST_URI'],"guia/");
include($page);
include("theme/footer.php");