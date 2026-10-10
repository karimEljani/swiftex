<?php // Ouvrir une seule fois: http://localhost/swiftex/install.php
require 'config.php';
$p=new PDO('mysql:host='.DB_HOST,DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
$p->exec('CREATE DATABASE IF NOT EXISTS '.DB_NAME.' CHARACTER SET utf8mb4');$p->exec('USE '.DB_NAME);
$p->exec(file_get_contents('schema.sql'));
if(!$p->query('SELECT COUNT(*) FROM users')->fetchColumn()){
$p->prepare('INSERT INTO users VALUES(1,?,?,?)')->execute(['Demo User','demo@swiftex.com',password_hash('demo1234',PASSWORD_DEFAULT)]);
$p->exec("INSERT INTO shipments VALUES(1,1,'SWX78452391558','Tunis, TN','Paris, FR','Parcel',4.5,'express',96.50,2,'Marseille Hub, FR',CURDATE()+INTERVAL 2 DAY,NOW())");
$p->exec("INSERT INTO events(shipment_id,label,at) VALUES(1,'Shipment Created',NOW()-INTERVAL 2 DAY),(1,'Picked Up',NOW()-INTERVAL 1 DAY),(1,'In Transit',NOW()-INTERVAL 3 HOUR)");
$p->exec("INSERT INTO locations(name,city,country,zip,address,hours) VALUES('SwiftEx Tunis Centre','Tunis','Tunisia','1001','12 Av. Habib Bourguiba','Mon-Sat 8-19'),('SwiftEx Paris Opera','Paris','France','75009','8 Rue Scribe','Mon-Fri 8-20'),('SwiftEx Lyon Part-Dieu','Lyon','France','69003','5 Rue Garibaldi','Mon-Sat 9-19'),('SwiftEx Dubai Hub','Dubai','UAE','00000','Jebel Ali Free Zone','24/7')");}
echo 'Installation OK. <a href="index.php">Accueil</a> — demo@swiftex.com / demo1234';
