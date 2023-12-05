package com.pallycon.sample.token.policy.securityPolicy.playready;

/**
 * for @security_policy @playready @security_level @digital_video_protection_level
 */
public enum DigitalVideoProtection {
    LEVEL_100(100),
    LEVEL_250(250),
    LEVEL_270(270),
    LEVEL_300(300),
    LEVEL_301(301);

    private int value;

    DigitalVideoProtection(int value) {
        this.value = value;
    }

    public int getValue() {
        return this.value;
    }
}
