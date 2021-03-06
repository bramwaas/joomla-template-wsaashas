<?php  defined( '_JEXEC' ) or die;
/**
 * @copyright  Copyright (C) 2011 - 2018, Amsterdam AHC Waasdorp. All rights reserved.
 * @license    GNU/GPL, see LICENSE
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * Bram Waasdorp Eerste versie 
 * 12/10/2011 tbv website asha-s.com
 * 9/12/2012 titel grootte meer aanpasbaar gemaakt.
 * 20/2/2013 extra positie slider toegevoegd na de kop
 * 4/8/2013 aangepast naar versie 1.3 met nog een positie voor sociaal media icons en footer
           volgorde modules zo gemaakt, dat sociaal media icons en footer het laats gelaten worden
           (in de bovenste laag komen) en daarom klikbaar zijn ook als ze met een ander element overlappen.
           Headerleft in module ipv plaatje binnen sjabloon
  * 25-5-2014 facebook metagegevens og: tijdelijk toegevoegd
  * 5-11-2014 aanpassing voor tags (inline-block ipv standaard list li, width )
  * 21-12-2014 aanpassingen voor menu rechts, overgenomen uit wsa3kol-front
  * 15-2-2015 viewport meta toegevoegd nav problemen mobiele bruikbaarheid volgens google webmaster tools en breakpoint mobile
  * 9-8-2015 doctype html voor html5
  * 14-8-2015 verbeteringen voor prefixes og: en fb: in html5
  * 22-01-2015 less toegevoegd overbodige bestanden verwijderd en css op juiste plaats gezet
  * 7-2-2016 inline style verwijderd
  * 21-4-2016 magnific popup toegevoegd als JQUERY vervanger van MOOTOOLS modal 
  * 30-12-2016 Verschillende aanpassingen tbv srcset bg0Image_lg etc
  * 27-4-2017 naam CSS variabel
  * 21-1-2018 v1.6.0 Namespaces tbv J4 and minmale version j3.8 divers commentaar opgeschoond
  * 26-10-2018 1.6.5 background images relative paths to facilitate using subdirectories eg for testing ../test/
 */

use Joomla\CMS\Factory;   // this is the same as use Joomla\CMS\Factory as Factory
use Joomla\CMS\Language\Text;   // translations
/** @var JDocumentHtml $this */

$app  = Factory::getApplication();
$lang = Factory::getLanguage();

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu->params->get('pageclass_sfx');

 // Get the template
$template = $app->getTemplate(true);
$templateparams  = $template->params;
$templatestyleid =  $template->id;

// get params
$gplusProfile   = htmlspecialchars($this->params->get('gplusProfile'));

$showTitle  	= htmlspecialchars($this->params->get('showTitle'));
$background    	= htmlspecialchars($this->params->get('background'));
$bg0Image    	= htmlspecialchars($this->params->get('bgImage'));
$bg0Image_lg    	= htmlspecialchars($this->params->get('bg0Image_lg'));
$bg0Breakpoint_lg    	= htmlspecialchars($this->params->get('bg0Breakpoint_lg'));
$bg0Image_sm    	= htmlspecialchars($this->params->get('bg0Image_sm'));
$bg0Breakpoint_sm    	= htmlspecialchars($this->params->get('bg0Breakpoint_sm'));
 
$bg1Image     	= htmlspecialchars($this->params->get('logo'));
$bg1Image_lg    	= htmlspecialchars($this->params->get('bg1Image_lg'));
$bg1Breakpoint_lg    	= htmlspecialchars($this->params->get('bg1Breakpoint_lg'));
$bg1Image_sm    	= htmlspecialchars($this->params->get('bg1Image_sm'));
 $bg1Breakpoint_sm    	= htmlspecialchars($this->params->get('bg1Breakpoint_sm'));
 
$bg0ImageW    	= htmlspecialchars($this->params->get('bg0ImageW'));
$bg0ImageH    	= htmlspecialchars($this->params->get('bg0ImageH'));
$bg0Image_lgW  	= htmlspecialchars($this->params->get('bg0Image_lgW'));
$bg0Image_smW  	= htmlspecialchars($this->params->get('bg0Image_smW'));
$bg1ImageW    	= htmlspecialchars($this->params->get('bg1ImageW'));
$bg1ImageH    	= htmlspecialchars($this->params->get('bg1ImageH'));
$bg1Image_lgW  	= htmlspecialchars($this->params->get('bg1Image_lgW'));
$bg1Image_smW  	= htmlspecialchars($this->params->get('bg1Image_smW'));

$marginLeftRight	= htmlspecialchars($this->params->get('marginLeftRight'));
if ($marginLeftRight > " " and $marginLeftRight > 0 and $marginLeftRight < 50) {} 
	else { $marginLeftRight = 2; }
$contentPosRight	= htmlspecialchars($this->params->get('contentPosRight'));
if ($contentPosRight > (1.5 * $marginLeftRight) and $contentPosRight < 100 )
	{ $contentPosRight = $contentPosRight * 50 / (50 - $marginLeftRight); }
	else
	{ $contentPosRight = 0; }
	
