<?php 


function formatDate($date)
{
    return implode("/", array_reverse(explode("-", $date)));
}