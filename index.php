<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>

	<title>bookbazar - find books and compare prices from different online book sellers in India</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<!--<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> -->

	<meta name="Keywords" content="Online Shopping, India, Books, FlipKart, infibeam, homeshop18, bookadda, uread, ebook, download" />

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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container-fluid">
<div class="row-fluid">
<div class="span4"></div>
<div class="span4">
<center><a href="/index.php"><img src="img/books_logo_trans.png" height="200" width="300" alt=""></a><br /><br />
    <form name="searchForm" class="well form-search" action="booksearch.php" onsubmit="return validateForm()" method="get">
    <input type="text" name="bookname" class="input-large search-query" placeholder="Search for book…">
    <button type="submit" class="btn"><i class="icon-search icon-black"></i>Search</button>
    </form>
<div class="fb-like" data-href="http://www.bookbazar.in" data-send="false" data-width="450" data-show-faces="false"></div>
</center></div>
<div class="span4"></div>

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

<!--Google Analytics Script -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34034203-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>