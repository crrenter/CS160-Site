<?php
include("dbconnect.php");

?>

<html>

<head>
  <title> Science Search </title>
</head>

<body bgcolor="7FFFD4">
  
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=145443995467203";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    
<style type="text/css">
html {
	overflow-y: scroll;
	}
h1 { font-size: 60px; }
    #myFixedDivTopLeft {
        position: fixed;
        top: 0;
        left: 0;
        ...
    }
    #myFixedDivTopRight {
        position: fixed;
        top: 0;
        right: 0;
        ...
    }
    #myFixedDivBottomRight {
        position: fixed;
        bottom: 0;
        right: 0;
		z-index: -1;
        ...
    }
    #myFixedDivBottomLeft1 {
        position: fixed;
        bottom: 0;
        left: 0;
		z-index: -2;
    }
    #myFixedDivBottomLeft2 {
        position: fixed;
        bottom: 12;
        left: 240;
		z-index: -2;
    }
    #myFixedDivBottomLeft3 {
        position: fixed;
        bottom: 12;
        left: 420;
		z-index: -2;
    }
    #myFixedDivBottomLeft4 {
        position: fixed;
        bottom: 12;
        left: 515;
		z-index: -2;
    }

	

nav ul ul {
	display: none;
}

	nav ul li:hover > ul {
		display: block;
	}

nav ul {
        background: #efefef;	 
	background: linear-gradient(top, #efefef 0%, #bbbbbb 100%);  
	background: -moz-linear-gradient(top, #efefef 0%, #bbbbbb 100%); 
	background: -webkit-linear-gradient(top, #efefef 0%,#bbbbbb 100%); 
	box-shadow: 0px 0px 9px rgba(0,0,0,0.15);
	padding: 0 20px;
	border-radius: 10px;  
	list-style: none;
	position: relative;
	display: inline-table;
}
	nav ul:after {
		content: ""; clear: both; display: block;
	}

nav ul li {
	float: left;
}
	nav ul li:hover {
		background: #4b545f;
		background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
		background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
		background: -webkit-linear-gradient(top, #4f5964 0%,#5f6975 40%);
	}
		nav ul li:hover a {
			color: #fff;
		}
	
	nav ul li a {
		display: block; padding: 25px 40px;
		color: #757575; text-decoration: none;
	}
nav ul ul {
	background: #5f6975; border-radius: 0px; padding: 0;
	position: absolute; top: 100%;
	width: 200px;
	font-size: .8em;
}
	nav ul ul li {
		float: none; 
		border-top: 1px solid #6b727c;
		border-bottom: 1px solid #575f6a;
		position: relative;
	}
		nav ul ul li a {
			padding: 10px 10px;
			color: #fff;
		}	
			nav ul ul li a:hover {
				background: #4b545f;
			}
nav ul ul ul {
	position: absolute; left: 100%; top:0;
}

</style>


<h1 align="center" style="font-family:tempus sans itc;"> Science Search </h1>


<img src="qr_code.jpg" id="myFixedDivBottomRight" align="right" style="width:150px;height:150px">
    

<h2 style="font-family:tempus sans itc;" align="center">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
    
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Category<span class="caret"></span></a>
          <ul class="dropdown-menu">
                         
<?php 
    $array = array();
    $query = mysql_query("SELECT DISTINCT category FROM education");

    while($row = mysql_fetch_array($query)) {
        $result = $row['category'];
        $pos = strpos($result, " /");
        if ($pos == false) {
            $pos = strpos($result, "/");
            if ($pos == false)
                array_push($array, $result);
            else
                array_push($array, substr($result, 0, $pos));
        }
        else {
            array_push($array, substr($result, 0, $pos));
        }
    }
    $arrayu = array_unique($array);

    foreach($arrayu as $category) {
    echo "<li><a href='result.php?category=".urlencode($category)."'>".$category."</a></li>";
    }
?>
  </ul>
 </li>
<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Grade<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="result.php?grade=K">K </a></li>
            <li><a href="result.php?grade=1">Grade 1</a></li>
            <li><a href="result.php?grade=2">Grade 2</a></li>
            <li><a href="result.php?grade=3">Grade 3 </a></li>
            <li><a href="result.php?grade=4">Grade 4</a></li>
            <li><a href="result.php?grade=5">Grade 5</a></li>
            <li><a href="result.php?grade=6">Grade 6</a></li>
            <li><a href="result.php?grade=7">Grade 7</a></li>
            <li><a href="result.php?grade=8">Grade 8 </a></li>
            <li><a href="result.php?grade=9">Grade 9</a></li>
            <li><a href="result.php?grade=10">Grade 10</a></li>
            <li><a href="result.php?grade=11">Grade 11</a></li>
            <li><a href="result.php?grade=12">Grade 12</a></li>

          </ul>
        </li>
        <li><a href="#">About Us</a></li>        
      </ul>
    </div>
  </div>
</nav>



<form align="center" action="result.php" method ="get">
  Search: <input type="text" name="Search">
  <input type="submit" value="Submit">
</form>


<form id="myFixedDivTopRight" align="right" action="demo_form.asp">
  Username: <input type="text" name="Username"><br>
  Password: <input type="text" name="Password"><br>
  <button type="button">Sign Up</button>
  <button type="button">Login!</button>
</form>


<div class="fb-like" data-href="http://www.sjsu-cs.org/cs160/sec1group3/" data-width="240" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" id="myFixedDivBottomLeft1"></div>

<div id="myFixedDivBottomLeft2">
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300"></div>
</div>

<div id="myFixedDivBottomLeft3">
<a href="https://twitter.com/share" class="twitter-share-button"  >Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs'); </script>
</div>


<a href="mailto:?subject=FW: This website is cool!
&body=http://www.sjsu-cs.org/cs160/sec1group3/" id="myFixedDivBottomLeft4"><button type="button">Forward to my friend</button></a>


<div>
<!--[if IE]>
<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" width="0" height="0">
 <param name="src" value="topgun.mp3">
 <param name="controller" value="false">
 <param name="autoplay" value="true">
 <param name="loop" value="false">
</object>
<a href="view.php" align="center">Read Education!</a>
<![endif]-->

<!--[if !IE]><!-->
<object type="audio/x-mpeg" data="topgun.mp3" width="0" height="0">
 <param name="src" value="topgun.mp3">
 <param name="controller" value="false">
 <param name="autoplay" value="true">
 <param name="loop" value="false">
</object>
<!--><![endif]-->
</div>

</body>
</html>
