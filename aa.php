<?php

$a = ['4','3','2','1'];
$w = count($a);
$e = $w-1;
do
            {
                $x=0;
                $s = array_shift($a);
                $a [] = $s;
                $x++;
            }
while ($x != $e);
var_dump($a);