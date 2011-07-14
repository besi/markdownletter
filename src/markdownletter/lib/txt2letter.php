<?php
require_once('lib/markdown.php');	
require_once('lib/simple_html_dom.php');

# Txt2Letter Class

# Global default settings:

# Name of the form
@define(TEXT_PARAM_NAME, "markdownText");

/*

  Usage:
  require_once('lib/txt2letter.php');	
  $txt2Letter = new Txt2Letter();
  $my_text = $txt2Letter->getHtmlMarkdown();
  $my_text = $txt2Letter->getHtmlWithIdsBQ($my_text);
  echo $my_text; 	

*/

class Txt2Letter {

  	function Txt2Letter() {
  	}
	  
    function getTextPlain() {
   		return $_POST[TEXT_PARAM_NAME];
    }
    
    function getTextStripped() {
  		$txt = $_POST[TEXT_PARAM_NAME];
  		return stripslashes($txt);
    }
    
    function getHtmlMarkdown(){
      $txt = $this->getTextStripped();
    	$my_html = Markdown($txt);
      return $my_html;    
    }
    
    function getHtmlWithIdsP($markup) {
      $dom = str_get_html($markup);
      $elem_array = $dom->find('p');
      $elem_array[0]->id = 'from';
      $elem_array[1]->id = 'to';
      $elem_array[2]->id = 'date';
      $elem_array[count($elem_array)-1]->id = 'sign';
      $elem_array[count($elem_array)-2]->id = 'greet';
      return strval($dom);
    }
    
    function getHtmlWithIdsBQ($markup) {
      $dom = str_get_html($markup);
      $elem_array = $dom->find('blockquote p');
      $elem_array[0]->id = 'from';
      $elem_array[1]->id = 'to';
      $elem_array[2]->id = 'date';
      $elem_array[3]->id = 'greet';
      $elem_array[4]->id = 'sign';
      return strval($dom);
    }
}

?>