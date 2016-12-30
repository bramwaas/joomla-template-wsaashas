<?php
/**
 * @copyright  Copyright (C) 2011 - 2016, Amsterdam AHC Waasdorp. All rights reserved.
 * @license    GNU/GPL, see LICENSE
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
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
  30-7-2016 aanpassingen om icons netter te plaatsen, overbodige variabelen verwijderd
  2-8-2016 icons verplaatst boven wrapper
  9-9-2016 sidebarrleft position-8 toegevoegd
  30-12-2016 Verschillende aanpassingen tbv srcset bg0Image_lg etc
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

$showTitle  	= htmlspecialchars($this->params->get('showTitle'));
$background    	= htmlspecialchars($this->params->get('background'));
$bg0Image    	= htmlspecialchars($this->params->get('bgImage'));
if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' ) 
 {$bg1Image = '/' . $bg1Image;};
$bg0Image_lg    	= htmlspecialchars($this->params->get('bg0Image_lg'));
if ($bg0Image_lg > ' ' and strtolower(substr ( $bg0Image_lg , 0 , 7 )) == 'images/' )
 {$bg0Image_lg = '/' . $bg0Image_lg;};
$bg1Image     	= htmlspecialchars($this->params->get('logo'));
if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' ) 
 {$bg1Image = '/' . $bg1Image;};
$bg1Image_lg    	= htmlspecialchars($this->params->get('bg1Image_lg'));
if ($bg1Image_lg > ' ' and strtolower(substr ( $bg1Image_lg , 0 , 7 )) == 'images/' ) 
 {$bg1Image_lg = '/' . $bg1Image_lg;};
$bg0ImageW    	= htmlspecialchars($this->params->get('bg0ImageW'));
$bg0ImageH    	= htmlspecialchars($this->params->get('bg0ImageH'));
$bg0Image_lgW  	= htmlspecialchars($this->params->get('bg0Image_lgW'));
$bg1ImageW    	= htmlspecialchars($this->params->get('bg1ImageW'));
$bg1ImageH    	= htmlspecialchars($this->params->get('bg1ImageH'));
$bg1Image_lgW  	= htmlspecialchars($this->params->get('bg1Image_lgW'));

$marginLeftRight	= htmlspecialchars($this->params->get('marginLeftRight'));
if ($marginLeftRight > " " and $marginLeftRight > 0 and $marginLeftRight < 50) {} 
	else { $marginLeftRight = 2; }
$contentPosRight	= htmlspecialchars($this->params->get('contentPosRight'));
if ($contentPosRight > (1.5 * $marginLeftRight) and $contentPosRight < 100 )
	{ $contentPosRight = $contentPosRight * 50 / (50 - $marginLeftRight); }
	else
	{ $contentPosRight = 0; }


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
<?php if ($bg0Image > " ") : ?>
<img id="bg_img" src="<?php echo $bg0Image; ?>" alt="Background image"
	<?php if ($bg0ImageW > 0 ) : ?>width="<?php echo $bg0ImageW; ?>"<?php endif; ?>
	<?php if ($bg0ImageH > 0 ) : ?>height="<?php echo $bg0ImageH; ?>"<?php endif; ?>
	<?php if ($bg0Image_lg > " " && $bg0ImageW > 0 && $bg0Image_lgW > 0 ) : ?>
	srcset="<?php echo $bg0Image .' '. $bg0ImageW .'w,'. $bg0Image_lg .' ' . $bg0Image_lgW . 'w'  ; ?>"
	sizes="<?php echo '(min-width: 768px) '.$bg0Image_lgW .'px,'. $bg0ImageW .'px'; ?>"
	<?php endif; ?>
 />
<?php endif; ?>
<a  id="up"></a>
<?php if(  $this->countModules('icons'))    : ?>
  <div id="icons">
    <jdoc:include type="modules" name="icons" />
  </div>   
<?php endif; ?>
  <div id="wrapper"><!-- class="container-content" -->
  <div id="headerleft">
  <?php if(  $this->countModules('headerleft'))    : ?>
             <jdoc:include type="modules" name="headerleft"  />
  <?php endif; ?>
    </div><!--einde headerleft-->  
    <div id="logo">
    <a href="<?php echo $this->baseurl ?>" title="Home" >
	<?php if ($bg1Image > " ") : ?>	    
      <img id="logo_img" src="<?php echo $bg1Image; ?>" alt="Logo"
	<?php if ($bg1ImageW > 0 ) : ?>width="<?php echo $bg1ImageW; ?>"<?php endif; ?>
	<?php if ($bg1ImageH > 0 ) : ?>height="<?php echo $bg1ImageH; ?>"<?php endif; ?>
	<?php if ($bg1Image_lg > " " && $bg1ImageW > 0 && $bg1Image_lgW > 0 ) : ?>
	srcset="<?php echo $bg1Image .' '. $bg1ImageW .'w,'. $bg1Image_lg .' ' . $bg1Image_lgW . 'w'  ; ?>"
	sizes="<?php echo '(min-width: 768px) '.$bg1Image_lgW .'px,'. $bg1ImageW .'px'; ?>"
	<?php endif; ?>
 />
	<?php endif; ?>
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
  
  	<div id="area"> <!--  class="row" -->
	 	<?php if ($this->countModules('position-8')): ?>
		<div id="sidebarleft">
			<jdoc:include type="modules" name="position-8" style="well" /><!--End Position-8-->
		</div><!--End Sidebar Left-->
		<div id="maincolumn" class="maincolumncenter"><!-- maincolumn id="content" -->
 		<?php else : ?>
		<div id="maincolumn"><!-- maincolumn id="content" -->
		<?php endif; ?>
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
   </div> <!-- einde wrapper -->
      <?php if(  $this->countModules('footer'))    : ?>
	    <div id="footer">
          <jdoc:include type="modules" name="footer"  />
		</div>  
      <?php endif; ?>


</body>
</html>
