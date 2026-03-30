<?php
$SearchedTitle = Strtolower(str_replace(' ', '-', $_GET["query"])); 
header("Location: /search/".$SearchedTitle);