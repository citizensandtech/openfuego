<?php

echo("digraph follows {\n");

foreach(glob("./*.phpobj") as $filename){
  $data = unserialize(file_get_contents($filename));
  $username = substr($filename, 2,-18);
  foreach($data["ids"] as $id){
    echo($username." -> ". $id.";\n");
  }
}

echo("}");

?>
