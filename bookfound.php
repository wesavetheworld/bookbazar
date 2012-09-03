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
<style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 20px;
      }
    </style>
</head>
<body>
<?php

ini_set("memory_limit","50M");
ini_set('display_errors', '0');     // don't show any errors...
error_reporting(E_ALL | E_STRICT);  // ...but do log them


include_once('simple_html_dom.php');
?>
<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
<a href="/index.php"><img src="img/books_logo_trans.png" height="100" width="200" alt=""></a><br /><br />
 <hr />
<div class="row-fluid">
<div class="span6">
<h4>Book Details: </h4> <br />
<?php $tempBookUrl = $_GET['bookurl']; 
$finalBookUrl = str_replace("www","m",$tempBookUrl);
?>
<ul class="thumbnails">
<div class="thumbnail">
<?php
$new1 = file_get_html($finalBookUrl);
$img1 = $new1->find('img[id=imgMain]');
echo $img1[0];
//echo '<br />';
echo '<div class="caption">';
$new2 = $new1->find('div[id=ib_products]');
$new3= $new2[0];
$new4= $new3->find('table', 0);
echo $new4;


$newid = $new2[0]->find('table', 0);
$isbn = strip_tags($newid->find('h2[class=simple]', 0));
$ean = strip_tags($newid->find('h2[class=simple]', 1));
//echo $isbn;
//echo $ean;

//flipkart rating
if ($ean != "") {
$flipurl = "http://www.flipkart.com/m/search-books?query=" . $ean;
$flipactualurl = "http://www.flipkart.com/search/a/books?query=" . $ean;
//echo $flipurl;
}
else {
$flipurl = "http://www.flipkart.com/m/search-books?query=" . $isbn;
$flipactualurl = "http://www.flipkart.com/search/a/books?query=" . $isbn;
//echo $flipurl;
}
$flippriceR = file_get_html($flipactualurl);
$flippricetempR = ($flippriceR->find('div[class=fk-stars] div[class=rating]', 0));
$flipratingR = str_replace("rating", "progress", $flippricetempR);

$flipreviewR = ($flippriceR->find('div[class=review-list] p[class=line bmargin10]'));


//echo $flippricetempR;
echo '<a class="btn btn-primary btn-medium" data-toggle="modal" href="#myModal" >Click here to see ratings and reviews</a>';
//echo '<b>Flipkart Rating: </b><br /><div class="classification"><div class="cover">' . $flipratingR . '</div></div>';
//echo '<br />';
//echo '<b>Flipkart Recent Reviews: </b>';
echo '</div></div></ul>';
?></div>

<!-- rating and review modal -->
<div class="modal hide" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Rating And Review - by Flipkart</h3>
  </div>
  <div class="modal-body">
    <p><?php echo '<b>Flipkart Rating: </b><div class="classification"><div class="cover">' . $flipratingR . '</div></div><br />';
          //reviews
          echo "<b>Flipkart Reviews: </b><br />";
         $i = 1;
         foreach($flipreviewR as $element) {
         echo '<span class="badge badge-info">#' . $i .' Review</span>';
         echo $element;
         //echo "<br />";
         $i++;
         }

?></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>
<!-- ends here-->

<div class="span6">
<h4>Price Details: </h4><br />
<ul class="thumbnails">
<div class="thumbnail">
<table class ="table">
<thead>
    <tr>
      <th>Book Vendor</th>
      <th>Price</th>
      <th>Delivery Time</th>
      <th>Buy</th>
    </tr>
  </thead>
<tbody>
<?php



//**********************************infibeam price search starts here
if ($ean != "") {
$infiactualurl = "http://www.infibeam.com/Books/search?q=" . $ean;
$infiurl = "http://m.infibeam.com/Books/search?q=" . $ean;
//echo $infiurl;
}
else {
$infiurl = "http://m.infibeam.com/Books/search?q=" . $isbn;
$infiactualurl = "http://www.infibeam.com/Books/search?q=" . $isbn;
//echo $infiurl;
}


