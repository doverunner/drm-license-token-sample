package com.pallycon.sample.token.policy.securityPolicy.widevine;

/**
 * for @security_policy @widevine @hdcp_srm_rule
 */
public enum HdcpSrmRule {
    HDCP_SRM_RULE_NONE("HDCP_SRM_RULE_NONE"),
    CURRENT_SRM("CURRENT_SRM");

    private String value;

    HdcpSrmRule(String value) {
        this.value = value;
    }

    public String getValue() {
        return this.value;
    }
}
