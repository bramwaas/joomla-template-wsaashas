<?php
/**
 * @package Joomla.Site
 * @subpackage Templates.dna
 * @copyright Copyright (C) Bram Waasdorp 2015 - 2018. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
/* regel voor validatie type compiler, bedoeld om samenstellen en compileren Less bestanden uit te voeren vlak voor  de save  
v 21-4-2016
v 25-6-2016 1.5.0 less compiler uit administrator/components/com_templates/models/template.php ipv FOF, omdat deze nieuwer is.
            wsaCustomCSS toegevoegd voor custom Css uit less bestand in dir images/less 
            ivm &tmpl=component  ook template.css maken bij standaard template
v 2-8-2016 topmargin tbv verplaatste icons mobile
v 21-8-2016 aantal twbs bestanden nav en mixins toegevoegd
v 30-12-2016 verschillende aanpassingen tbv srceset met 2 images normaal en groot _lg
v 7-1-2017 ook image_sm
v 27-4-2017 andere naam css mogelijk
v 21-1-2018
	*/
 
defined('_JEXEC') or die('caught by _JEXEC');
require 'leafo/lessphp/lessc.inc.php';


use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Form\FormRule;


class WsaFormRuleCompiler extends FormRule
/* voorbeeld eenvoudigste validatie dmv regexp
 uitgebreider gaat met functie test die ik hier wel ga gebruiken.
{
    protected $regex = '[0-9]';
}
*/

