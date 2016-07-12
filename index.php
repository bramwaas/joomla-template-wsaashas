<?php
/**
 * @copyright  Copyright (C) 2016 - 2020 Open Source Matters. All rights reserved.
 * @license    GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 * Bram Waasdorp Eerste versie 
   12/10/2011 tbv website asha-s.com
   25/12/2011
   11/10/2012
   11/11/2012
   9/12/2012 titel grootte meer aanpasbaar gemaakt.
  20/2/2013 extra positie slider toegevoegd na de kop
  4/8/2013 aangepast naar versie 1.3 met nog een positie voor sociaal media icons en footer
           volgorde modules zo gemaakt, dat sociaal media icons en footer het laats gelaten worden
           (in de bovenste laag komen) en daarom klikbaar zijn ook als ze met een ander element overlappen.
           Headerleft in module ipv plaatje binnen sjabloon
     7/9/2013 behavior.modal voor lightbox toegevoegd al werkte dit al omdat de functionaliteit oom in de slider zit.
     23/11/2013 publisher link toegevoeg
     24/11/2013 footer fixed bottom gepositioneerd.
	 24/2/2014 speciale css voor een-kolom blog (div.cols-1 div.item en div.cols-1 + div.items-more zelfde al items-leading )
  25-5-2014 facebook metagegevens og: tijdelijk toegevoegd
  5-11-2014 aanpassing voor tags (inline-block ipv standaard list li, width )
  13-12-2014 diverse aanpassingen.
  21-12-2014 aanpassingen voor menu rechts, overgenomen uit wsa3kol-front
  15-2-2015 viewport meta toegevoegd nav problemen mobiele bruikbaarheid volgens google webmaster tools en breakpoint mobile
  9-8-2015 doctype html voor html5
  14-8-2015 verbeteringen voor prefixes og: en fb: in html5
  14-11-2015 ga-tracker verwijderd.
  6-1-2016 pos 12 toegevoegd 
  22-01-2015 less toegevoegd overbodige bestanden verwijderd en css op juiste plaats gezet
  7-2-2016 inline style verwijderd
  26-3-2016 attribute data-wsmodal toegevoeg voor start modal popup
  21-4-2016 magnific popup toegevoegd als JQUERY vervanger van MOOTOOLS modal 
 */

// no direct access
/* defined( '_JEXEC' ) or die( 'Restricted access' ); */
 defined( '_JEXEC' ) or die;
// heel behavior (3 JHTML's) en daarmee ook Mootols vervalt na in gebruik name magnificPopup
//JHtml::_('behavior.framework', true);
// Add modal behavior for links  attribuut data-wsmodal in plaats van class modal, 
// omdat .modal speciale functie heeft in bootstrap 3
// betekent wel wijziging aan alle artikelen daarom eerst beiden toevoegen.
//JHTML::_('behavior.modal'); 
//JHTML::_('behavior.modal', 'a[data-wsmodal]');
 

$app      = JFactory::getApplication();
$doc      = JFactory::getDocument();

 // Get the template
$template = $app->getTemplate(true);
$templateparams  = $template->params;
$templatestyleid =  $template->id;

// get params
$gplusProfile   = htmlspecialchars($this->params->get('gplusProfile'));
$breakpointMobile = htmlspecialchars($this->params->get('breakpointMobile'));

$hlMarginTop    = htmlspecialchars($this->params->get('hlMarginTop'));
$hlMarginLeft   = htmlspecialchars($this->params->get('hlMarginLeft'));
if ($hlMarginLeft > " " ) {} else { $hlMarginLeft = 0; }
$hlWidth    	= htmlspecialchars($this->params->get('hlWidth'));
$hlHeight    	= htmlspecialchars($this->params->get('hlHeight'));
$hlMarginBottom = htmlspecialchars($this->params->get('hlMarginBottom'));
$showTitle  	= htmlspecialchars($this->params->get('showTitle'));
$phMarginTop    = htmlspecialchars($this->params->get('phMarginTop'));
$phWidth    	= htmlspecialchars($this->params->get('phWidth'));
$background    	= htmlspecialchars($this->params->get('background'));
$fgColor    	= htmlspecialchars($this->params->get('fgColor'));
$bgImage    	= htmlspecialchars($this->params->get('bgImage'));
$bgWidth    	= htmlspecialchars($this->params->get('bgWidth'));
$bgTop      	= htmlspecialchars($this->params->get('bgTop'));
$bgLeft      	= htmlspecialchars($this->params->get('bgLeft'));
$bgColor    	= htmlspecialchars($this->params->get('bgColor'));
$logo      	= htmlspecialchars($this->params->get('logo'));
$logoWidth    	= htmlspecialchars($this->params->get('logoWidth'));
$logoPosLeft    = htmlspecialchars($this->params->get('logoPosLeft'));
$logoPosTop    	= htmlspecialchars($this->params->get('logoPosTop'));
$iconsWidth    	= htmlspecialchars($this->params->get('iconsWidth'));
$iconsPosLeft   = htmlspecialchars($this->params->get('iconsPosLeft'));
$iconsPosTop    = htmlspecialchars($this->params->get('iconsPosTop'));
$contentPosLeft	= htmlspecialchars($this->params->get('contentPosLeft'));
$contentPosRight	= htmlspecialchars($this->params->get('contentPosRight'));
$contentPosTop  = htmlspecialchars($this->params->get('contentPosTop'));
$marginLeftRight	= htmlspecialchars($this->params->get('marginLeftRight'));
if ($marginLeftRight > " " and $marginLeftRight > 0 and $marginLeftRight < 50) {} 
	else { $marginLeftRight = 2; }
