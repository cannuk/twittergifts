<?php 
include_once('Services/Twitter.php');

try {
  // initialize service object
  // perform login
  $service = new Services_Twitter('HelpfulSweater', '853Gifts79#');
	print_r($service);
  
  // update status
  $service->statuses->update('Having dinner with friends');
   
  // perform logout
  $service->account->end_session();
} catch (Exception $e) { 
  die('ERROR: ' . $e->getMessage());
}
?>