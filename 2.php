<?php

const EXHIBITION_PICTURES = 80;
const PICTURES_WITH_FELT_TIP = 23;
const PICTURES_WITH_PEN = 40;
const PICTURES_WITH_PAINT = EXHIBITION_PICTURES - ( PICTURES_WITH_FELT_TIP + PICTURES_WITH_PEN);

$output = "There are " . "<b>" . EXHIBITION_PICTURES ."</b> pictures at the school exhibition. ";
$output .= "<b>" . PICTURES_WITH_FELT_TIP . "</b> of them have done with <b>felt-tip</b>,";
$output .= "<b>" . PICTURES_WITH_PEN . " have done with pencils</b> and the left ones with the <b>paints</b>.";
$output .= " How many pictures, have been done by the paints, at the school exhibition?<br>";

echo $output;
echo "Answer: " . PICTURES_WITH_PAINT;
