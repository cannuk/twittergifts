<?php


/*
who
twitterUser
totalItems
url
pronoun
*/

class TweetReply{
	const ROOT_PATH = "/cron/twittergifts/climax/";
	var $map = array(
		'who',
		'twitterUser',
		'totalItems',
		'url',
		'pronoun'
	);
	
	var $twitterReplies;
	
	public function __construct(){
		
		$this->getTweets();
		
	}
	
	private function orderReplacements($replacements){
		$rep = array();
		$cMap = array();
		$this->cMap = $this->map;
		foreach($this->map as $key => $value){
			
			if($replacements[$value]){
				$rep[] = $replacements[$value]; 
				$cMap[] = '%{' . $value .'}';
			}
			
		}	
		return array('map' => $cMap, 'values' => $rep);
	}
	
	private function getTweets(){
		$file = file_get_contents(ROOT_PATH . '../twitterReplies.js');
		//print_r($file);
		$this->twitterReplies = json_decode($file);
		
	}
	
	public function formatAskTweet($vals){
		$replace = $this->orderReplacements($vals);
		$tweet = $this->twitterReplies->ask[array_rand($this->twitterReplies->ask)];
		
		return str_replace($replace['map'], $replace['values'], $tweet);
	}
	
	public function formatSearchTweet($vals){
		$replace = $this->orderReplacements($vals);
		$tweet = $this->twitterReplies->search[array_rand($this->twitterReplies->search)];
		
		return str_replace($replace['map'], $replace['values'], $tweet);
		
	}
	
}



?>