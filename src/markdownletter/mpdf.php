<?php
	include('lib/mpdf/mpdf.php');
	require_once('lib/txt2letter.php');		
	
	if (isset($_POST['markdownText']) && isset($_POST['letterTemplate'])) {
	
		$txt2Letter = new Txt2Letter();
		$my_text = $txt2Letter->getHtmlMarkdown();
		$my_text = $txt2Letter->getHtmlWithIdsBQ($my_text);
			
		$stylesheet = file_get_contents("templates/".$_POST["letterTemplate"].".css");
		
		// TODO: It would be nice if a letter heading is present if this is used as the filename
		// TODO: Example: "Application for Job" --> "YYYY-MM-DD_Application_for_Job.pdf"
		$fileName = date("Y-m-d")."_Letter.pdf";
		
		$mpdf=new mPDF();
		$mpdf->WriteHTML($stylesheet, 1);
		$mpdf->WriteHTML($my_text);
		$mpdf->Output($fileName, 'D');
		exit;
	}
?>