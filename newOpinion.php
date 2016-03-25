<?php
require 'Opinion.php';
require_once('twitter-api-php-master/TwitterAPIExchange.php');
$op = new Opinion();
$op->addToIndex('pol/rt-polaritydata/rt-polarity.neg', 'neg', 5000);
$op->addToIndex('pol/rt-polaritydata/rt-polarity.pos', 'pos', 5000);
$i = 0; $t = 0; $f = 0;
$fh = fopen('pol/rt-polaritydata/rt-polarity.neg', 'r');
while($line = fgets($fh)) {
        if($i++ > 5001) {
                if($op->classify($line) == 'neg') {
                        $t++;
                } else {
                        $f++;
                }
        }
}
$lh = fopen('pol/rt-polaritydata/rt-polarity.neg', 'r');
while($tweet = fgets($lh)) {
        if($i++ > 5001) {
                if($op->classify($tweet) == 'neg') {
                        $t++;
                } else {
                        $f++;
                }
        }
}
echo "Accuracy: " . ($t / ($t+$f));
?>