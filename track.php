<?php require 'config.php';head('Track Shipment');?><div class="wrap"><h1>Track Shipment</h1>
<form data-v class="box"><label>Tracking number(s) — separate with commas</label><div class="row"><input name="n" value="<?=e($_GET['n']??'')?>" required><button class="btn">Track Package</button></div><div></div></form>
<?php if(!empty($_GET['n'])){foreach(explode(',',$_GET['n']) as $n){$n=strtoupper(preg_replace('/\s+/','',$n));$s=db()->prepare('SELECT * FROM shipments WHERE tracking=?');$s->execute([$n]);$x=$s->fetch();
if(!$x){echo '<div class="note">No shipment found for '.e($n).'</div>';continue;}
$ev=db()->prepare('SELECT * FROM events WHERE shipment_id=? ORDER BY at DESC');$ev->execute([$x['id']]);?>
<div class="card" style="margin:20px 0"><h3><a href="shipment.php?id=<?=$x['id']?>"><?=e($x['tracking'])?></a></h3><?php timeline($x['status'])?>
<div class="grid"><div><b>Shipment Status</b><br><?=STAGES[$x['status']]?></div><div><b>Current Location</b><br><?=e($x['location'])?></div><div><b>Estimated Delivery</b><br><?=e($x['eta'])?></div><div><b>Last Update</b><br><?=e($x['updated'])?></div></div>
<h4>History</h4><?php foreach($ev as $e)echo '<div class="note">'.e($e['at']).' — '.e($e['label']).'</div>';?></div><?php }}?></div><?php foot();
