<?php
/**
 * Configuration
 */



 /** Configuration */
@define(TITLE, "MarkdownLetter");
@define(COPYRIGHT, "&copy; 2012");
@define(VERS, "Version 1.0");
@define(MAILTO, "<a href=\"mailto:info@unicate.ch\">Contact</a>");
@define(DISCLAIMER, "<a href=\"http://wiki.unicate.ch/Disclaimer\">Disclaimer</a>");
@define(CREDITS, "<a href=\"https://github.com/unicate/markdownletter\">MarkdownLetter</a> is powered by <a href=\"http://michelf.com/projects/php-markdown/\">PHP Markdown</a> and <a href=\"http://mpdf.bpm1.com/\">mPDF</a>");

@define(TEMPLATE_PATH, "./templates/");
@define(DEFAULT_TEXT, "defaultLetter.md.txt");

$DEFAULT_PDF_FILENAME = date("Y-m-d")."_Letter.pdf";


@define(JS_CONFIG, "
  var config = {titleName:\"MarkdownPages\", defaultPage:\"Default\"};
  var texts = {newPageName:\"Page Name:\", unsavedChanges:\"Unsaved changes, continue?\"};
");

 /** End Configuration */
 
 
 
 
/** URL-Attribute "action" */
@define(CONTROLLER_ACTION, "action");

/** Value for URL-Attribute "action": index.php?action= */
@define(CONTROLLER_ACTION_GET_HTML, "gethtml");

/** Value for URL-Attribute "action": index.php?action= */
@define(CONTROLLER_ACTION_GET_PDF, "getpdf");

/** Value for URL-Attribute "action": index.php?action= */
@define(CONTROLLER_ACTION_SEND_PDF_MAIL, "getpdfmail");

/** URL-Attribute "content" */
@define(CONTROLLER_CONTENT, "content");

/** URL-Attribute "template" */
@define(CONTROLLER_TEMPLATE, "template");

/** URL-Attribute "E-Mail" */
@define(CONTROLLER_EMAIL, "email");

/** URL-Attribute "debug": Debug-Mode */
@define(CONTROLLER_DEBUG, "debug");

/** OutputWrapper Codes: */
@define(OUTPUTWRAPPER_CODE_OK, 1);
@define(OUTPUTWRAPPER_CODE_ERROR, -1);
@define(OUTPUTWRAPPER_CODE_ERROR_FILEEXISTS, -2);
@define(OUTPUTWRAPPER_CODE_ERROR_FATAL, -3);
@define(OUTPUTWRAPPER_CODE_ERROR_CANNOT_SAVE, -4);
@define(OUTPUTWRAPPER_CODE_ERROR_MISSING_PARAM_MSG, "Sorry! Missing parameters.");

?>
