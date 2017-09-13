<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();

if(isset($_POST['LoginView::Logout']))
{
    unset($_SESSION['Username']);  
}
    else if(isset($_POST['LoginView::Login']))
{
    $_SESSION['Username'] = $_POST['LoginView::Login'];
    
}

//om man är inloggad eller inte 

if(isset($_SESSION['Username']))
{
    $lv->render(true, $v, $dtv);
}
else
{
    $lv->render(false, $v, $dtv);
}
