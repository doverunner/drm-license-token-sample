package com.pallycon.sample.token.policy.securityPolicy.widevine;

/**
 * for @security_policy @widevine @required_cgms_flags
 */
public enum RequiredCgmsFlags {

    CGMS_NONE("CGMS_NONE"),
    COPY_FREE("COPY_FREE"),
    COPY_ONCE("COPY_ONCE"),
    COPY_NEVER("COPY_NEVER");

    private String value;

    RequiredCgmsFlags(String value) {
        this.value = value;
    }

    public String getValue() {
        return this.value;
    }
}
