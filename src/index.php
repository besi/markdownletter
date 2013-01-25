<?php
header("Content-Type: text/html; charset=utf-8");
require_once('./classes/Constants.class.php');
?>
<!DOCTYPE html> 
<html> 
	<head> 
	<title><?php echo TITLE; ?></title> 
	<META NAME="Description" CONTENT="MarkdownLetter: The most simple way to write letters with Markdown. Write simple and nicely formated letters in Markdown. http://www.unicate.ch">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="apple-touch-icon" href="css/mdl-apple-touch-icon" />
	<link rel="icon" type="image/png" href="css/mdl-favicon" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
	<script type="text/javascript">
	$(document).on("mobileinit", function(){
		$.mobile.defaultPageTransition = 'none';
		$.mobile.defaultDialogTransition = 'none';
		$.mobile.useFastClick  = false;
	});
	$(document).on('pageinit','[data-role=page]', function(){
   	 $('[data-position=fixed]').fixedtoolbar({ tapToggle:false});
	});
	</script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script type="text/javascript"><?php echo JS_CONFIG ?></script>
	<script src="js/mdl.js"></script>
	<style>
	#preview{
		font: 10pt Arial,sans-serif;
		background-color: #ffffff;
		border: 1px solid #999999;
		width:700px;
		height:720px;
		margin-left:auto;
		margin-right:auto;
		border: 1px solid #cccccc;
		display:block
	}	
	.smallTop{
		padding-top:5px;
	}
	#letter textarea{
		font-family: Helvetica,Arial,sans-serif;
		font-size: 10pt;
		background-color: #ffffff;
		border: 1px solid #999999;
		width:600px;
		height:730px;
		margin-left:auto;
		margin-right:auto;
		margin-top:0:
		padding-top:0;
	}
	
	</style>
</head> 
<body> 

<div data-role="page" id="page1">
	<div data-role="header" data-position="fixed">
		<a id="settings" data-role="button" data-inline="true" data-icon="gear" data-rel="dialog" href="#dialogInfo" >Options</a>
		<h1><?php echo TITLE; ?></h1>
		<div class="ui-btn-right" data-role="controlgroup" data-type="horizontal">
			<a id="" data-role="button" data-inline="true" data-icon="star" onclick="$(this).getPDF();" >Save as PDF</a>
			<a id="" data-role="button" data-inline="true" data-icon="star"  data-rel="dialog" href="#enterEMail">E-Mail PDF</a>
		</div>
		<div data-role="navbar" data-iconpos="left">
			<ul>
				<li><a href="#page1" data-icon="edit" class="ui-btn-active ui-state-persist" id="defaultNavTab">Create</a></li>
				<li><a href="#page2" data-icon="grid" onclick="$(this).preview();">Preview</a></li>
			</ul>
		</div><!-- /navbar -->

	</div><!-- /header -->

	<div data-role="content" class="smallTop">	
		<div id="letter">
		  <textarea name="markdownText" id="markdownText" rows="" cols=""><?php include(TEMPLATE_PATH.DEFAULT_TEXT); ?></textarea>
		</div>	
	</div><!-- /content -->
	
</div><!-- /page -->

<div data-role="page" id="page2">
	<div data-role="header">		
		<a id="settings" data-role="button" data-inline="true" data-icon="gear" data-rel="dialog" href="#dialogInfo" >Options</a>
		<h1><?php echo TITLE; ?></h1>
		<div class="ui-btn-right" data-role="controlgroup" data-type="horizontal">
			<a id="" data-role="button" data-inline="true" data-icon="star" onclick="$(this).getPDF();" >Save as PDF</a>
			<a id="" data-role="button" data-inline="true" data-icon="star"  data-rel="dialog" href="#enterEMail">E-Mail PDF</a>
		</div>
		<div data-role="navbar" data-iconpos="left">
			<ul>
				<li><a href="#page1" data-icon="edit">Create</a></li>
				<li><a href="#page2" data-icon="grid" class="ui-btn-active ui-state-persist" onclick="$(this).preview();">Preview</a></li>
			</ul>
		</div><!-- /navbar -->

	</div><!-- /header -->

	<div data-role="content">	
		<iframe id="preview"></iframe>	
	</div><!-- /content -->

</div><!-- /page -->

<!-- Dialog -->
<div data-role="page" id="dialogInfo">
	<div data-role="header">
		<h1>Options / Info</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<?php echo COPYRIGHT." - ".VERS." - ".MAILTO." - ".DISCLAIMER."<br/>".CREDITS; ?>
		<hr />
<p>Writing a formal letter is not always a simple thing. Even though composing the content of the letter may only take a few minutes, creating the actual document and getting the formatting right takes much much more time than it really should. This is where markdownletter enters the story. </p>
<p>MarkdownLetter should be the most simple way to write letters. No worries about versions and compatibility of your office suite or cross-platform issues.</p>
<p>Just good old plain text. That's it!</p>

		
		<hr />
		<div data-role="fieldcontain">
			<label for="layout" class="select ui-select">Layout:</label>
			<select id="layout" name="layout" data-inline="true" data-mini="true"> 
				<option value="A4_address_right.css">A4 Address right</option>
				<option value="A4_address_left.css">A4 Address left</option>
				<option value="A4_address_right_grey.css">A4 Address right grey</option>
				<option value="A4_address_right_serif">A4 Address right serif</option>
			</select>	
		</div>		
		<div data-role="fieldcontain">
			<label for="editFont" class="select ui-select">Edit Font:</label>
			<select id="editFont" name="editFont" data-inline="true" data-mini="true">
				<option value="Helvetica,Arial,sans-serif">Standard</option>
				<option value="Courier, monospace">Monospace</option>
			</select>
		</div>
	
		
		<hr/>
		<a id="dialogCloseLink" href="#" data-role="button" data-rel="back">Close</a>   
	</div><!-- /content -->	
</div><!-- /dialog -->

<div data-role="page" id="enterEMail">
	<div data-role="header">
		<h1>E-Mail</h1>
	</div><!-- /header -->

	<div data-role="content">	
		Your PDF letter is sent to the following E-Mail address:
		<hr />
		
		<div data-role="fieldcontain">
   			<label for="name" class="select ui-select" data-mini="true">E-Mail:</label>
  		  	<input type="text" name="email" id="email" value=""  />
		</div>		
		<div id="emailSuccess"></div>
		<hr/>
		<a id="btn_sendMail" href="#" data-role="button" onclick="$(this).getPDFMail();">Send E-Mail</a>  
		<a id="dialogCloseLink" href="#" data-role="button" onclick="$(this).closeDialog();">Close</a>   
	</div><!-- /content -->	
</div><!-- /dialog -->

<form method="post" id="form" name="form" accept-charset="utf-8" data-ajax="false"></form>

</body>
</html>