<?php
require 'Opinion.php';
require_once('twitter-api-php-master/TwitterAPIExchange.php');

$settings = array(
	'oauth_access_token' => "519161545-9psDHkEvfdol1nruVZsCA3Kwzn89ijEgyztBPRKJ",
	'oauth_access_token_secret' => "qU1uRQucrzffB4I1KsnqSCyONkMJ8LGx5WSmoeq8VwKbM",
	'consumer_key' => "x0yWK4kMFQCXwSRVdmVTo59eY",
	'consumer_secret' => "QY2wfExgKWP6whWp6JpEqUzUaqr4dgIA9VudmIRUHTOchLdxqr"
	);

$searchWord = "from:twitter since:2015-01-01 until:2015-04-30";	
$url = 'https://api.twitter.com/1.1/search/tweets.json';
//$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
//$getfield = '?include_entities=true&inc‌​lude_rts=true&since:2011-05-16&until:2011-08-16';
$getfield = '?q='.$searchWord.'&count=300&lang=en';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);  
$op = new Opinion();
$op->addToIndex('rt-polarity.neg', 'neg');
$op->addToIndex('rt-polarity.pos', 'pos');
//print_r($response);
 for($i=0;$i<100;$i++){
 $string= $response['statuses'][$i]['text'];
 //print_r($response['statuses'][$i]);
 echo $response['statuses'][$i]['created_at'] . " " . $response['statuses'][$i]['user']['location'];
echo "<br>Classifying '$string' - " . $op->classify($string) . "<br><br>";
}

?>