<?php
//require 'front.php';
require 'Opinion.php';
require_once('twitter-api-php-master/TwitterAPIExchange.php');
$settings = array(
	'oauth_access_token' => "519161545-9psDHkEvfdol1nruVZsCA3Kwzn89ijEgyztBPRKJ",
	'oauth_access_token_secret' => "qU1uRQucrzffB4I1KsnqSCyONkMJ8LGx5WSmoeq8VwKbM",
	'consumer_key' => "x0yWK4kMFQCXwSRVdmVTo59eY",
	'consumer_secret' => "QY2wfExgKWP6whWp6JpEqUzUaqr4dgIA9VudmIRUHTOchLdxqr"
	);
	$profpic ="bg.jpg";
$searchWord ="movie_name";
//$searchWord = "americansniper";	

$searchWord = $_GET['movie_name'];
?>
<!DOCTYPE html>

<html>
<head>
	<title> Movie Tweets</title>
	<link rel= "stylesheet" text = "css/type" href= "css/tweets.css"></link>

</head>
<body>

    <!-- <img src="img/bg.jpg" width="1500" height= "1000". alt="picture of a movie">
     <!--Accessbiltiy--> 
<form id="searchbox" action="index.php">
    <input id="search" type="text" placeholder="search for a movie" name="movie_name">
    <input id="submit" type="submit" value="Search">
</form>


</body>

</html>

<?php

echo "<br>";
echo $searchWord;
echo "<br>";
echo "<br>";
$url = 'https://api.twitter.com/1.1/search/tweets.json';
//$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$getfield = '?q='.$searchWord.'&count=1000&lang=en';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
//print_r($twitter);
$response = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);  
 //print_r($response);

 $op = new Opinion();
$op->addToIndex('rt-polarity.neg', 'pos');
$op->addToIndex('rt-polarity.pos', 'neg');
 
 $pos=0;
 $neg=0;

 for($i=0;$i<100;$i++){
	$string= $response['statuses'][$i]['text'] . "<br>";
	$string = preg_replace('/#([\w-]+)/i', '', $string); // @someone
$string = preg_replace('/@([\w-]+)/i', '', $string); // #tag
$string = preg_replace('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '', $string);
//	echo $response['statuses'][$i]['created_at'] . " " . $response['statuses'][$i]['user']['location'];
echo "<br>Classifying '$string' - " . $op->classify($string) . "<br><br>";

if($op->classify($string)=="pos")
{
$pos ++;
}

if($op->classify($string)=="neg")
{
 $neg ++;
}
	
/*	foreach($string as $goodWord){
		if(stripos($response['statuses'][$i]['text'],$goodWord)!==false)
			$good++;
	}
	foreach($badStrings as $badWord){
		if(stripos($response['statuses'][$i]['text'],$badWord)!==false)
		$bad++;
	}*/
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

echo "pos:";
echo $pos."<br>";
echo "neg:";
echo $neg;
?>