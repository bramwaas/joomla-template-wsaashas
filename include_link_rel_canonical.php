<?php
/* include_link_rel_canonical.php 
   wijs canonical pagina aan op basis van voorbeeld http://www.concept-br.de/blog/canonical-tag-for-joomla/
   nog experimenteel alleen voor category_blog
   bw 2014-01-10
*/
if(!class_exists('ContentHelperRoute')) require_once (JPATH_SITE . '/components/com_content/helpers/route.php');  
$ilr_url = JURI::getInstance()->toString();
$ilr_base_url = JURI::root();
$ilr_id = JRequest::getVar('id');
$ilr_view = JRequest::getVar('view');
// get current menu link for canonical meta tag creation
// ====================================================			

if($ilr_id > 0 && $ilr_view == 'article')
{
    // when no menu is available catid is necessary. find it from db
	$ilr_db = & JFactory::getDBO(); 
    $ilr_db->setQuery( "SELECT catid FROM #__content WHERE id = ".$ilr_id );
    $ilr_catid  = $ilr_db->loadResult();
    // echo "<!-- catid=".$ilr_catid." -->";
	$ilr_link = JRoute::_(ContentHelperRoute::getArticleRoute($ilr_id, $ilr_catid)); 
}
else if($ilr_id > 0 && $ilr_view == 'category')
{
	$ilr_link = JRoute::_(ContentHelperRoute::getCategoryRoute($ilr_id, 0));
}
else
{
		//unknown state
		$ilr_link = "";
}
$ilr_canonical_value = $ilr_base_url.substr($ilr_link,1);		
if($ilr_link != "" && $ilr_canonical_value != $ilr_url)
{
?>
	
<link rel="canonical" href="<?php echo($ilr_canonical_value); ?>" /> 
<?php
}
else
{
?>
	
<!-- link rel="canonical" href="<?php echo($ilr_canonical_value); ?>" / --> 
<?php
}
?>