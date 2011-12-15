<?
session_start();
if ($_SESSION['views'] ) { 
   $_SESSION['views']++;
   } else { 
   $_SESSION['views'] = 1; // store session data
   }
echo "Pageviews = ". $_SESSION['views']; //retrieve data
?>