$itemPageWidth  = htmlspecialchars($this->params->get('itemPageWidth'));
if ($itemPageWidth > " " and $itemPageWidth < 100 and $itemPageWidth > 0) {}
	else { $itemPageWidth = 100; }
$tagListItemWidth    = htmlspecialchars($this->params->get('tagListItemWidth'));
if ($tagListItemWidth > " " and $tagListItemWidth > 0 and $tagListItemWidth <= 100) { } 
	else { $tagListItemWidth = 30; }
$tagItemTitleDisplay   = htmlspecialchars($this->params->get('tagItemTitleDisplay'));

$itemVideoHeight= htmlspecialchars($this->params->get('itemVideoHeight'));
$itemLeadHeight = htmlspecialchars($this->params->get('itemLeadHeight'));
$itemLeadWidth  = htmlspecialchars($this->params->get('itemLeadWidth'));
$itemLeadMargin = htmlspecialchars($this->params->get('itemLeadMargin'));
$itemHeight    	= htmlspecialchars($this->params->get('itemHeight'));
$itemWidth    	= htmlspecialchars($this->params->get('itemWidth'));
$itemMargin    	= htmlspecialchars($this->params->get('itemMargin'));
$linkColor    	= htmlspecialchars($this->params->get('linkColor'));
$linkDecoration = htmlspecialchars($this->params->get('linkDecoration'));
$linkHvColor    = htmlspecialchars($this->params->get('linkHvColor'));
$menuLineHeight = htmlspecialchars($this->params->get('menuLineHeight'));
$menuMarginTop  = htmlspecialchars($this->params->get('menuMarginTop'));
$menuMarginLeft = htmlspecialchars($this->params->get('menuMarginLeft'));
$menuColor    	= htmlspecialchars($this->params->get('menuColor'));
$menuBgColor   	= htmlspecialchars($this->params->get('menuBgColor'));
$menuFontSize 	= htmlspecialchars($this->params->get('menuFontSize')); 
$menuDisplay 	= htmlspecialchars($this->params->get('menuDisplay'));
$menuLineHeight = htmlspecialchars($this->params->get('menuLineHeight'));
$menuDecoration = htmlspecialchars($this->params->get('menuDecoration'));
$menuHvColor    = htmlspecialchars($this->params->get('menuHvColor'));
$menuHvDecoration  	= htmlspecialchars($this->params->get('menuHvDecoration'));
$menuActiveColor  	= htmlspecialchars($this->params->get('menuActiveColor'));
$menuActiveDecoration  	= htmlspecialchars($this->params->get('menuActiveDecoration'));
$footerWidth    = htmlspecialchars($this->params->get('footericonsWidth'));
$footerPosLeft  = htmlspecialchars($this->params->get('footerPosLeft'));
$footerPosBottom	= htmlspecialchars($this->params->get('footerPosBottom'));

if ($contentPosLeft > $marginLeftRight and $contentPosLeft < 100 )
	{ $contentPosLeft = $contentPosLeft * 50 / (50 - $marginLeftRight);}
	else
	{ $contentPosLeft = 24; }
if ($contentPosRight > (1.5 * $marginLeftRight) and $contentPosRight < 100 )
	{ $contentPosRight = $contentPosRight * 50 / (50 - $marginLeftRight); }
	else
	{ $contentPosRight = 0; }
