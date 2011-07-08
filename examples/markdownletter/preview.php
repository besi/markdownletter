<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>MarkdownLetter - Preview</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	    
  		<link href="templates/<?php echo $_POST["letterTemplate"].".css"; ?>" charset="UTF-8" rel="stylesheet" rev="stylesheet" type="text/css"  />				
	</head>
<body>	
<?php
  require_once('lib/txt2letter.php');	
  $txt2Letter = new Txt2Letter();
  $my_text = $txt2Letter->getHtmlMarkdown();
  $my_text = $txt2Letter->getHtmlWithIdsBQ($my_text);
  echo $my_text; 	
?>
</body>
</html>