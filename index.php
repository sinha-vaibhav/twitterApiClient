<html>
<head>
  <title>Kayako Twitter Client</title>
</head>
<body>
  <p>
<h1>Retweeted Tweets of #custserv</h1>

    <?php
 require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class KayakoTwitterClient {
  
  // Configure values of the custkey, custSecret, accessToken and accessTokenSecret depending on your Twitter App
  // Generate credentials by going to https://dev.twitter.com/  -> Manage your apps -> Create a new App -> Create Access Tokens
  private $custKey = "2vi57rDcz8klo4JNQNq7tdMhi";
  private $custSecret = "hFeVuR1Zxg6HOG0OBVxqxLTX1ND9dcg9A4EiQzH9tWUZyyyyzi";
  private $access_token = "128640569-afTOYLxLrk78J68l7Z47n33yjIMiE3e3lIXQ5gRF";
  private $access_token_secret = "8nca21I9io9RiIjKa9R4uVAOO0AaV39mR5Zk6EUHUIaNz";

  private $connection;

  function __construct() {
    //using TwitterOauth for doing Oauth Authentication - https://twitteroauth.com/
    $this->connection = new TwitterOAuth($this->custKey, $this->custSecret, $this->access_token, $this->access_token_secret);

  }

  function getRetweetedTweetsByHashTag($tag) {

    $response = $this->connection->get("search/tweets", array("q" => "#".$tag));
    //get statuses having hash tag as defined by tag variable
    if ($this->connection->getLastHttpCode() == 200) {
    $retweetedTweets = array(); 
    $tweets = $response->statuses;  
      $arrlength = count($tweets);
      for($x = 0; $x < $arrlength; $x++) {
        
        if($tweets[$x]->retweet_count>0) {
          $retweetedTweets[$x] = $tweets[$x]->text;
        }
      }
      return $retweetedTweets;
  }
  else
      return "Connection/Credential Error";

  }
}

$client = new KayakoTwitterClient();
$retweetedTweets = $client->getRetweetedTweetsByHashTag("custserv");
foreach($retweetedTweets as $tweet) {

  echo $tweet."<br>";
}

?>
</p>
</body>
</html>