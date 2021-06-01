<?php
function clean_data($data, $flag = true)
{
    if ($flag == true) {
        return htmlspecialchars(trim($data));
    }else {
        strip_tags(trim($data));
    }
}

function decomposed_data($data, $clean = true, $flag = true) 
{
    foreach ($data as $key => $value) {
        $GLOBALS[$key] = ($clean) ? clean_data($value, $flag) : $value;
    }
}
