<?php
require 'Opinion.php';
$op = new Opinion();
$op->addToIndex('pol/rt-polaritydata/rt-polarity.neg', 'neg');
$op->addToIndex('pol/rt-polaritydata/rt-polarity.pos', 'pos');
$string = "Avatar had a surprisingly decent plot, and genuinely incredible special effects"; "\n"; "<br>";
echo "Classifying '$string' - " . $op->classify($string) . "\n";"<br>";
$string = "Twilight was an atrocious movie, filled with stumbling, awful dialogue, and ridiculous story telling."; "<br>";
echo "Classifying '$string' - " . $op->classify($string) . "\n";
?>