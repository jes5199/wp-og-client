<?php
require "vendor/autoload.php";

function get_og($url){
  $html = file_get_contents($url);

  $dom = HTML5::loadHTML($html);

  $results = array("url" => $url);

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

function post_for_og_data($og){
  $title = $og["title"];
  $body = "";

  if($og["image"]){
    $body .= "<a href=\"" . $og["url"] . "\">";
    $body .= "<img ";

    if($og["image:width"]){
      $body .= "width=\"" . $og["image:width"] . "\"";
    }
    if($og["image:height"]){
      $body .= "height=\"" . $og["image:height"] . "\"";
    }

    $body .= "src=\"" . $og["image"] . "\" ";
    $body .= ">";
    $body .= "</a>\n";
    $body .= "<br>\n";
  }

  $body .= "<a href=\"" . $og["url"] . "\">";
  $body .= $og["description"];
  $body .= "</a>\n";

  $post = array(
    "post_title" => $title,
    "post_content" => $body,
  );

  return($post);
}

function post_for_og_url($url){
  return(post_for_og_data(get_og($url)));
}

//print_r(postify_og(get_og("http://www.rottentomatoes.com/m/matrix/")));

?>