$wsaCssFilename = strtolower(htmlspecialchars($this->params->get('wsaCssFilename')));
if ($wsaCssFilename > " ")
	{$path_parts = pathinfo($wsaCssFilename);
	if (path_parts['extension'] <> 'css'){$wsaCssFilename = $wsaCssFilename . '.css';};
}
else
{ $wsaCssFilename = 'template.min.' . $templatestyleid . '.css';}


?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"  
  prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<?php
// Add extra metadata
$this->setMetaData( 'X-UA-Compatible', 'IE=edge', true ); // http-equiv = true 
$this->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );

// Add Stylesheets
// template stijl
$attribs = array('id'=> $wsaCssFilename);
$this->addStyleSheet('templates/' . $this->template . '/css/' . $wsaCssFilename , array('version'=>'auto'), $attribs);

// Add JavaScript 
// javascript magnificPopup
$this->addScript($this->baseurl . '/templates/' . $this->template . '/js/magnificpopup/MagnificPopupV1-1-0.js', array('version'=>'1-1-0'), array('id'=>'MagnificPopupV1-1-0.js', 'defer'=>'defer'));
// defer caption.js.  	
$this->addScript($this->baseurl  . '/media/system/js/caption.js' , array('version'=>''), array('id'=>'caption.js', 'defer'=>'defer')); // defer caption.js.  	

// initialisatie magnificPopup.
$this->addScriptDeclaration('jQuery(document).ready(function() {
  jQuery(\'a[rel*="lightbox"], a[data-wsmodal]\').magnificPopup({
type: \'image\'
, closeMarkup : \'<button title="%title%" type="button" class="mfp-close">&nbsp;</button>\'
});})');  


?>
<?php
// tijdelijk uitgeschakeld eerst kijken of nog wel nodig in J4 dan eventueel aanpassen
// include("include_link_rel_canonical.php");
?>



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

<body id="page_bg"
 data-itemid="<?php echo ($itemid ? 'itemid-' . $itemid : ''); ?>"
 class="site-grid site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ' ' . $pageclass;
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>"

>
<?php if ($bg0Image > " " )
{ echo "\n" . '<img id="bg_img" src="' . $bg0Image . '" alt="Background image"';
	if ($bg0ImageW > 0 ) {echo "\n\t" . 'width="' . $bg0ImageW .'"';}
	if ($bg0ImageH > 0 ) {echo "\n\t" . 'height="' . $bg0ImageH . '"';}
	if ($bg0ImageW > 0  && (($bg0Image_lg > " " && $bg0Image_lgW > 0) || ($bg0Image_sm > " " && $bg0Image_smW > 0))  )
	{echo "\n\t" . 'srcset="' . $bg0Image . ' ' . $bg0ImageW .'w'   ;
	if ($bg0Image_lgW > 0) {echo ','. $bg0Image_lg .' ' . $bg0Image_lgW . 'w' ; }
	if ($bg0Image_smW > 0) {echo ','. $bg0Image_sm .' ' . $bg0Image_smW . 'w' ; }
	echo '"';
	if ($bg0Breakpoint_lg > 0 || $bg0Breakpoint_sm > 0)
		{echo "\n\t" . 'sizes="';
		if ($bg0Breakpoint_sm > 0 ) {echo '(max-width: ' . $bg0Breakpoint_sm .'px) '.$bg0Image_smW .'px,'; }
		if ($bg0Breakpoint_lg > 0 ) {echo '(min-width: ' . $bg0Breakpoint_lg .'px) '.$bg0Image_lgW .'px,'; }
		echo $bg0ImageW .'px"'; 
		}
	} 
 echo  ' />' . "\n";
}?>
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
<?php if ($bg1Image > " " )
{ echo "\n\t" . '<img id="logo_img" src="' . $bg1Image . '" alt="Logo"';
	if ($bg1ImageW > 0 ) {echo "\n\t\t" . 'width="' . $bg1ImageW .'"';}
	if ($bg1ImageH > 0 ) {echo "\n\t\t" . 'height="' . $bg1ImageH . '"';}
	if ($bg1ImageW > 0  && (($bg1Image_lg > " " && $bg1Image_lgW > 0) || ($bg1Image_sm > " " && $bg1Image_smW > 0))  )
	{echo "\n\t\t" . 'srcset="' . $bg1Image . ' ' . $bg1ImageW .'w'   ;
	if ($bg1Image_lgW > 0) {echo ','. $bg1Image_lg .' ' . $bg1Image_lgW . 'w' ; }
	if ($bg1Image_smW > 0) {echo ','. $bg1Image_sm .' ' . $bg1Image_smW . 'w' ; }
	echo '"';
	if ($bg1Breakpoint_lg > 0 || $bg1Breakpoint_sm > 0)
		{echo "\n\t\t" . 'sizes="';
		if ($bg1Breakpoint_sm > 0 ) {echo '(max-width: ' . $bg1Breakpoint_sm .'px) '.$bg1Image_smW .'px,'; }
		if ($bg1Breakpoint_lg > 0 ) {echo '(min-width: ' . $bg1Breakpoint_lg .'px) '.$bg1Image_lgW .'px,'; }
		echo $bg1ImageW .'px"'; 
		}
	} 
 echo  ' />' . "\n";
}?>
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
