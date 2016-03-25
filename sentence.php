<?php
// … snip … article contents as $op setup
$sentences = explode(".", $doc);
//$temp = explode(" ",$sentences);
//foreach($temp as $temp2)
//{
//}
$score = array('pos' => 0, 'neg' => 0);
foreach($sentences as $sentence) {
        if(strlen(trim($sentence))) {
                $class = $op->classify($sentence);
                echo "Classifying: \"" . trim($sentence) . "\" as " . $class . "\n";
                $score[$class]++;
        }
}
var_dump($score);
?>