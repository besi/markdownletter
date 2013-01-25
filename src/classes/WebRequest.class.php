<?php header("Content-Type: text/html; charset=utf-8"); ?>
<?php
/**
 * WebRequest
 */

  class WebRequest {
    private $requestParams;

    function WebRequest() {
        if (!empty($_GET)){
        $this->requestParams = $_GET;
      } else {
        $this->requestParams = $_POST;
      }
    }

    function getParameter() {
        if (!empty($this->requestParams)){
        	return $this->requestParams;
        } else {
        	return null;
        }
    }

    function getAction() {
      if (!empty($this->requestParams[CONTROLLER_ACTION])) {
        return $this->requestParams[CONTROLLER_ACTION];
      } else {
        return null;
      }
    }
  
    function getContent() {
      if (!empty($this->requestParams[CONTROLLER_CONTENT])) {
        return $this->requestParams[CONTROLLER_CONTENT];
      } else {
        return null;
      }
    }
    
    function getTemplate() {
      if (!empty($this->requestParams[CONTROLLER_TEMPLATE])) {
        return $this->requestParams[CONTROLLER_TEMPLATE];
      } else {
        return null;
      }
    }
    
    function getEMail() {
      if (!empty($this->requestParams[CONTROLLER_EMAIL])) {
        return $this->requestParams[CONTROLLER_EMAIL];
      } else {
        return null;
      }
    }
    
    function getDebug() {
      if (!empty($this->requestParams)){
        if (isset($this->requestParams[CONTROLLER_DEBUG])) {
          return true;
        }
      } else {
        return false;
      }
    }

    function getReferer() {
    	$referer = $_SERVER["HTTP_REFERER"];
      if (!empty($referer)){
       return $referer;
      } else {
        return null;
      }
    }

}


?>