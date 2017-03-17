<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * rss订阅类
 * 生成feed
 * @author WZR <monkeywzr@gmail.com>
 */
/* 实例 -----------------------------------------------
    $feed = new RSS();
    $feed->title       = "RSS Feed 标题";
    $feed->link        = "http://runoob.com";
    $feed->description = "RSS 订阅列表描述。";

    $db->query($query);  // 数据库查询
    $result = $db->result;
    while($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $item = new RSSItem();
        $item->title = $title;
        $item->link  = $link;
        $item->setPubDate($create_date); 
        $item->description = "<![CDATA[ $html ]]>";
        $feed->addItem($item);
    }
    echo $feed->serve();
---------------------------------------------------------------- */

class RSS
{
    public $title;
    public $link;
    public $description;
    public $language = "en-us";
    public $pubDate;
    public $items;
    public $tags;

    function __construct()
    {
        $this->items = array();
        $this->tags  = array();
    }

    function addItem($item)
    {
        $rssitem = new RSSItem();
        // var_dump($rssitem);
        $rssitem->title = $item['title'];
        $rssitem->link  = $item['link'];
        $rssitem->description = $item['description'];
        $rssitem->setPubDate($item['create_date']);
        $rssitem->description = "<![CDATA[ {$item['description']} ]]>";
        $this->items[] = $rssitem;
    }

    function setPubDate($when)
    {
        if(strtotime($when) == false)
            $this->pubDate = date("D, d M Y H:i:s ", $when) . "GMT";
        else
            $this->pubDate = date("D, d M Y H:i:s ", strtotime($when)) . "GMT";
    }

    function getPubDate()
    {
            if(empty($this->pubDate))
            return date("D, d M Y H:i:s ") . "GMT";
        else
            return $this->pubDate;
    }

    function addTag($tag, $value)
    {
        $this->tags[$tag] = $value;
    }

    function out()
    {
        $out  = $this->header();
        $out .= "<channel>\n";
        $out .= "<title>" . $this->title . "</title>\n";
        $out .= "<link>" . $this->link . "</link>\n";
        $out .= "<description>" . $this->description . "</description>\n";
        $out .= "<language>" . $this->language . "</language>\n";
        $out .= "<pubDate>" . $this->getPubDate() . "</pubDate>\n";

        foreach($this->tags as $key => $val) $out .= "<$key>$val</$key>\n";
        foreach($this->items as $item) $out .= $item->out();

        $out .= "</channel>\n";

        $out .= $this->footer();

        $out = str_replace("&", "&amp;", $out);

        return $out;
    }

    function serve()
    {
        $xml = $this->out();
        return $xml;
    }

    function header()
    {
        $out  = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
        $out .= '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">' . "\n";
        return $out;
    }

    function footer()
    {
        return '</rss>';
    }
}

class RSSItem
{
    public $title;
    public $link;
    public $description;
    public $pubDate;
    public $guid;
    public $tags;
    public $attachment;
    public $length;
    public $mimetype;

    function RSSItem()
    { 
        $this->tags = array();
    }

    function setPubDate($when)
    {
        if(strtotime($when) == false)
            $this->pubDate = date("D, d M Y H:i:s ", $when) . "GMT";
        else
            $this->pubDate = date("D, d M Y H:i:s ", strtotime($when)) . "GMT";
    }

    function getPubDate()
    {
        if(empty($this->pubDate))
            return date("D, d M Y H:i:s ") . "GMT";
        else
            return $this->pubDate;
    }

    function addTag($tag, $value)
    {
        $this->tags[$tag] = $value;
    }

    function out()
    {
        $out = "<item>\n";
        $out .= "<title>" . $this->title . "</title>\n";
        $out .= "<link>" . $this->link . "</link>\n";
        $out .= "<description>" . $this->description . "</description>\n";
        $out .= "<pubDate>" . $this->getPubDate() . "</pubDate>\n";

        if($this->attachment != "")
            $out .= "<enclosure url='{$this->attachment}' length='{$this->length}' type='{$this->mimetype}' />";

        if(empty($this->guid)) $this->guid = $this->link;
        $out .= "<guid>" . $this->guid . "</guid>\n";

        foreach($this->tags as $key => $val) $out .= "<$key>$val</$key\n>";
        $out .= "</item>\n";
        return $out;
    }

    function enclosure($url, $mimetype, $length)
    {
        $this->attachment = $url;
        $this->mimetype   = $mimetype;
        $this->length     = $length;
    }
}
