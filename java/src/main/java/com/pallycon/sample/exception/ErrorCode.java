package com.pallycon.sample.exception;

import com.fasterxml.jackson.annotation.JsonProperty;

public class ErrorCode {
    @JsonProperty("error_code")
    private String errorCode;
    @JsonProperty("error_message")
    private String errorMessage;

    public ErrorCode() {
    }

    public ErrorCode(String errorCode) {
        this.errorCode = errorCode;
        this.setErrorMessage(errorCode);
    }

    private void setErrorMessage(String errorCode) {

        switch (errorCode) {
            case "1000":
                this.errorMessage = "Token err : The userId is Required";
                break;
            case "1001":
                this.errorMessage = "Token err : The cId is Required";
                break;
            case "1002":
                this.errorMessage = "Token err : The siteId is Required";
                break;
            case "1003":
                this.errorMessage = "Token err : The accessKey is Required";
                break;
            case "1004":
                this.errorMessage = "Token err : The siteKey is Required";
                break;
            case "1005":
                this.errorMessage = "Token err : The policy is Required";
                break;
            case "1011":
                this.errorMessage = "PlaybackPolicy : The expireDate time format should be 'YYYY-MM-DD'T'HH:mm:ss'Z'";
                break;
            case "1018":
                this.errorMessage = "ExternalKey : ExternalKey should be filled with MpegCenc, HlsAes or Ncg if call the method \'.externalKey()\'";
                break;
            case "1040":
                this.errorMessage = "MpegCenc : The KeyId should be 16byte hex String";
                break;
            case "1041":
                this.errorMessage = "MpegCenc : The Key should be 16byte hex String";
                break;
            case "1042":
                this.errorMessage = "MpegCenc : The Iv should be 16byte hex String";
                break;
            case "1044":
                this.errorMessage = "HlsAes : The Key should be 16byte hex String";
                break;
            case "1045":
                this.errorMessage = "HlsAes : The Iv should be 16byte hex String";
                break;
            case "1047":
                this.errorMessage = "Ncg : The Cek should be 32byte hex String";
                break;
            case "2001":
                this.errorMessage = "json parser error";
                break;
        }
    }

    public String getErrorCode() {
        return this.errorCode;
    }

    public String getErrorMessage() {
        return this.errorMessage;
    }

}