//$infiprice1 = file_get_html($infiurl);
$infipricetemp = strip_tags($new1->find('span[class=infiPrice amount]', 0));
$infideliverytime = strip_tags($new1->find('div[id=ib_details] b', 2));
$infiprice2 = preg_replace("/\D/","",$infipricetemp);
if ($infiprice2 != "") {
echo '<tr><td align="left">Price at Infibeam.com : </td><td align="center"><span class="label label-info">Rs. ' . $infiprice2 . ' </span></td>';
echo '<td align="center"><span class="label label-inverse">' . $infideliverytime . ' </span></td>';
echo '<td align="right"><a target="_blank" class="btn btn-success" href="' . $infiactualurl . '">Buy From ';
echo '<img src="http://www.infibeam.com/assets/skins/common/images/logo.png" height="20" width="80" alt="infibeam.com"></a></td></tr>';
}
else
{//
echo '<tr><td align="left">Book not available at</td><td align="center"></td>';
echo '<td align="right"><img src="http://www.infibeam.com/assets/skins/common/images/logo.png" height="20" width="80" alt="infibeam.com"></td>';
}
//$infiprice1->clear(); 
$new1->clear(); 
//**********************************infibeam price search ends here

//**********************************flipkart price search starts here
//$flipprice1 = file_get_html($flipurl);
//$flippricetemp = strip_tags($flipprice1->find('div[id=productpage-price] p span[class=sp]', 0));
$flipdeliverytime = strip_tags($flippriceR->find('div[class=shipping-details] span[class=boldtext]', 0));
$flippricetemp = strip_tags($flippriceR->find('span[id=fk-mprod-our-id]', 0));
$flipprice2 = preg_replace("/\D/","",$flippricetemp);

if ($flipprice2 != "") {
echo '<tr><td align="left">Price at flipkart.com : </td><td align="center"><span class="label label-info">Rs. ' . $flipprice2 . ' </span></td>';
echo '<td align="center"><span class="label label-inverse">' . $flipdeliverytime . ' </span></td>';
echo '<td align="right"><a target="_blank" class="btn btn-success" href="' . $flipactualurl . '">Buy From ';
echo '<img src="http://img5.flixcart.com/www/prod/images/flipkart_india-e5f5aa9f.png" height="20" width="80" alt="flipkart.com"></a></td></tr>';
}
else
{//
echo '<tr><td align="left">Book not available or out of stock at</td><td align="center"></td>';
echo '<td align="right"><img src="http://img5.flixcart.com/www/prod/images/flipkart_india-e5f5aa9f.png" height="20" width="80" alt="flipkart.com"></td></tr>';
}
$flippriceR->clear(); 
//***********************flipkart price search end here



//**********************************homeshop18 price search starts here
if ($ean != "") {
$hsurl = "http://www.homeshop18.com/" . $ean . "/search:" . $ean;
//echo $hsurl;
}
else {
$hsurl = "http://www.homeshop18.com/" . $isbn . "/search:" . $isbn;
//echo $hsurl;
}
$hsprice1 = file_get_html($hsurl);
$hspricetemp = strip_tags($hsprice1->find('span[id=productLayoutForm:OurPrice]', 0));
$hsdeliverytimetemp = strip_tags($hsprice1->find('div[class=pdp_details_deliveryTime]', 0));
$hsdeliverytime = substr($hsdeliverytimetemp, stripos($hsdeliverytimetemp, "in")+2, stripos($hsdeliverytimetemp, "Days")-stripos($hsdeliverytimetemp, "in")+2);
$hsprice2 = preg_replace("/\D/","",$hspricetemp);
if ($hsprice2 != "") {
echo '<tr><td align="left">Price at homeshop18.com : </td><td align="center"><span class="label label-info">Rs. ' . $hsprice2 . ' </span></td>';
echo '<td align="center"><span class="label label-inverse">' . $hsdeliverytime . ' </span></td>';
echo '<td align="right"><a target="_blank" class="btn btn-success" href="' . $hsurl . '">Buy From ';
echo '<img src="http://www.homeshop18.com/homeshop18/media/images/homeshop18_2011/header/hs18-logo.png" height="20" width="80" alt="homeshop18.com"></a></td></tr>';
}
else
{//
echo '<tr><td align="left">Book not available or out of stock at</td><td align="center"></td>';
echo '<td align="right"><img src="http://www.homeshop18.com/homeshop18/media/images/homeshop18_2011/header/hs18-logo.png" height="20" width="80" alt="homeshop18.com"></td></tr>';
}
$hsprice1->clear(); 
//**********************homeshop18 price search ends here



