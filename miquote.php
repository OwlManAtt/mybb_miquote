<?php
$plugins->add_hook("parse_message_start", "miquote_run");
function miquote_info()
{
    return array(
        "name"      => "Miquote",
        "description"   => "Adds miquote as an alias for quote.",
        "website"       => "http://github.com/OwlManAtt/mybb_miquote",
        "author"        => "owlmanatt",
        "authorsite"    => "http://github.com/OwlManAtt",
        "version"       => "1.0",
        "guid"      => "2e1b65f2-9431-4ecb-b063-45f1172b2c21",
        "compatibility" => "16*"
    );
}

// These stubs are probably important or something.
function miquote_activate()
{
}
function miquote_deactivate()
{
}

function miquote_run($message)
{
    // Supports all of these arguments: [miquote='Boten Anna' pid='1238' dateline='1284071204']
    // Regexp fucking stolen from <http://mods.mybb.com/view/spoiler-bbcode> because I 
    // would rather be playing Minecraft. 
    $pattern = array("#\[miquote=(?:&quot;|\"|')?(.*?)[\"']?(?:&quot;|\"|')?\](.*?)\[\/miquote\](\r\n?|\n?)#si", "#\[miquote\](.*?)\[\/miquote\](\r\n?|\n?)#si");

    $replace = array('[quote=$1]$2[/quote]','[quote]$1[/quote]');

    while(preg_match($pattern[0], $message) or preg_match($pattern[1], $message))
    {
        $message = preg_replace($pattern, $replace, $message);
    }

    return $message;
}
?>
