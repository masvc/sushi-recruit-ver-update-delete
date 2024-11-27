<?php

$position = $_POST["position"];
$area = $_POST["area"];
$jd = $_POST["jd"];
$c = ",";

$jobdata =  $position . $c . $area . $c . $jd;

$fp = fopen("data.csv", "a");
fwrite($fp, $jobdata . "\n");
fclose($fp);

header("Location: admin.php");
