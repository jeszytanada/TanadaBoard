<?php

function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}
function readable_text($s)
{
	$s = htmlspecialchars($s, ENT_QUOTES);
	$s = nl2br($s);
	return $s;
}

function notify($text, $notify_type = NULL)
{
    if ($notify_type === 'error') 
    {   $rep = "";
        return $rep="<center><font size=4 face=Arial color=green>" . $text . "</font></center>";
    }
  		return $rep="<center> <font size=4 face=Arial color=blue>" . $text . "</font></center>";
}

