<?php

// Copyright (C) 2023 Nurudin Imsirovic <github.com/oxou>
//
// Prepare the list of posts from ./data/posts.json to be
// referenced in ./posts.html for those browsing the blog
// without JavaScript enabled.  Don't be crazy and enable
// JavaScript.  Thanks.
//
// Created: 2023-06-29 05:39 PM
// Updated: 2023-06-29 06:19 PM

// Return codes
// 1 = json_decode not found
// 2 = ./data/posts.json not found
// 4 = ./posts.html.tpl not found

$html_buffer = "";

function _error($a) {
    printf("\033[31m[ERROR]\033[0m $a\n");
}

if (!function_exists("json_decode")) {
    _error("json_decode() does not exist. Can't decode JSON.");
    exit(1);
}

function _html_write_entry($a, $b, $c) {
    return sprintf('<a href="/data/post/'.$a.'/index.md" download="'.$a.'.md">DOWNLOAD</a> - <a href="/data/post/'.$a.'/index.md"><b>'.$b.'</b> '.$c.'</a><br>');
}

// JSON must exist
if (!file_exists("./data/posts.json")) {
    _error("./data/posts.json does not exist. Cannot retrieve list of posts.");
    exit(2);
}

// Posts template must exist
if (!file_exists("./posts.html.tpl")) {
    _error("./posts.html.tpl does not exist. Cannot build posts.html.");
    exit(4);
}

$template = file_get_contents("./posts.html.tpl");
$data = file_get_contents("./data/posts.json");
$data = json_decode($data, JSON_OBJECT_AS_ARRAY);

foreach ($data as $json_obj) {
    $html_buffer .= _html_write_entry(
        $json_obj["id"],
        $json_obj["date"],
        $json_obj["title"]
    );
}

// Write posts.html
$new_data = str_replace("{{posts}}", $html_buffer, $template);

// Convert tabs to spaces
$new_data = str_replace("\t", ' ', $new_data);

// Convert CRLF to LF
$new_data = str_replace(
    array("\r\n", "\r"),
    array("\n", ''),
    $new_data
);

// Get rid of tabs
while (strpos($new_data, "\n ") !== false) {
    $new_data = str_replace("\n ", "\n", $new_data);
}

// Finally destroy all newlines
$new_data = str_replace(
    array("\r\n", "\r", "\n"),
    array(''),
    $new_data
);

// Write file
file_put_contents("./posts.html", $new_data);
echo "OK\n";

?>
