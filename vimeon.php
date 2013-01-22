<?php
/* 
RETURNED DATA FROM THE VIMEO API:
[
  {
    "id":4530033,
    "title":"Anchored",
    "description":"My senior thesis film made at Ringling College of Art and Design.<br \/>\n<br \/>\nMusic by Mika<br \/>\n<br \/>\nRomans 15:13 May the God of hope fill you with all joy and peace as you trust in him, so that you may overflow with hope by the power of the Holy Spirit.<br \/>\n<br \/>\nmore concept art for the film @ http:\/\/webspace.ringling.edu\/~lolivare\/magic\/thesis.html<br \/>\n<br \/>\nwww.lindseyolivares.blogspot.com",
    "url":"http:\/\/vimeo.com\/4530033",
    "upload_date":"2009-05-07 10:56:45",
    "thumbnail_small":"http:\/\/b.vimeocdn.com\/ts\/223\/838\/22383872_100.jpg",
    "thumbnail_medium":"http:\/\/b.vimeocdn.com\/ts\/223\/838\/22383872_200.jpg",
    "thumbnail_large":"http:\/\/b.vimeocdn.com\/ts\/223\/838\/22383872_640.jpg",
    "user_id":1707000,
    "user_name":"lindsey olivares",
    "user_url":"http:\/\/vimeo.com\/lindseyolivares",
    "user_portrait_small":"http:\/\/b.vimeocdn.com\/ps\/390\/264\/3902641_30.jpg",
    "user_portrait_medium":"http:\/\/b.vimeocdn.com\/ps\/390\/264\/3902641_75.jpg",
    "user_portrait_large":"http:\/\/b.vimeocdn.com\/ps\/390\/264\/3902641_100.jpg",
    "user_portrait_huge":"http:\/\/b.vimeocdn.com\/ps\/390\/264\/3902641_300.jpg",
    "stats_number_of_likes":535,
    "stats_number_of_plays":45570,
    "stats_number_of_comments":45,
    "duration":173,
    "width":640,
    "height":368,
    "tags":"Ringling College of Art + Design, Animation, Animated short, 3d, Maya, Lindsey Olivares",
    "embed_privacy":"anywhere"
  }
]

Call this script like this: 
http://whereitishosted.com/vimeon.php?id=4530033&thumb_size=small
*/

// $id = '4530033';
$result = preg_match('/(\d+)/', $_GET['id'], $matches);
if ($result) {
  $id = $matches[0];
} else {
  die; // it wasn't passed a proper ID
}
$thumb_sizes = array('small', 'medium', 'large');

if (isset($_GET['thumb_size']) && in_array($_GET['thumb_size'], $thumb_sizes))
  $thumb_size = $_GET['thumb_size'];
else 
  $thumb_size = 'medium'; 

$response = json_decode(@file_get_contents("http://vimeo.com/api/v2/video/$id.json"));

if (isset($response[0]) && isset($response[0]->{'thumbnail_'.$thumb_size})) {
  $img_url = $response[0]->{'thumbnail_'.$thumb_size};
  $img_content = @file_get_contents($img_url);

  // send a JPEG image
  header("Content-Type: image/jpeg"); 
  echo $img_content;
}





