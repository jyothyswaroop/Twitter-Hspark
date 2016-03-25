<?php

require_once('twitter-api-php-master/TwitterAPIExchange.php');
$settings = array(
	'oauth_access_token' => "519161545-9psDHkEvfdol1nruVZsCA3Kwzn89ijEgyztBPRKJ",
	'oauth_access_token_secret' => "qU1uRQucrzffB4I1KsnqSCyONkMJ8LGx5WSmoeq8VwKbM",
	'consumer_key' => "x0yWK4kMFQCXwSRVdmVTo59eY",
	'consumer_secret' => "QY2wfExgKWP6whWp6JpEqUzUaqr4dgIA9VudmIRUHTOchLdxqr"
	);
	

$searchWord = "furious7";	
echo $searchWord;
$url = 'https://api.twitter.com/1.1/search/tweets.json';
//$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$getfield = '?q='.$searchWord.'&count=100';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
//print_r($twitter);
$response = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);  
 //print_r($response);
 $goodStrings= array('good','awesome');
 $badStrings = array('bad');
 $good=0;
 $bad=0;
 for($i=0;$i<100;$i++){
	echo $response['statuses'][$i]['text'] . "<br>";
	
/*	foreach($goodStrings as $goodWord){
		if(stripos($response['statuses'][$i]['text'],$goodWord)!==false)
			$good++;
	}
	foreach($badStrings as $badWord){
		if(stripos($response['statuses'][$i]['text'],$badWord)!==false)
		$bad++;
	}*/
}

echo "good: ";
echo $good . "<br>";
echo "bad: ";
echo $bad;
?>