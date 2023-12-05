package com.pallycon.sample.token.policy.securityPolicy.playready;

/**
 * for @security_policy @playready @security_level
 */
public enum PlayreadySecurityLevel {

    LEVEL_150(150),
    LEVEL_2000(2000),
    LEVEL_3000(3000);

    private int value;

    PlayreadySecurityLevel(int value) {
        this.value = value;
    }

    public int getValue() {
        return this.value;
    }
}
