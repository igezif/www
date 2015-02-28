<?php
session_start();
$string = "";
$letters = array();
$lines = array();
$arcs = array();
$dir = "fonts/"; 
$image = imagecreatetruecolor(170, 60);
$bg = imagecolorallocate($image, 255, 155, 255); 
imagefilledrectangle($image, 0, 0, 170, 60, $bg);
for ($l = 0; $l < 7; $l++) {
	$lines[$l]["x1"] = mt_rand(0, imageSX($image));
	$lines[$l]["y1"] = mt_rand(0, imageSY($image));
	$lines[$l]["x2"] = mt_rand(0, imageSX($image));
	$lines[$l]["y2"] = mt_rand(0, imageSY($image));
	$lines[$l]["color"] = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	imageSetThickness($image, mt_rand(1, 3));
	imageLine($image, $lines[$l]["x1"], $lines[$l]["y1"], $lines[$l]["x2"], $lines[$l]["y2"], $lines[$l]["color"]);
}
for ($a = 0; $a < 7; $a++) {
	$arcs[$a]["x"] = mt_rand(0, imageSX($image));
	$arcs[$a]["y"] = mt_rand(0, imageSY($image));
	$arcs[$a]["width"] = mt_rand(0, imageSX($image));
	$arcs[$a]["height"] = mt_rand(0, imageSY($image));
	$arcs[$a]["u1"] = mt_rand(0, 360);
	$arcs[$a]["u2"] = mt_rand(0, 360);
	$arcs[$a]["color"] = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	imageSetThickness($image, mt_rand(1, 3));
	imageArc($image, $arcs[$a]["x"], $arcs[$a]["y"], $arcs[$a]["width"], $arcs[$a]["height"], $arcs[$a]["u1"], $arcs[$a]["u2"], $arcs[$a]["color"]);
}
for ($p = 0; $p < 999; $p++) {
	$x = mt_rand(0, imageSX($image));
	$y = mt_rand(0, imageSY($image));
	$color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	imageSetPixel($image, $x, $y, $color);
}	
for ($s = 0; $s < 5; $s++) {
	$letters[$s]["size"] = mt_rand(25, 35);
	$letters[$s]["corner"] = mt_rand(-20, 20);
	if ($s === 0) $letters[$s]["x"] = 10;
	else $letters[$s]["x"] = $s * 35;
	$letters[$s]["color"] = imagecolorallocate($image, 255, 255, mt_rand(0, 255));
	$letters[$s]["sym"] = chr(mt_rand(97, 122));
	imagettftext ($image, $letters[$s]["size"], $letters[$s]["corner"], $letters[$s]["x"], 40, $letters[$s]["color"], $dir."verdana.ttf", $letters[$s]["sym"]);
	$string .= $letters[$s]["sym"];
}
$_SESSION["key"] = $string;

header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>