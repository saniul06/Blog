<?php
class Format
{
    public function formatDate($date)
    {
        return date('F j, Y, g:i a', strtotime($date));
    }

    public function textShorten($text, $limit = 375)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, " "));
        $text = $text . ".....";
        return $text;
    }

    public function validation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function title()  //FOR THE PAGES WHICH IS NOT RETRIEVE FROM DATABASE MEANS MANUALLY INSERTED IN PHP FILE
    {
        $title = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($title, '.php');
        if ($title == 'index') {
            $title = 'Home';
        }
        return ucfirst($title);
    }
}
