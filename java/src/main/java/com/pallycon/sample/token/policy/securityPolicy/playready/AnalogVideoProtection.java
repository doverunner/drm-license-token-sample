package com.pallycon.sample.token.policy.securityPolicy.playready;

/**
 * for @security_policy @playready @security_level @analog_video_protection_level
 */
public enum AnalogVideoProtection {
    LEVEL_100(100),
    LEVEL_150(150),
    LEVEL_200(200),
    LEVEL_201(201);

    private int value;

    AnalogVideoProtection(int value) {
        this.value = value;
    }

    public int getValue() {
        return this.value;
    }
}
