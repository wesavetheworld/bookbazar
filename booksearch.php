<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>

	<title>bookbazar - find books and compare prices from different online book sellers in India</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<!--<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> -->

	<meta name="Keywords" content="Online Shopping, India, Books, FlipKart, infibeam, homeshop18, bookadda, uread, free, ebook, download" />

	<meta name="Description" content="find books online from different book sellers and compare their prices" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
 <script src="js/jquery.js"></script>
  <script src="js/bootstrap-modal.js"></script>
<style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 20px;
      }
    </style>

 <script> /*
$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id1');
     $(".modal-body #bookId").val( myBookId );
    $('#addBookDialog').modal('show');
});
*/
</script>


</head>
<body>
<?php
include_once('simple_html_dom.php');
?>
<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
    <center><form name="searchForm" class="well form-search" action="booksearch.php" onsubmit="return validateForm()" method="get">
    <a href="/index.php"><img src="img/books_logo_trans.png" height="50" width="80" alt="logo"></a>
    &nbsp;&nbsp;<input type="text" name="bookname" class="input-large search-query" placeholder="Search for book…">
    <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i>Search</button>
    </form></center>
<?php
   //taking the input
   $name = $_GET['bookname'];
   $name1 = strip_tags($name);
   $con_name = rawurlencode($name1);
   $url2 = "http://www.infibeam.com/Books/search?q=";
   $url = "http://www.infibeam.com";
   $searchurl = $url2 . $con_name;
?>
<b>Your Search: </b><span class="badge badge-info"><?php echo $name1; ?></span>
<hr />

<h4>Choose your book: </h4> <br /><center>
<?php
$new1 = file_get_html($searchurl);
$new2 = $new1->find('ul[class=search_result]');
$new3 = $new2[0];

if ($new3 != NULL) { 
$new4 = $new3->find('div[class=img]');

//Taking the thumbnail pictures of all the search results
foreach($new4 as $post) {  
    $img[] = ($post->children(1)->children(0)->outertext);  
    foreach($post->find('img') as $element) 
       $img2[] =  $element->src;
}

//Taking the details of each book in variables
$new5 = $new3->find('span[class=title]');
foreach($new5 as $title) {    
    $link[] = strip_tags($title->children(0)->children(0)->outertext);
    $bookurl[] = $url . strip_tags($title->children(0)->children(0)->href);
    $desc1[] = strip_tags($title->children(1)->outertext);
    $desc2[] = strip_tags($title->children(2)->outertext);
    $desc3[] = strip_tags($title->children(3)->outertext);
    $desc4[] = strip_tags($title->children(4)->outertext);
    $desc5[] = strip_tags($title->children(5)->outertext);
}

//Display the thumbnails with book details(for 12 results)
$cnt = count($img);
$cnt = (($cnt <= 6)? $cnt: 6);
echo '<ul class="thumbnails">';
for ($i = 0; $i < $cnt; $i++) {
//echo $img2[$i];
$passval = $bookurl[$i];
//echo $passval;
  echo '<li class="span2">';
   // echo '<div class="thumbnail">';
      //echo '<a data-toggle="modal" data-id1="' . $passval . '" data-toggle="modal"  title="Add this item" class="open-AddBookDialog" href="#addBookDialog">';
      //echo '<form action="bookfound.php" method="post">';
      echo '<a class="thumbnail" href="/bookfound.php?bookurl=' .$bookurl[$i] .'" >'; 
      echo $img[$i]; 

      echo "<h5> $link[$i] </h5>";
      echo "<p>$desc1[$i]</p>";
      echo "<p>$desc2[$i]</p>";
      echo "<p>$desc3[$i]</p>";
      echo "<p>$desc4[$i]</p>";
      echo "<p>$desc5[$i]</p>";
echo '</a>';
//echo '</div>';
echo '</li>';

//echo '&nbsp;&nbsp;';
}
echo '</ul>';

} 
else 
echo "No book found, please try again with a different search parameter";
?>
</center> <hr />
<h4>New Released Books</h4><br /><center>
<div class="alert alert-block">
<?php
//for latest book search
$newReleased1 = file_get_html($url);
$newReleased2 = $newReleased1->find('div[class=boxinner big]');
$newReleased3 = $newReleased2[0];

