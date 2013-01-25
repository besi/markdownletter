<?php

require_once('./classes/Constants.class.php');
require_once('./classes/WebRequest.class.php');
require_once('./classes/OutPutWrapper.class.php');
require_once('./classes/Mailer.class.php');

require_once('./lib/markdown.php');
include('./lib/mpdf/mpdf.php');

/**
* Web Controller
*
* Usage:
* TODO
*/


$request = new WebRequest();


// Handle Controller Actions
$action = $request->getAction();

switch ($action) {  
  
	case CONTROLLER_ACTION_GET_HTML:
		$mdText = $request->getContent();
		$html = Markdown($mdText);
		$out = new OutPutWrapper(OUTPUTWRAPPER_CODE_OK, $html);
		echo $out->toJson();
	break;
	
	
	case CONTROLLER_ACTION_GET_PDF:
		$html = $request->getContent();
		$html = stripslashes($html);
		$template = $request->getTemplate();
	
		$stylesheet = file_get_contents(TEMPLATE_PATH.$template);	
		
		$mpdf = new mPDF();
		$mpdf->WriteHTML($stylesheet, 1);
		$mpdf->WriteHTML($html);
		$mpdf->Output($DEFAULT_PDF_FILENAME, 'D');
		exit;


	case CONTROLLER_ACTION_SEND_PDF_MAIL:
		$html = $request->getContent();
		$html = stripslashes($html);
		$template = $request->getTemplate();
		$to = $request->getEMail();
		
		$stylesheet = file_get_contents(TEMPLATE_PATH.$template);			
		
		$mpdf = new mPDF();
		$mpdf->WriteHTML($stylesheet, 1);
		$mpdf->WriteHTML($html);
		$content = $mpdf->Output('', 'S');
		
		$mailer = new Mailer($to, $DEFAULT_PDF_FILENAME, $content);
		$mailer->sendMail();
	break;
	
	default:
	$out = new OutPutWrapper(OUTPUTWRAPPER_CODE_ERROR_FATAL, OUTPUTWRAPPER_CODE_ERROR_MISSING_PARAM_MSG);
	die($out->toJson());
}

// Show additional Debug information
if ($request->getDebug()){
   $out = new OutPutWrapper(OUTPUTWRAPPER_CODE_OK, "<hr/><h1>Debug Information</h1><pre>".print_r($request, true)."</pre><hr/>");
   echo ($out->toString());
}


?>