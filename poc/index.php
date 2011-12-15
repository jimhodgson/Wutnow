<? 
// figure out where in the series we are with this user
// if we're on the sixth step, show them the image upload
// -- otherwise --
// go to the database to get the image
// update our series position and send user onward
$bot_image = "image2.png"; 
$top_image = "image.png"; 
	// figure out how big divs need to be based on image size
	$imginfo = getimagesize($bot_image);
	$imgwidth = $imginfo[0];
	$imgheight = $imginfo[1];
?><html>
<head>
<title>Website Usability Tester</title>
<link rel="stylesheet" href="../styles.css" type="text/html" media="screen">
<script type="text/javascript" src="/smt/core/js/smt-aux.min.js"></script>  
  <script type="text/javascript" src="/smt/core/js/smt-record.min.js"></script>
  <script type="text/javascript">
  try {
    smt2.record({
      trackingServer: "/smt/",
      recTime: 10,
      disabled: Math.round(Math.random()),
    });
  } catch(err) {
    txt="There was an error on this page.\n\n";
    txt+="Error description: " + err.description + "\n\n";
    txt+="Click OK to continue.\n\n";
    alert(txt);
  }
  </script>
<script type="text/javascript"> 
// Simple follow the mouse script
 
var divName = 'top'; // div that is to follow the mouse
                       // (must be position:absolute)
var offX = -160;          // X offset from mouse position
var offY = -120;          // Y offset from mouse position
function mouseX(evt) {if (!evt) evt = window.event; if (evt.pageX) return evt.pageX; else if (evt.clientX)return evt.clientX + (document.documentElement.scrollLeft ?  document.documentElement.scrollLeft : document.body.scrollLeft); else return 0;}
function mouseY(evt) {if (!evt) evt = window.event; if (evt.pageY) return evt.pageY; else if (evt.clientY)return evt.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop); else return 0;}
 
function follow(evt) {
  if (document.getElementById) {
    var obj = document.getElementById(divName).style; 
    obj.visibility = 'visible';
    x = (parseInt(mouseX(evt))+offX);
    y = (parseInt(mouseY(evt))+offY);
    if (x < 0) { x = 0; }
    if (y < 0) { y = 0; }
    obj.left = x + 'px';
    obj.top = y + 'px';
 
    //obj.backgroundPosition = '-' + obj.left + ' -' + obj.top;
    var imgwidth = <? echo $imgwidth; ?>;
    var margin = ((document.body.clientWidth - imgwidth) / 2);
    var bgpos = margin - x;
    obj.backgroundPosition = '' + bgpos + ' -' + obj.top;
    document.forms[0].elements['bgpos'].value = bgpos;
    document.forms[0].elements['xval'].value = x;
  }  
}
document.onmousemove = follow; 
</script> 
</head> 
<body style="padding: 0px; margin: 0px;"> 
<!--<?  print_r($imginfo); ?>< -->
<div id="bottom" style="margin: 0 auto; width: <? echo $imgwidth; ?>px; height:<? echo $imgheight; ?>px; background: url('<? echo $bot_image; ?>');">
</div>
<div id="top" style="position: absolute; border: 1px solid black; background: url('<? echo $top_image; ?>') no-repeat; width: 320px; height: 240px;">
<form>
bgpos: <input type="text" name="bgpos"> <br />
x value: <input type="text" name="xval">
</form>
</div>
</body>
</html>
