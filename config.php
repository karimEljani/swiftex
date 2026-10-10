<?php
define('DB_HOST','localhost');define('DB_NAME','schema');define('DB_USER','root');define('DB_PASS','');
session_start();
function db(){static $d;return $d??=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);}
function e($s){return htmlspecialchars((string)$s,ENT_QUOTES);}
function need(){if(empty($_SESSION['u'])){header('Location: login.php');exit;}}
const STAGES=['Shipment Created','Picked Up','In Transit','At Local Facility','Out for Delivery','Delivered'];
const SPEEDS=['economy'=>['Economy (5-7 days)',12,3,6],'standard'=>['Standard (3-4 days)',18,4.5,3],'express'=>['Express (1-2 days)',30,7,1]];
function quote($o,$d,$w,$s){[$n,$b,$r,$days]=SPEEDS[$s];$m=strcasecmp(trim($o),trim($d))?1.6:1;return ['price'=>round(($b+$w*$r)*$m,2),'eta'=>date('D, d M Y',strtotime('+'.($days+($m>1?2:0)).' days'))];}
function head($t){$u=$_SESSION['u']['name']??null;$l=['ship'=>'Ship','track'=>'Track','services'=>'Services','locations'=>'Locations','support'=>'Support','rates'=>'Pricing'];
echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.e($t).' | SwiftEx</title><link rel="stylesheet" href="assets/style.css"></head><body><header><div class="bar"><a class="logo" href="index.php">Swift<b>Ex</b></a><button id="burger" aria-label="Menu">☰</button><nav id="nav">';
foreach($l as $k=>$v)echo '<a href="'.($k=='rates'?'rates':$k).'.php">'.$v.'</a>';
echo '</nav><div class="acts">'.($u?'<a class="btn ghost" href="dashboard.php">'.e($u).'</a>':'<a class="btn ghost" href="login.php">Sign In</a>').'<a class="btn" href="ship.php">Create Shipment</a></div></div></header><main>';}
function foot(){echo '</main><footer><div class="cols"><div><h4>Company</h4><a>About Us</a><a>Careers</a><a>Newsroom</a><a>Sustainability</a></div><div><h4>Shipping</h4><a href="track.php">Track</a><a href="ship.php">Ship Now</a><a href="rates.php">Shipping Rates</a><a href="locations.php">Locations</a></div><div><h4>Support</h4><a href="support.php">Help Center</a><a href="contact.php">Contact Us</a><a href="support.php">FAQs</a><a>Claims</a></div><div><h4>Legal</h4><a>Terms</a><a>Privacy</a><a>Cookies</a></div></div><div class="fb"><span>© '.date('Y').' SwiftEx. All rights reserved. · Facebook · X · LinkedIn · Instagram</span><span><select><option>English</option><option>Français</option><option>العربية</option></select> <select><option>Tunisia</option><option>France</option><option>USA</option></select></span></div></footer><script src="assets/app.js"></script></body></html>';}
function timeline($st){echo '<ol class="tl">';foreach(STAGES as $i=>$s)echo '<li class="'.($i<=$st?'on':'').'"><i></i>'.$s.'</li>';echo '</ol>';}