$areaWidth = 100 - 2 * $marginLeftRight - $contentPosRight;
$marginArea = $marginLeftRight * 50 / $areaWidth;
$tagListItemWidth = $tagListItemWidth * 100 / $areaWidth;
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"  
  prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml" lang="<?php echo $this->language; ?>" >
<?php $app = JFactory::getApplication(); ?>
<head>
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
// Add Stylesheets
//JHtmlBootstrap::loadCss();
// Load optional rtl Bootstrap css and Bootstrap bugfixes
///JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);
// Adjusting content width
//$doc->addStyleSheet('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700');
$doc->addStyleSheet('templates/' . $this->template . '/css/template.min.' . $templatestyleid . '.css');
//$doc->addStyleSheet('templates/system/css/system.css');
//$doc->addStyleSheet('templates/system/css/general.css');
//$doc->addStyleSheet('templates/' . $this->template . '/css/template.css');
//$doc->addStyleSheet('templates/' . $this->template . '/css/' . $background);
// javascript magnificPopup
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/magnificpopup/MagnificPopupV1-1-0.js');
// initialisatie magnificPopup.
$doc->addScriptDeclaration('jQuery(document).ready(function() {
  jQuery(\'a[rel*="lightbox"], a[data-wsmodal]\').magnificPopup({
type: \'image\'
, closeMarkup : \'<button title="%title%" type="button" class="mfp-close">&nbsp;</button>\'
});})');  


?>

<?php include("include_link_rel_canonical.php"); ?>



<!--[if lte IE 6]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ieonly.css" rel="stylesheet" type="text/css" />

<![endif]-->

<!--[if IE 7]> 
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
<![endif]--> 


<?php if($this->direction == 'rtl') : ?>
  <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<style type="text/css">
</style>

</head>

<body id="page_bg" >
<?php if ($bgImage > " ") : ?>
<img id="bg_img" src="<?php echo $this->baseurl ?><?php echo $bgImage; ?>" alt="Background_image" />
<?php endif; ?>
<a  id="up"></a>
  <div id="wrapper">
  <div id="headerleft">
  <?php if(  $this->countModules('headerleft'))    : ?>
             <jdoc:include type="modules" name="headerleft"  />
  <?php endif; ?>
    </div><!--einde headerleft-->  
    <div id="logo">
    <a href="<?php echo $this->baseurl ?>" title="Home" >
      <img id="logo_img" src="<?php echo $this->baseurl ?><?php echo $logo; ?>" alt="logo" />
    </a>
    </div><!-- einde logo -->
    <div id="page_heading">
       <?php if(  $showTitle)    : ?><h1><?php  echo $this->getTitle(); ?></h1><?php endif; ?>
        <?php if(  $this->countModules('position-1'))    : ?>
            <jdoc:include type="modules" name="position-1"  />
        <?php endif; ?>
        <?php if(  $this->countModules('position-2'))    : ?>
            <jdoc:include type="modules" name="position-2" style="xhtml" />
        <?php endif; ?>
  </div><!-- einde page_heading -->
  
  <div id="area">
 
<!-- left column is onderdeel van maincolumn --> 
             <div id="maincolumn"><!-- maincolumn -->
             <?php if ($this->countModules('position-12')) : ?>
		<jdoc:include type="modules" name="position-12" />
	     <?php endif; ?>
  
                   <jdoc:include type="component" />
          <div class="clr"></div>
           <?php if(  $this->countModules('position-3'))    : ?>
               <jdoc:include type="modules" name="position-3" />
            <?php endif; ?>
            <?php if(  $this->countModules('position-4'))    : ?>
               <jdoc:include type="modules" name="position-4" style="rounded" />
           <?php endif; ?>
         <div class="clr"></div>
          </div><!-- maincolumn einde -->
    </div> <!-- einde area-->
    <?php if ($contentPosRight > 0 ) : ?>
	<div id="rightcolumn">
             <?php if(  $this->countModules('position-5'))    : ?>
               <jdoc:include type="modules" name="position-5" />
            <?php endif; ?>
            <?php if(  $this->countModules('position-6'))    : ?>
               <jdoc:include type="modules" name="position-6" style="rounded" />
           <?php endif; ?>
	</div> <!-- einde rightcolumn -->
	<?php endif; ?>
      <?php if(  $this->countModules('icons'))    : ?>
        <div id="icons">
           <jdoc:include type="modules" name="icons" />
		</div>   
      <?php endif; ?>
   </div> <!-- einde wrapper -->
      <?php if(  $this->countModules('footer'))    : ?>
	    <div id="footer">
          <jdoc:include type="modules" name="footer"  />
		</div>  
      <?php endif; ?>


</body>
</html>
