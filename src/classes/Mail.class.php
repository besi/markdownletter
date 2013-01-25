<?php

/**
 * OutPutWrapper
 *
 */

class OutPutWrapper {
  var $code;
  var $output;

  /**
  * Constructor
  * @param code Statuscode (Code < 0 --> failed / Code > 0 --> Success)
  * @param output Result
  */
  public function OutPutWrapper($code, $output) {
    $this->code = $code;
    $this->output = $output;
  }

  /**
  * @return String in JSON
  */
  public function toJson() {
    $obj["code"] = $this->code;
    $obj["result"] = $this->output;
    $json = json_encode($obj);
    return $json;
  }

  /**
  * @return Result as String
  */
  public function toString() {
    return $this->output;
  }
}
?>