//**********************************crossword price search starts here
/*if ($ean != "") {
$cwurl = "http://www.crossword.in/books/search?q=" . $ean;
//echo $cwurl;
}
else {
$cwurl = "http://www.crossword.in/books/search?q=" . $isbn;
//echo $cwurl;
}
$cwprice1 = file_get_html($cwurl);
$cwpricetemp = strip_tags($cwprice1->find('span[class=variant-final-price]', 0));
$cwprice2 = preg_replace("/\D/","",$cwpricetemp);
if ($cwprice2 != "") {
echo 'Price at crossword.in : <span class="label label-info">Rs. ' . $cwprice2 . ' </span>&nbsp;&nbsp;';
echo '<a target="_blank" class="btn btn-success" href="' . $cwurl . '">Buy From ';
echo '<img src="http://www.crossword.in/images/crossword-logo.png" hieght="70" width="80" alt="crossword.in"></a>';
}
else
{//
echo "Book not available or out of stock at   ";
echo '<img src="http://www.crossword.in/images/crossword-logo.png" hieght="80" width="80" alt="crossword.in">';
}
$cwprice1->clear(); */
//********************************crossword price ends here


//**********************************landmark price search starts here
if ($ean != "") {
$lmactualurl = "http://www.landmarkonthenet.com/books/search/?q=" . $ean;
$lmurl = "http://m.landmarkonthenet.com/books/search/?q=" . $ean;

//echo $lmurl;
}
else {
$lmactualurl = "http://www.landmarkonthenet.com/books/search/?q=" . $isbn;
$lmurl = "http://m.landmarkonthenet.com/books/search/?q=" . $isbn;

//echo $lmurl;
}
$lmprice1 = file_get_html($lmurl);
$lmpricetemp = strip_tags($lmprice1->find('p[class=price] b', 0));
$lmdeliverytimetemp = strip_tags($lmprice1->find('li[class=dispatch-time]', 0));
$lmdeliverytime = substr($lmdeliverytimetemp, stripos($lmdeliverytimetemp, "in")+2, stripos($lmdeliverytimetemp, "days")-stripos($lmdeliverytimetemp, "in")+2);
$lmpricetemp2 = str_replace("&#8377", "", $lmpricetemp); 
$lmprice2 = preg_replace("/\D/","",$lmpricetemp2);
if ($lmprice2 != "") {
echo '<tr><td align="left">Price at landmark : </td><td align="center"><span class="label label-info">Rs. ' . $lmprice2 . ' </span></td>';
echo '<td align="center"><span class="label label-inverse">' . $lmdeliverytime . ' </span></td>';
echo '<td align="right"><a target="_blank" class="btn btn-success" href="' . $lmactualurl . '">Buy From ';
echo '<img src="http://cdn0.desidime.com/photos/14161/original/logo_-_land.jpg" height="20" width="80" alt="landmark"></a></td></tr>';
}
else
{//
echo '<tr><td align="left">Book not available or out of stock at</td><td align="center"></td>';
echo '<td align="right"><img src="http://cdn0.desidime.com/photos/14161/original/logo_-_land.jpg" height="20" width="80" alt="landmark"></td></tr>';
}
$lmprice1->clear(); 
//********************************landmark price ends here