if ($newReleased3 !=NULL) {
$newReleased4 = $newReleased3->find('li');

//Taking the thumbnail pictures of all the search results
foreach($newReleased4  as $postR) {  
    $imgR[] = ($postR->children(0)->children(0)->outertext);  
    foreach($postR->find('img') as $element) 
       $imgR2[] =  $element->src;
}

//Taking the details of each new released book in variables
foreach($newReleased4 as $titleR) {    
    $linkR[] = strip_tags($titleR->children(0)->outertext);
    $bookurlR[] = $url . strip_tags($titleR->children(0)->href);
    $descR1[] = strip_tags($titleR->children(1)->outertext);
}

//Display the thumbnails with new released book details(for 12 results)
$cntR = count($imgR);
$cntR = (($cntR <= 6)? $cntR: 6);
echo '<ul class="thumbnails">';
for ($i = 0; $i < $cntR; $i++) {
//echo $imgR2[$i];
$passvalR = $bookurlR[$i];
  echo '<li class="span2">';
      echo '<a class="thumbnail" href="/bookfound.php?bookurl=' .$bookurlR[$i] .'" >'; 
      echo $imgR[$i]; 

      echo "<h5> $linkR[$i] </h5>";
      echo "<p>$desc1R[$i]</p>";
echo '</a>';
//echo '</div>';
echo '</li>';

//echo '&nbsp;&nbsp;';
}
echo '</ul>';
}
?>
</div>
</center> <hr />

<h4>Best Selling Books</h4><br /><center>
<div class="alert alert-success">
<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
<?php
//for latest book search
$urlS="http://www.infibeam.com/Books/";
$newSelling1 = file_get_html($urlS);
$newSelling2 = $newSelling1->find('div[class=boxinner big]');
$newSelling3 = $newSelling2[0];

if ($newSelling3 !=NULL) {
$newSelling4 = $newSelling3->find('li');

//Taking the thumbnail pictures of all the search results
foreach($newSelling4  as $postS) {  
    $imgS[] = ($postS->children(0)->children(0)->outertext);  
    foreach($postS->find('img') as $element) 
       $imgS2[] =  $element->src;
}

//Taking the details of each new released book in variables
foreach($newSelling4 as $titleS) {    
    $linkS[] = strip_tags($titleS->children(0)->outertext);
    $bookurlS[] = $url . strip_tags($titleS->children(0)->href);
    $descS1[] = strip_tags($titleS->children(1)->outertext);
}

//Display the thumbnails with new released book details(for 12 results)
$cntS = count($imgS);
$cntS = (($cntS <= 6)? $cntS: 6);
echo '<ul class="thumbnails">';
for ($i = 0; $i < $cntS; $i++) {
//echo $imgS2[$i];
$passvalS = $bookurlS[$i];
  echo '<li class="span2">';
      echo '<a class="thumbnail" href="/bookfound.php?bookurl=' .$bookurlS[$i] .'" >'; 
      echo $imgS[$i]; 

      echo "<h5> $linkS[$i] </h5>";
      echo "<p>$desc1S[$i]</p>";
echo '</a>';
//echo '</div>';
echo '</li>';

//echo '&nbsp;&nbsp;';
}
echo '</ul>';
}
?>
</div>
</center>

</div>
</div>

<hr>
      <footer>
<center><p><a href = "/about.php">About Us</a> | <a href="/disclaimer.php">Disclaimer</a>
                </p>
      <p>&copy;2012 bril & jo production</p>
<p>We do not provide links or any information about free ebook download.</p>
</center>
      </footer>

</div>
<script type="text/javascript">
function validateForm()
{
var x=document.forms["searchForm"]["bookname"].value;
if (x==null || x=="")
  {
  alert("Please enter the name of the book");
  return false;
  }
}

</script>
</script>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
   
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
  
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/application.js"></script>
</body>
</html>