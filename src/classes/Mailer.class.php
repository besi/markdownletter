<?php

/**
 * Mailer 
 *
 */

class Mailer {
  private $to;
  private $fileName;
  private $content;

  /**
  * Constructor
  */
  public function Mailer($to, $fileName, $content) {
    $this->to = $to;
    $this->fileName = $fileName;
    $this->content = $content;
  }

  /**
  * @return 
  */
  public function sendMail() {
		$content = chunk_split(base64_encode($this->content));
		$mailto = $this->to;
		$from_name = 'MarkdownLetter';
		$from_mail = 'info@unicate.ch';
		$replyto = 'info@unicate.ch';
		$uid = md5(uniqid(time()));
		$subject = 'Your Letter';
		$message = 'Created with love and MarkdownLetter. www.unicate.ch/markdownletter';
		$filename = $this->fileName;
		
		$header = "From: ".$from_name." <".$from_mail.">\r\n";
		$header .= "Reply-To: ".$replyto."\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		$header .= "This is a multi-part message in MIME format.\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$header .= $message."\r\n\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
		$header .= "Content-Transfer-Encoding: base64\r\n";
		$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
		$header .= $content."\r\n\r\n";
		$header .= "--".$uid."--";
		$is_sent = @mail($mailto, $subject, "", $header);	
		$out = new OutPutWrapper(OUTPUTWRAPPER_CODE_OK, "");
		echo $out->toJson();
  }

  /**
  * @return Result as String
  */
  public function toString() {
    return $this->output;
  }
}
?>