{ /* begin WsaFormRuleCompiler voert validatie wsa.compiler uit */

public function test(\SimpleXMLElement $element,  $value, string $group = null, \Joomla\Registry\Registry $input = null, \Joomla\CMS\Form\Form $form = null)
{
 $templatestyleid =  URI::getInstance ()->getVar('id');
 $app = Factory::getApplication();
 $currentpath = realpath(__DIR__ ) ;
 $home = Factory::getApplication()->input->get('jform', '', 'array')['home'];
 $params = Factory::getApplication()->input->get('jform', '', 'array')['params'];

if  (htmlspecialchars($params['compile']) == '1')

{ /* creeren en compileren */
// less compiler uit administrator/components/com_templates/models/template.php vanaf 1.5.0 (26-6-2016)
$less = new WsaAshaLess;
if ( htmlspecialchars($params["compress"]) == "1")
{
 $less->setFormatter("compressed");
}
else
{  // voor debug netter formatteren en commentaren behouden. 
$less->setFormatter("classic");
// $less->setPreserveComments(true);
//$formatter = new Formatter\JLessFormatterJoomla;
//$this->setFormatter($formatter);
}
// einde less compiler uit template.php



// get params
$gplusProfile   = htmlspecialchars($params['gplusProfile']);
//$breakpointMobile = htmlspecialchars($params['breakpointMobile']);
//$breakpointXLmin = htmlspecialchars($params['breakpointXLmin']);
$wsaIconsMobileTopMargin   = htmlspecialchars($params['wsaIconsMobileTopMargin']);
$hlMarginTop    = htmlspecialchars($params['hlMarginTop']);
$hlMarginLeft   = htmlspecialchars($params['hlMarginLeft']);
if ($hlMarginLeft > " " ) {} else { $hlMarginLeft = 0; }
$hlWidth    	= htmlspecialchars($params['hlWidth']);
$hlHeight    	= htmlspecialchars($params['hlHeight']);
$hlMarginBottom = htmlspecialchars($params['hlMarginBottom']);
$showTitle  	= htmlspecialchars($params['showTitle']);
$phMarginTop    = htmlspecialchars($params['phMarginTop']);
$phWidth    	= htmlspecialchars($params['phWidth']);
$background    	= htmlspecialchars($params['background']);
$fgColor    	= htmlspecialchars($params['fgColor']);
$bgColor    	= htmlspecialchars($params['bgColor']);

$bgImage    	= htmlspecialchars($params['bgImage']);
if ($bgImage > ' ' and strtolower(substr ( $bgImage , 0 , 7 )) == 'images/' )
 {$bgImage = '/' . $bgImage;};
$bgWidth    	= htmlspecialchars($params['bgWidth']);
$bgTop      	= htmlspecialchars($params['bgTop']);
$bgLeft      	= htmlspecialchars($params['bgLeft']);
$bg0Image_lg    	= htmlspecialchars($params['bg0Image_lg']);
if ($bg0Image_lg > ' ' and strtolower(substr ( $bg0Image_lg , 0 , 7 )) == 'images/' )
 {$bg0Image_lg = '/' . $bg0Image_lg;};
$bg0Breakpoint_lg    	= htmlspecialchars($params['bg0Breakpoint_lg']);
$bg0Image_sm    	= htmlspecialchars($params['bg0Image_sm']);
if ($bg0Image_sm > ' ' and strtolower(substr ( $bg0Image_sm , 0 , 7 )) == 'images/' )
{$bg0Image_sm = '/' . $bg0Image_sm;};
$bg0Breakpoint_sm    	= htmlspecialchars($params['bg0Breakpoint_sm']);

$logo      	= htmlspecialchars($params['logo']);
if ($logo > ' ' and strtolower(substr ( $logo , 0 , 7 )) == 'images/' )
 {$logo = '/' . $logo;};	
$logoWidth    	= htmlspecialchars($params['logoWidth']);
$logoPosLeft    = htmlspecialchars($params['logoPosLeft']);
$logoPosTop    	= htmlspecialchars($params['logoPosTop']);
$bg1Image_lg    	= htmlspecialchars($params['bg1Image_lg']);
if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' ) 
 {$bg1Image = '/' . $bg1Image;};
$bg1Breakpoint_lg    	= htmlspecialchars($params['bg1Breakpoint_lg']);
$bg1Image_sm    	= htmlspecialchars($params['bg1Image_sm']);
if ($bg1Image_sm > ' ' and strtolower(substr ( $bg1Image_sm , 0 , 7 )) == 'images/' )
{$bg1Image_sm = '/' . $bg1Image_sm;};
$bg1Breakpoint_sm    	= htmlspecialchars($params['bg1Breakpoint_sm']);

$iconsWidth    	= htmlspecialchars($params['iconsWidth']);
$iconsPosLeft   = htmlspecialchars($params['iconsPosLeft']);
$iconsPosTop    = htmlspecialchars($params['iconsPosTop']);
$contentPosLeft	= htmlspecialchars($params['contentPosLeft']);
$contentPosRight	= htmlspecialchars($params['contentPosRight']);
$contentPosTop  = htmlspecialchars($params['contentPosTop']);
$marginLeftRight	= htmlspecialchars($params['marginLeftRight']);
if ($marginLeftRight > " " and $marginLeftRight > 0 and $marginLeftRight < 50) {} 
	else { $marginLeftRight = 2; }
$itemPageWidth  = htmlspecialchars($params['itemPageWidth']);
if ($itemPageWidth > " " and $itemPageWidth < 100 and $itemPageWidth > 0) {}
	else { $itemPageWidth = 100; }
$tagListItemWidth    = htmlspecialchars($params['tagListItemWidth']);
if ($tagListItemWidth > " " and $tagListItemWidth > 0 and $tagListItemWidth <= 100) { } 
	else { $tagListItemWidth = 30; }

$tagItemTitleDisplay   = htmlspecialchars($params['tagItemTitleDisplay']);
$itemVideoHeight= htmlspecialchars($params['itemVideoHeight']);
$itemLeadHeight = htmlspecialchars($params['itemLeadHeight']);
$itemLeadWidth  = htmlspecialchars($params['itemLeadWidth']);
$itemLeadMargin = htmlspecialchars($params['itemLeadMargin']);
$itemHeight    	= htmlspecialchars($params['itemHeight']);
$itemWidth    	= htmlspecialchars($params['itemWidth']);
$itemMargin    	= htmlspecialchars($params['itemMargin']);
$linkColor    	= htmlspecialchars($params['linkColor']);
$linkDecoration = htmlspecialchars($params['linkDecoration']);
$linkHvColor    = htmlspecialchars($params['linkHvColor']);
$menuLineHeight = htmlspecialchars($params['menuLineHeight']);
$menuMarginTop  = htmlspecialchars($params['menuMarginTop']);
$menuMarginLeft = htmlspecialchars($params['menuMarginLeft']);
$menuColor    	= htmlspecialchars($params['menuColor']);
$menuBgColor   	= htmlspecialchars($params['menuBgColor']);
$menuFontSize 	= htmlspecialchars($params['menuFontSize']); 
$menuDisplay 	= htmlspecialchars($params['menuDisplay']);
$menuLineHeight = htmlspecialchars($params['menuLineHeight']);
$menuDecoration = htmlspecialchars($params['menuDecoration']);
$menuHvColor    = htmlspecialchars($params['menuHvColor']);
$menuHvDecoration  	= htmlspecialchars($params['menuHvDecoration']);
$menuActiveColor  	= htmlspecialchars($params['menuActiveColor']);
$menuActiveDecoration  	= htmlspecialchars($params['menuActiveDecoration']);
$footerWidth    = htmlspecialchars($params['footericonsWidth']);
$footerPosLeft  = htmlspecialchars($params['footerPosLeft']);
$footerPosBottom	= htmlspecialchars($params['footerPosBottom']);
$wsaCustomCSS    	= htmlspecialchars($params['wsaCustomCSS']); // url
if ($wsaCustomCSS == '-1' ) {$wsaCustomCSS = '';};
if ($wsaCustomCSS > ' ' and strtolower(substr ( $wsaCustomCSS , 0 , 7 )) == 'images/' ) 
 {$wsaCustomCSS = '/' . $wsaCustomCSS;}; 

$wsaCssFilename = strtolower(htmlspecialchars($params['wsaCssFilename']));
 if ($wsaCssFilename > " ")
 {$path_parts = pathinfo($wsaCssFilename);
 if (path_parts['extension'] <> 'css'){$wsaCssFilename = $wsaCssFilename . '.css';};
 }
 else
 { $wsaCssFilename = 'template.min.' . $templatestyleid . '.css';}
 

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
$rightWidth = $contentPosRight - (0.5 * $marginLeftRight);
switch ($menuDisplay) {
    case "inline":
        $asModMenuDisplay  = "inline;";
        break;
    case "inline-block center":
        $asModMenuDisplay  = "inline-block;";
        break;
    case "inline-block left":
        $asModMenuDisplay  = "inline-block;";
        break;
    case "inline-block right":
        $asModMenuDisplay  = "inline-block;";
        break;
    case "block":
        $asModMenuDisplay  = "block";
        $asModMenuFloat    = "none";
        $asModMenuBackGround = "none; // geen achtergrond";
        $asModMenuPadding    = "0; // geen padding";
        break;
    default:
        $asModMenuDisplay  =  "";
}

if ( $hlWidth > " " and $hlWidth < 40) {
$iconsMobileLeft = $hlWidth;
$iconsMobileWidth =  100 - $hlWidth; 
}
try
 { /*begin try */

/* opslaan style parameters in style.less bestanden */


$tv_file =fopen($currentpath. '/../less/style' . $templatestyleid . '.var.less', "w+");


/* less files creeeren en compileren naar .css */

fwrite($tv_file, "// style variables \n");
fwrite($tv_file, "// generated " . date("c")  . "\n//\n");
fwrite($tv_file, "//  "  . "\n//\n");

fwrite($tv_file, "//  "  . "\n//\n");
fwrite($tv_file, "//  "  . "\n//\n");
if ($gplusProfile > ' '  ) 	fwrite($tv_file, '@gplusProfile:              "'  . $gplusProfile .  "\";\n");
if ($wsaIconsMobileTopMargin > ' '  ) 	fwrite($tv_file, '@wsaIconsMobileTopMargin:           '  . $wsaIconsMobileTopMargin .  "px;\n");
if ($wsaIconsMobileLeft > ' '  ) 	fwrite($tv_file, '@wsaIconsMobileLeft:           '  . $wsaIconsMobileLeft .  "%;\n");
if ($wsaIconsMobileWidth > ' '  ) 	fwrite($tv_file, '@wsaIconsMobileWidth:          '  . $wsaIconsMobileWidth .  "%;\n");
if ($hlMarginTop > ' '  ) 	fwrite($tv_file, '@hlMarginTop:               '  . $hlMarginTop .  "%;\n");
if ($hlMarginLeft > ' '  ) 	fwrite($tv_file, '@hlMarginLeft:              '  . ($hlMarginLeft + $marginLeftRight) .  "%;\n");
if ($hlWidth > ' '  ) {		fwrite($tv_file, '@asHeadLeftWidth:           '  . $hlWidth .  "%;\n");
				fwrite($tv_file, '@asPageHeadWidth:           '  . (100 - (2.5 * $marginLeftRight) - $hlWidth - $hlMarginLeft) .  "%;\n");}
if ($hlHeight > ' '  ) 		fwrite($tv_file, '@hlHeight:                  '  . (10 * $hlHeight) .  "%;\n");
if ($hlMarginBottom > ' '  ) 	fwrite($tv_file, '@hlMarginBottom:            '  . $hlMarginBottom .  "%;\n");
if ($showTitle > ' '  ) 	fwrite($tv_file, '@showTitle:                 '  . $showTitle .  ";\n");
if ($phMarginTop > ' '  ) 	fwrite($tv_file, '@phMarginTop:               '  . $phMarginTop .  "%;\n");
if ($phWidth > ' '  ) 		fwrite($tv_file, '@asPageHeadH1Width:         '  . $phWidth .  "%;\n");
if ($fgColor > ' '  ) 	{	fwrite($tv_file, '@asTextColor:               '  . $fgColor .  ";\n");
				fwrite($tv_file, '@asMainH1Color:             '  . $fgColor .  ";\n");
				fwrite($tv_file, '@asH1Color:                 '  . $fgColor .  ";\n");
}
if ($bgColor > ' '  ) 		fwrite($tv_file, '@asBodyBackgroundColor:     '  . $bgColor .  ";\n");

if ($bgImage > ' '  ) 		fwrite($tv_file, '@bgImage:                   "'  . $bgImage .  "\";\n");
if ($bg0Image_lg > ' '  ) 	fwrite($tv_file, '@bg0Image_lg:               "'  . $bg0Image_lg .  "\";\n");	
if ($bg0Image_sm > ' '  ) 	fwrite($tv_file, '@bg0Image_sm:               "'  . $bg0Image_sm .  "\";\n");	
if ($bg0Breakpoint_lg > ' '  ) fwrite($tv_file, '@bg0Breakpoint_lg:          '  . $bg0Breakpoint_lg .  "px;\n");
if ($bg0Breakpoint_sm > ' '  ) fwrite($tv_file, '@bg0Breakpoint_sm:          '  . $bg0Breakpoint_sm .  "px;\n");

if ($bgWidth > ' '  ) 		fwrite($tv_file, '@bgWidth:                   '  . $bgWidth .  "%;\n");
if ($bgTop > ' '  ) 		fwrite($tv_file, '@bgTop:                     '  . $bgTop .  "%;\n");
if ($bgLeft > ' '  ) 		fwrite($tv_file, '@bgLeft:                    '  . $bgLeft .  "%;\n");

if ($logo > ' '  ) 			fwrite($tv_file, '@logo:                      "'  . $logo .  "\";\n");
if ($bg1Image_lg > ' '  ) 	fwrite($tv_file, '@bg1Image_lg:               "'  . $bg1Image_lg .  "\";\n");	
if ($bg1Image_sm > ' '  ) 	fwrite($tv_file, '@bg1Image_sm:               "'  . $bg1Image_sm .  "\";\n");	
if ($bg1Breakpoint_lg > ' '  ) fwrite($tv_file, '@bg1Breakpoint_lg:          '  . $bg1Breakpoint_lg .  "px;\n");	
if ($bg1Breakpoint_sm > ' '  ) fwrite($tv_file, '@bg1Breakpoint_sm:          '  . $bg1Breakpoint_sm .  "px;\n");

if ($logoWidth > ' '  ) 	fwrite($tv_file, '@asLogoWidth:               '  . $logoWidth .  "%;\n");
if ($logoPosLeft > ' '  ) 	fwrite($tv_file, '@asLogoLeft:                '  . $logoPosLeft .  "%;\n");
if ($logoPosTop > ' '  ) 	fwrite($tv_file, '@asLogoTop:                 '  . (10 * $logoPosTop) .  "%;\n");
if ($iconsWidth > ' '  ) 	fwrite($tv_file, '@iconsWidth:                '  . $iconsWidth .  "%;\n");
if ($iconsPosLeft > ' '  ) 	fwrite($tv_file, '@iconsPosLeft:              '  . $iconsPosLeft .  "%;\n");
if ($iconsPosTop > ' '  ) 	fwrite($tv_file, '@iconsPosTop:               '  . $iconsPosTop .  "%;\n");
if ($contentPosLeft > ' '  ) {	fwrite($tv_file, '@asBlogItemWidth:           '  . $contentPosLeft .  "%;\n");} 
else {$contentPosLeft = 0; }
				fwrite($tv_file, '@contentWidth:              ' . (100 - $marginArea - $contentPosLeft)
 .  "%;\n") ; 
if ($contentPosRight > ' '  ) 	fwrite($tv_file, '@contentPosRight:           '  . $contentPosRight .  "%;\n");
if ($rightWidth > ' '  ) 	fwrite($tv_file, '@rightWidth:                '  . $rightWidth .  "%;\n");

if ($contentPosTop > ' '  ) 	fwrite($tv_file, '@contentPosTop:             '  . $contentPosTop .  "%;\n");
  
if ($marginLeftRight > ' '  ) 	fwrite($tv_file, '@asMarginStd:               '  . $marginLeftRight .  "%;\n");
if ($tagItemTitleDisplay > ' '  ) fwrite($tv_file, '@tagItemTitleDisplay:       '  . $tagItemTitleDisplay .  ";\n");
if ($itemVideoHeight > ' '  ) 	fwrite($tv_file, '@asVideoHeight:             '  . $itemVideoHeight .  "%;\n");
if ($itemLeadHeight > ' '  ) 	fwrite($tv_file, '@itemLeadHeight:            '  . $itemLeadHeight .  "%;\n");
if ($itemLeadWidth > ' '  ) 	fwrite($tv_file, '@itemLeadWidth:             '  . $itemLeadWidth .  "%;\n");
if ($itemLeadMargin > ' '  ) 	fwrite($tv_file, '@itemLeadMargin:            '  . $itemLeadMargin .  "%;\n");
if ($itemHeight > ' '  ) 		fwrite($tv_file, '@itemHeight:                '  . $itemHeight .  "%;\n");
if ($itemWidth > ' '  ) 		fwrite($tv_file, '@asItemWidth:               '  . $itemWidth .  "%;\n");
if ($itemMargin > ' '  ) 		fwrite($tv_file, '@itemMargin:                '  . $itemMargin .  "%;\n");
if ($linkColor > ' '  ) 		fwrite($tv_file, '@linkColor:                 '  . $linkColor .  ";\n");
if ($linkDecoration > ' '  ) 	fwrite($tv_file, '@asLinkDecoration:          '  . $linkDecoration .  ";\n");
if ($linkHvColor > ' '  ) 		fwrite($tv_file, '@asModMenuLinkColorHover:   '  . $linkHvColor .  ";\n");
if ($menuLineHeight > ' '  ) 	fwrite($tv_file, '@menuLineHeight:            '  . $menuLineHeight .  "em;\n");
if ($menuMarginTop > ' '  ) 	fwrite($tv_file, '@asModMenuMarginTop:        '  . $menuMarginTop .  "%;\n");
if ($menuMarginLeft > ' '  ) 	fwrite($tv_file, '@asModMenuMarginLeft:       '  . $menuMarginLeft .  "%;\n");
if ($menuColor > ' '  ) 	fwrite($tv_file, '@asModMenuLinkColor:        '  . $menuColor .  ";\n");
if ($menuBgColor > ' '  ) 	fwrite($tv_file, '@asModMenuUlBackgroundColor: '  . $menuBgColor .  ";\n");
if ($asModMenuBackGround > ' '  ) 	fwrite($tv_file, '@asModMenuBackGround:       '  . $asModMenuBackGround .  ";\n");
if ($asModMenuPadding > ' '  )	fwrite($tv_file, '@asModMenuPadding:          '  . $asModMenuPadding .  ";\n");
if ($menuFontSize > ' '  ) 	fwrite($tv_file, '@asModMenuUlFontSize:       '  . $menuFontSize .  "px;\n");
if ($asModMenuDisplay > ' '  ) 	fwrite($tv_file, '@asModMenuDisplay:          '  . $asModMenuDisplay .  ";\n");
if ($asModMenuFloat > ' '  ) 	fwrite($tv_file, '@asModMenuFloat:            '  . $asModMenuFloat .  ";\n");
if ($menuLineHeight > ' '  ) 	fwrite($tv_file, '@asModMenuUlLineHeight:     '  . $menuLineHeight .  "em;\n");
if ($menuDecoration > ' '  ) 	fwrite($tv_file, '@asModMenuDecoration:       '  . $menuDecoration .  ";\n");
if ($menuHvColor > ' '  ) 	fwrite($tv_file, '@asModMenuLinkColorHover:   '  . $menuHvColor .  ";\n");
if ($menuHvDecoration > ' '  ) 	fwrite($tv_file, '@menuHvDecoration:          '  . $menuHvDecoration .  ";\n");
if ($menuActiveColor > ' '  ) 	fwrite($tv_file, '@asModMenuActiveColor:      '  . $menuActiveColor .  ";\n");
if ($menuActiveDecoration > ' '  ) { fwrite($tv_file, '@asModMenuActiveDecoration: '  . $menuActiveDecoration .  ";\n");
				fwrite($tv_file, '@asModMenuLinkDecorationHover: '  . $menuActiveDecoration .  ";\n");
}
if ($footerWidth > ' '  ) 	fwrite($tv_file, '@footerWidth:               '  . $footerWidth .  "%;\n");
if ($footerPosLeft > ' '  ) 	fwrite($tv_file, '@footerPosLeft:             '  . $footerPosLeft .  "%;\n");
if ($footerPosBottom > ' '  ) 	fwrite($tv_file, '@footerPosBottom:           '  . $footerPosBottom .  "%;\n");
if ($areaWidth > ' '  ) 	fwrite($tv_file, '@areaWidth:                 '  . $areaWidth .  "%;\n");
if ($marginArea > ' '  ) 	fwrite($tv_file, '@marginArea:                '  . $marginArea .  "%;\n");
if ($tagListItemWidth > ' '  ) {fwrite($tv_file, '@tagListItemWidth:          '  . $tagListItemWidth .  "%;\n");
}

fclose($tv_file);

$st_file =fopen($currentpath. '/../less/style' . $templatestyleid . '.less', "w+");

fwrite($st_file, "// style" . $templatestyleid .  ".less \n");
fwrite($st_file, "// generated  " . date("c")  . "\n//\n");
fwrite($st_file, "// css        " . $wsaCssFilename  . "\n//\n");
// standaard bootstrap variables.
fwrite($st_file, '@import "twbs/variables.less";' . "\n");
fwrite($st_file, '@import "system.less";' . "\n");
fwrite($st_file, '@import "general.less";' . "\n");
fwrite($st_file, '@import "magnificpopup.variables.less";' . "\n");
fwrite($st_file, '@import "template_variables.less";' . "\n");
fwrite($st_file, '@import "flickr_badge.less";' . "\n");
fwrite($st_file, '@import "joomla_update_icons.less";' . "\n");
if ($background > ' '  )
{ 	
	$pos1 = stripos($background, ".css");
	if ($pos1 > 0)
	{
    $background = substr_replace($background, '.less', $pos1, 4) ;
	}
	fwrite($st_file, '@import "'  . $background .  "\";\n");
}
fwrite($st_file, '@import "style' . $templatestyleid . '.var.less";' . "\n");
// standaard bootstrap mixins en nav etc.
fwrite($st_file, '@import "twbs/mixins/border-radius.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/buttons.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/clearfix.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/forms.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/gradients.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/grid.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/nav-divider.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/nav-vertical-align.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/reset-filter.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/tab-focus.less";' . "\n");
fwrite($st_file, '@import "twbs/mixins/vendor-prefixes.less";' . "\n");
fwrite($st_file, '@import "twbs/navbar.less";' . "\n");
fwrite($st_file, '@import "twbs/navs.less";' . "\n");
//mfp
fwrite($st_file, '@import "magnificpopup.less";' . "\n");
//template style asha-s specifiek
fwrite($st_file, '@import "template_css.less";' . "\n");
fwrite($st_file, "body {\n");
if ($fgColor > ' '  ) fwrite($st_file, "color:  @asTextColor ;\n");
if ($bg0Color > ' ' ) fwrite($st_file, "background-color:  @bg0Color;\n");
//if ($bg0Image > ' ' ) fwrite($st_file, "background-image: url(@bg0Image);\n"); 
if ($bg0Size > ' '  ) fwrite($st_file, "background-size: @bg0Size;\n");
//if ($bg0Repeat > ' ') fwrite($st_file, "background-repeat:  @bg0Repeat;\n");
if ($bg0Pos > ' '   ) fwrite($st_file, "background-position: @bg0Pos;\n");
fwrite($st_file, "}\n");

fwrite($st_file, "body>div.container {\n");
if ($bg1Color > " " ) fwrite($st_file, "background-color:  @bg1Color;\n");
//if ($bg1Image > ' ' ) fwrite($st_file, "background-image: @bg1Image;\n"); 
if ($bg1Size > ' '  ) fwrite($st_file, "background-size: @bg1Size;\n");
//if ($bg1Repeat > ' ') fwrite($st_file, "background-repeat:  @bg1Repeat;\n");
if ($bg1Pos > ' '   ) fwrite($st_file, "background-position: @bg1Pos;\n");
fwrite($st_file, "}\n");

if ($bg1Image > ' ' || $bg1Color > " ") 
{
fwrite($st_file, "\n.navbar,\n.navbar-inner,\n.nav-tabs,\n.breadcrumb\n{\n");
fwrite($st_file, "background-color: transparent;\n");
fwrite($st_file, "background-image: none;\n");	
fwrite($st_file, "border-style: none;\n");
fwrite($st_file, "}\n");
}

if ($wsaCustomCSS > ' ') fwrite($st_file, '@import "'.JPATH_ROOT.'/images/less/'.$wsaCustomCSS.'";'. "\n");

fclose($st_file);

/* einde opslaam style parameters in style.les bestanden */
/* les files compileren naar .css */

$less->compileFile($currentpath. '/../less/style' . $templatestyleid . '.less', $currentpath.'/../css/' . $wsaCssFilename);


if ($home == 1 ) 
 {$less->compileFile($currentpath. '/../less/style' . $templatestyleid . '.less', $currentpath.'/../css/template.min.'  . '.css');
  $less->compileFile($currentpath. '/../less/style' . $templatestyleid . '.less', $currentpath.'/../css/template'  . '.css');
 }
/* einde les files compileren naar .css */
/* "Compileren LESS geslaagd." "COM_TEMPLATES_COMPILE_SUCCESS" */
$app->enqueueMessage("Compile LESS succes.", 'message');


/* end try */
}
catch (Exception $e)
{
 $app->enqueueMessage($e->getMessage(), 'error');
 return false;
}

/* end creeren en compileren */
}


return true;
/* eind test */
}
/* eind WsaFormRuleCompiler */
}
class WsaAshaLess extends Leafo\Less\lessc
{
	/**
	 * Constructor
	 *
	 * @param   string                 $fname      Filename to process
	 * @param   WsaAshasLessFormatter  $formatter  Formatter object, or string formatter_name
	 *
	 * @since   3.4
	 */
	public function __construct($fname = null, $formatter = null)
	{
		parent::__construct($fname);
		
		if ($formatter === null)
		{
		    $formatter = new WsaAshasLessFormatter;
		}
		
		$this->setFormatter($formatter);
	}
	
	/**
	 * Override compile to reset $this->allParsedFiles array to allow
	 * parsing multiple files/strings using same imports.
	 * PR: https://github.com/leafo/lessphp/pull/607
	 *
	 * For documentation on this please see /vendor/leafo/lessc.inc.php
	 *
	 * @param   string  $string  LESS string to parse.
	 * @param   string  $name    The sourceName used for error messages.
	 *
	 * @return  string  $out     The compiled css output.
	 */
	public function compile($string, $name = null)
	{
		$this->allParsedFiles = array();
		
		return parent::compile($string, $name);
	}
}

class WsaAshasLessFormatter extends Leafo\Less\lessc_formatter_classic
{
	public $disableSingle = true;
	
	public $breakSelectors = true;
	
	public $assignSeparator = ': ';
	
	public $selectorSeparator = ',';
	
	public $indentChar = "\t";
}

