<?php
/**
 * @copyright	Copyright (c) 2014 Gsearch. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::stylesheet(Juri::base() . 'modules/mod_ariclesearch/tmpl/css/chosen.css');
JHtml::script(Juri::base() . 'modules/mod_ariclesearch/tmpl/js/jquery.min.js', $mootools);
JHtml::script(Juri::base() . 'modules/mod_ariclesearch/tmpl/js/chosen.jquery.min.js', $mootools);
/*
JLoader::import('joomla.application.component.model');
JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');
$model = JModelLegacy::getInstance('Articles', 'ContentModel');
$model->getState();
$model->setState('list.limit', -1);
*/
$model = JModelLegacy::getInstance('Articles', 'ContentModel');
$articles = $model->getItems();

?>

<div>
   <form id="artserch" name="form" method="post">
    <select data-placeholder="Serch article" multiple class="chosen-select-width" tabindex="16" name="art_sel">
	<option value=""></option>
	<?php
	foreach($articles as $article)
	{
		echo "<option value='".$article->id."'>$article->title</option>";
	}
	?>            
   </select>
   <button type="submit"  class="btn primary small">Go</button> 
  </form>
  <div id="text"></div>
</div>

<style>

.morecontent span {
	display: none;

}
.chosen-container .chosen-container-multi .chosen-with-drop .chosen-container-active {
width:180px !important;
}
</style>
<script type="text/javascript"> 
	$('.chosen-select-width').chosen();
	$('.chosen-container-active').css('width','180px');
	$('#artserch').submit(function(){
		var articles = $(this).serializeArray();		
			$.ajax({
				type : 'POST',
				url : '',
				data : {articles : articles,exe : 'articsonly'},
				success : function(result){
					$('#text').text('');
					$('#text').append(result);
					hidemore();		
				},
				error : function(error){
					alert('error');
				}
			});			
		return false;
	});

function hidemore()
{
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		
		var content = $(this).html();
		var regex = /(<([^>]+)>)/ig;
		content = content.replace(regex, "");

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			
			var h = content.substr(showChar-1, content.length - showChar);
			
			var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';
			//var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<a href="" class="morelink">'+moretext+'</a>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
}
	
</script>
