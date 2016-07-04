<?php
require __DIR__ . '/vendor/autoload.php';

use philelson\Util\Transformer;

$t = new Transformer();
$t->run($argv);

?>