/*
//**********************************bookadda price search starts here
if ($ean != "") {
$baurl = "http://www.bookadda.com/general-search?searchkey=" . $ean;
//echo $baurl;
}
else {
$lmurl = "http://www.bookadda.com/general-search?searchkey=" . $isbn;
//echo $baurl;
}
$baprice1 = file_get_html($baurl);
$bapricetemp = strip_tags($baprice1->find('div[class=pricingbox] span[class=price]', 0));
$baprice2 = preg_replace("/\D/","",$bspricetemp);
if ($baprice2 != "") {
echo 'Price at bookadda : <span class="label label-info">Rs. ' . $baprice2 . ' </span>&nbsp;&nbsp;';
echo '<a target="_blank" class="btn btn-success" href="' . $baurl . '">Buy From ';
echo '<img src="http://cdn0.desidime.com/merchants/40/medium/logo.gif" hieght="70" width="80" alt="bookadda"></a>';
}
else
{//
echo "Book not available or out of stock at   ";
echo '<img src="http://cdn0.desidime.com/merchants/40/medium/logo.gif" hieght="80" width="80" alt="bookadda">';
}
$baprice1->clear(); 
//********************************bookadda price ends here
*/

//**********************************Uread price search starts here
/*if ($ean != "") {
$ururl = "http://www.uread.com/search-books/" . $ean;
//echo $ururl;
}
else {
$ururl = "http://www.uread.com/search-books/" . $isbn;
//echo $ururl;
}
$urprice1 = file_get_html($ururl);
$urpricetemp = strip_tags($urprice1->find('label[id=ctl00_phBody_ProductDetail_lblListPrice] span', 0));
$urprice2 = preg_replace("/\D/","",$urpricetemp);
if ($urprice2 != "") {
echo 'Price at uread : <span class="label label-info">Rs. ' . $urprice2 . ' </span>&nbsp;&nbsp;';
echo '<a target="_blank" class="btn btn-success" href="' . $ururl . '">Buy From ';
echo '<img src="http://www.uread.com/images/logos/logo.gif" hieght="70" width="80" alt="uread"></a>';
}
else
{//
echo "Book not available or out of stock at   ";
echo '<img src="http://www.uread.com/images/logos/logo.gif" hieght="80" width="80" alt="uread">';
}
$urprice1->clear(); */
//********************************uread price ends here

//**********************************IndiaPlaza price search starts here
if ($ean != "") {
$ipactualurl = "http://www.indiaplaza.com/books/" . $ean . ".htm";
$ipurl = "http://m.indiaplaza.com/books/" . $ean . ".htm";
//echo $ipurl;
}
else {
$ipactualurl = "http://www.indiaplaza.com/books/" . $isbn .".htm";
$ipurl = "http://m.indiaplaza.com/books/" . $isbn .".htm";

//echo $ururl;
}
$ipprice1 = file_get_html($ipurl);
$ippricetemp = strip_tags($ipprice1->find('div[class=fdpOurPrice] span[class=blueFont]', 0));
$ipdeliverytimetemp = strip_tags($ipprice1->find('span[class=delDateQuest]', 0));
$ipdeliverytime = substr($ipdeliverytimetemp, stripos($ipdeliverytimetemp, "In")+2, stripos($ipdeliverytimetemp, "Days")-stripos($ipdeliverytimetemp, "in")+2);
$ipprice2 = preg_replace("/\D/","",$ippricetemp);
if ($ipprice2 != "") {
echo '<tr><td align="left">Price at IndiaPlaza : </td><td align="center"><span class="label label-info">Rs. ' . $ipprice2 . ' </span></td>';
echo '<td align="center"><span class="label label-inverse">' . $ipdeliverytime . ' </span></td>';
echo '<td align="right"><a target="_blank" class="btn btn-success" href="' . $ipactualurl . '">Buy From ';
echo '<img src="http://images.indiaplaza.com/indiaplazaimages/logo.png" height="20" width="80" alt="IndiaPalaza"></a></td></tr>';
}
else
{//
echo '<tr><td align="left">Book not available or out of stock at</td><td align="center"></td>';
echo '<td align="right"><img src="http://images.indiaplaza.com/indiaplazaimages/logo.png" height="20" width="80" alt="IndiaPlaza"></td></tr>';
}
$ipprice1->clear(); 
//********************************Indiaplaza price ends here 
?>
</tbody>
</table>
</div>
</ul>
</div>
</div>
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
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
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