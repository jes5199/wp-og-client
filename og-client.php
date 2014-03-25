<?php
require "vendor/autoload.php";

function get_og($url){
  $html = file_get_contents($url);

  $dom = HTML5::loadHTML($html);

  $results = array();

  foreach($dom->getElementsByTagName('meta') as $meta_tag) { 
    $name = $meta_tag->getAttribute("property");
    $value = $meta_tag->getAttribute("content");
    if(preg_match("/^og:/", $name)){
      $property = preg_replace("/^og:/", "", $name);
      $results[$property] = $value;
    }
  }

  return($results);
}

function postify_og($og){
  $title = $og["title"];
  $body = "";

  if($og["image"]){
    $body .= "<img src=\"" . $og["image"] . "\"><br>\n";
  }

  $body .= $og["description"];

  $document = array(
    "title" => $title,
    "body" => $body,
  );

  return($document);
}

print_r(postify_og(get_og("http://www.rottentomatoes.com/m/matrix/")));

?>
