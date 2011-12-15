<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
   // main logic
   if (isset($_SESSION['step'])) {
      $step = $_SESSION['step'];
      $_SESSION['step']++;
   } else { 
      $step = 0;
      $_SESSION['step'] = 1;
   }

   //set step manually for testing

   if ($step == 0) { 
      stepzero(0);
   } elseif (($step > 0) && ($step < 6)) { 
      do_steps($step);
   } elseif ($step > 5) { 
      stepsix($step);
      unset($_SESSION['step']);
      session_destroy();
   }


   function progbar($step) { 
   ?><img src="/step<? echo $step; ?>.png" width="512" height="50"><?
   }


   function stepzero($step) {
      print_normal_header();
      ?>
      <div id="progbar">
      <? progbar($step); ?>
      </div>
      <div style="width: 800px;" id="steps">
      <p align="center" class="big">Welcome to Wutnow, the Web Usability Testing Tool
      </p><p>
      Okay, great! We're about to get started. 
      </p>
      </div>
      <?
      print_footer();
   }

   function do_steps($step) { 
      print_normal_header();
      ?><div id="progbar">
      <? progbar($step); ?>
      </div>
      <div style="width: 800px;" id="steps"><?
      echo "Step: ".$step;
      //get an image from the imqge queue
      //display it
      //move user along to the next step
      ?></div><?
      print_footer();
   }

   function stepsix($step) { 
   // if we've gone through all the viewing steps, take a file.
   // add that file to the queue.
if (isset($_FILES["file"])) { 
$maxfilesize = "500" * 1024; // 500k image size limit
?>
<div id="welcome">
<h1>File Upload</h1>
<?
      //?><pre><?
      //print_r($_FILES);
      //?></pre><?
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	&& ($_FILES["file"]["size"] < $maxfilesize)) {
	   if ($_FILES["file"]["error"] > 0) {
	      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	   } else {
         echo "Upload: " . $_FILES["file"]["name"] . "<br />";
         echo "Type: " . $_FILES["file"]["type"] . "<br />";
         echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
         echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

	      if (file_exists("images/" . $_FILES["file"]["name"])) {
	         echo $_FILES["file"]["name"] . " already exists. ";
	      } else {
	         move_uploaded_file($_FILES["file"]["tmp_name"],
	         "upload/" . $_FILES["file"]["name"]);
	         echo "Stored in: " . "images/" . $_FILES["file"]["name"];
	      }
	    }
	  } else {
	   echo "Invalid file ".$_FILES["file"]["size"];

	  }
?></div><?
} else { // ready for your screenshot

?>
      <div id="progbar">
      <? progbar($step); ?>
      </div>
<div id="welcome">
<h1>ut in der screenshote</h1>
<form method="post" action="<? echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<input type="file" name="file" id="file" size="25"><br />
<input type="submit" value="upload">
</form>
</div>
<?
print_footer();
}?>
<? } // end step 6

   function print_footer() { 
?></body>
</html><?
   }

   function print_normal_header() { 
?><html>
<head>
<title>Website Usability Tester</title>
<link rel="stylesheet" href="/styles.css" type="text/html" media="screen">
</head>
<body>
<?  }
