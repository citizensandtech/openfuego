<?php namespace OpenFuego\lib;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterHandle extends TwitterOAuth {

	private $consumerKey;
	private $consumerSecret;
	private $accessToken;
	private $accessTokenSecret;

	public function __construct() {

		$this->consumerKey = \OpenFuego\TWITTER_CONSUMER_KEY;
		$this->consumerSecret = \OpenFuego\TWITTER_CONSUMER_SECRET;
		$this->accessToken = \OpenFuego\TWITTER_OAUTH_TOKEN;
		$this->accessTokenSecret = \OpenFuego\TWITTER_OAUTH_SECRET;

		try {
			parent::__construct(
				$this->consumerKey,
				$this->consumerSecret,
				$this->accessToken,
				$this->accessTokenSecret
			);
		}

		catch (\PDOException $e) {
			Logger::error($e);
		}
	}
}
