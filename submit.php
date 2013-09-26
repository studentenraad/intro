<?php
if (isset($_POST) && isset($_GET['type']) && $_GET['type'] == 'contact')
{
    @file_put_contents('.messages.txt', @file_get_contents('.messages.txt')."{$_POST['name']} - {$_POST['email']}\r\n{$_POST['message']}\r\n-------------\r\n");
    header('Location: /?submitted#help');
}
