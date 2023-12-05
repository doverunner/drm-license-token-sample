package com.pallycon.sample.token.policy.securityPolicy.ncg;

/**
 * for @security_policy @control_hdcp
 */
public enum NcgControlHdcp {

    HDCP_NONE("HDCP_NONE", 0),
    HDCP_V1_4("HDCP_V1_4", 1),
    HDCP_V2_2("HDCP_V2_2", 2);

    private String type;
    private int value;

    NcgControlHdcp(String type, int value) {
        this.type = type;
        this.value = value;
    }

    public String getType() {
        return type;
    }

    public int getValue() {
        return value;
    }

}
