<?php
namespace PallyCon\Exception;

use Exception;

class PallyConTokenException extends Exception{
    private $_errorCode;

    public function __construct($code = 0, Exception $previous = null) {
        $this->_errorCode = include "ErrorCode.php";
        parent::__construct($this->_errorCode[$code], $code, $previous);

    }

    public function __toString() {
        return json_encode(["error_code"=> $this->code, "error_message"=>$this->message])."\n";
    }
    public function toString(){
        return json_encode(["error_code"=> $this->code, "error_message"=>$this->message]);
    }

}
