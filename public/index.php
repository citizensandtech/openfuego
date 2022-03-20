<html>
  <head>
    <title>AIGovTweets Fuego</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Twitter links from people sharing the science and policy of algorithms.">
    <link rel="icon" href="/images/4949-fuego-logo-32x32.ico">


    <script>
					window.onload = function () {
						document.querySelectorAll('.loadtweet').forEach(function(tweet) {
							// Now do something with my button
						  var id = tweet.getAttribute('tweetID');
					  	  twttr.widgets.createTweet(id, tweet, {
							  	conversation: 'none', // or all
								  cards: 'visible', // or visible
								  linkColor: '#cc0000', // default is blue
								  theme: 'light', // or dark
							  });
						});

					};
    </script>

  </head>

<?php

/**
  * The Getter object has one method:
  *
  * getItems($quantity, $hours, $scoring, $metadata)
  *
  * $quantity (int): Number of links desired. Default 20.
  * $hours (int): How far back to look for links. Default 24.
  * $scoring (bool): TRUE to employ  "freshness vs. quality" algorithm
  *   or FALSE to simply return most frequently tweeted links. Default TRUE.
  * $metadata (bool): TRUE to hydrate URLs with Embed.ly metadata.
  *   An API key must be set in config.php. Default FALSE.
 */

require(__DIR__ . '../../init.php');
use OpenFuego\app\Getter as Getter;

$fuego = new Getter();
$items = $fuego->getItems(20, 12, TRUE, TRUE); // quantity, hours, scoring, metadata
?>

  
    <div class="container">
      <!-- begin page contents -->

      <!-- page header -->
      <div class="jumbotron p-3 p-md-5 text-gray rounded bg-light">
        <div class="col-md-12 px-0">
          <img src="images/4949-fuego-logo-256x256.png" style="float:left; width:100px; height:100px; padding-right:10px;"/>
          <h3 class="display-5 font-italic">AI Governance Tweets</h3>
          <p class="lead my-3">Automatically-curating tweets by people involved in AI governance conversations. Bot managed by <a class="" href="https://twitter.com/natematias">@natematias</a> &amp Cornell students in <a class="" href="https://github.com/natematias/governing-human-algorithm-behavior">COMM 4949: Governing Human-Algorithm Behavior</a>.</p>
        </div>
      </div>

      <! -- listing of links -->
      <?php 
        $i = 0;
        foreach ($items as $item){ 
      ?>
        <?php if($i != 0 && $i % 2 == 0){?>
        </div>
        <?php } ?>
        <?php if($i % 2 == 0){?>
        <div class="row mb-2">
        <?php } ?>
          <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
              <div class="card-body d-flex flex-column align-items-sta8rt">
              <!--<h3 class="mb-0">
                <a class="text-dark" href="#">Featured post</a>
              </h3>-->
              
			  <strong class="text-primary"><img style="float:left;width:50px;height:50px; padding-right:5px;" src='<?= $item["tw_profile_image_url"] ?>'> 
          <button type="button" class="btn btn-primary"><?=$item["weighted_count"]?></button>
          <?= $item["first_user"] ?>
          <small class="text-muted"><a class="text-muted" href="https://twitter.com/<?=$item["tw_screen_name"]?>/status/<?= $item["tw_id_str"]?>"><?=date('d M Y H:i:s Z',$item["first_seen"]) ?></a> <a href='<?=$item["url"]?>'>🔗</a></small>
        </strong>
	      <!--<a href='https://twitter.com/x/status/<?= $item["tw_id_str"] ?>'>See the first tweet</a>-->
        <div class="loadtweet" tweetID="<?=$item["tw_id_str"]?>"></div>

              <!--<p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>-->
            </div>
          </div>
        </div>

      <?php $i += 1; ?>
      <?php } ?>
    </div> <!-- end row after loop ends-->

    <!-- end page contents-->
    </div>


</html>
