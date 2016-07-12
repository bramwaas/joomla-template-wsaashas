<?php
/* gatracker.php 
* asynchrone tracker google anlytics te plaatsen vlak voor afsluiting header
* voor waasdorpsoekhan.nl (UA-7124553-2) en soekhan.nl (UA-7124553-3) soekdorp (UA-7124553-4)
* vervangt de synchrone tracker uit footer.php.
*  Bram Waasdorp 2012 12 02
* 
*/
?>

<!-- google analytics -->
<?php 
$ga_url  = JURI::base( );    
if (stristr($ga_url, "waasdorpsoekhan") > " " )
{  
 $ga_ua =  "UA-7124553-2";
}
elseif (stristr($ga_url, "soekhan") > " "  )
{
$ga_ua =  "UA-7124553-3";
}
elseif (stristr($ga_url, "soekdorp") > " "  )
{
$ga_ua =  "UA-7124553-4";
}
else
{
$ga_ua =  "UA-43712082-1";
}

if ($ga_ua > " ") : ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $ga_ua; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php endif; ?>
<!-- einde google-analytics -->
