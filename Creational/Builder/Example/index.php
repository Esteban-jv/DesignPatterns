<h1> Builder Pattern Example</h1>
<?php
require_once __DIR__ . '/MySQLQueryBuilder.php';
require_once __DIR__ . '/MongoQueryBuilder.php';
require_once __DIR__ . '/Director.php';

// Comienza código cliente (Construcción de objetos)
//$builder = new MySQLQueryBuilder('users');
//$builder
//    ->select(['name', 'email'])
//    ->where('id', '>', '100')
//    ->where('status', '=', 'active')
//    ->orderBy('id')
//    ->orderBy('name', 'DESC')
//    ->limit(5);
// Salida
//echo "<pre>".$builder->getQuery()."</pre>";


// Construcción de objetos con el Director
$director = new Director(
    new MongoQueryBuilder('users')
);

// Salida
echo "<pre>".$director->getActiveUsers()."</pre>";

?>