<html>
<head>
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</head>
<body>

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
$items = $fuego->getItems(21, 128, TRUE, TRUE); // quantity, hours, scoring, metadata

print '<pre>';
print_r($items);
print '</pre>';
?>

<hr>
<?php foreach ($items as $item){ ?>

<blockquote class="twitter-tweet">
<a href="https://twitter.com/x/status/<?=$item["tw_id_str"]?>"></a>
</blockquote> 

<?php } ?>

</body>
</html>
