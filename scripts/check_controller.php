<?php
require __DIR__ . '/../vendor/autoload.php';
$c = new App\Http\Controllers\Auth\RegisteredUserController();
// Show where the class is defined and list its methods
$ref = new ReflectionClass($c);
echo "Class file: " . $ref->getFileName() . PHP_EOL;
echo "Methods:\n";
print_r($ref->getMethods());
echo "Has create? ";
var_dump($ref->hasMethod('create'));
