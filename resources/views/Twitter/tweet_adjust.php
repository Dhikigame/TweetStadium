<?php
function source_adjust($sources){
    $count = 0;
    $pattern = "|<a href=\"(.*?)\".*?>(.*?)</a>|mis";
    foreach ($sources as $source){
        preg_match($pattern, $source, $matches);
        $source_store[$count]['url'] = $matches[1];
        $source_store[$count]['name'] = $matches[2];
        $count++;
    }
    return $source_store;
}

?>