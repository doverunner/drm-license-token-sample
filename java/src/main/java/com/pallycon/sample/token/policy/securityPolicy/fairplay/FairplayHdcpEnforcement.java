package com.pallycon.sample.token.policy.securityPolicy.fairplay;

/**
 * for @security_policy @fairplay
 */
public enum FairplayHdcpEnforcement {

    HDCP_NONE("HDCP_NONE", -1),
    HDCP_TYPE_0("HDCP_TYPE_0", 0),
    HDCP_TYPE_2("HDCP_TYPE_2", 1);

    private String type;
    private int value;

    FairplayHdcpEnforcement(String type, int value) {
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
