package com.pallycon.sample.token.policy.securityPolicy.playready;

/**
 * for @security_policy @security_level @playready
 */
public enum DigitalAudioProtection {

    LEVEL_100(100),
    LEVEL_250(250),
    LEVEL_300(300),
    LEVEL_301(301)
    ;

    private int value;

    DigitalAudioProtection(int value) {
        this.value = value;
    }

    public int getValue() {
        return this.value;
    }
}
