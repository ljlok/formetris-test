<?php
use MyLegacyProject\Manager\Helper\Helper;

session_start();

require_once __DIR__.'/../../vendor/autoload.php';
const TREE_DATA =  __DIR__.'/../../data/arbresremarquablesparis2011.json';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// TODO

?>
<?php include 'template/tree-base.php'?>

<h2>Get a random tree in Paris</h2>
<?php include 'template/tree-table.php'?>
<?php

$helper = new Helper();
$trees = $helper->loadJsonData(TREE_DATA);
$randomTree = $helper->getRandomTree($trees, 'A');
$helper->show($randomTree)
?>




<?php include 'template/tree-tail.php' ?>
