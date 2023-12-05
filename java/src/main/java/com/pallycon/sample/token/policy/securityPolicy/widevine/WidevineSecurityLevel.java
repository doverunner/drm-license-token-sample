package com.pallycon.sample.token.policy.securityPolicy.widevine;

/**
 * for @security_policy @widevine @security_level
 */
public enum WidevineSecurityLevel {

    SW_SECURE_CRYPTO(1),
    SW_SECURE_DECODE(2),
    HW_SECURE_CRYPTO(3),
    HW_SECURE_DECODE(4),
    HW_SECURE_ALL(5);

    private int value;

    WidevineSecurityLevel(int value) {
        this.value = value;
    }

    public int getValue() {
        return this.value;
    }

    public static int getValue(int value) {
        if (value == 0) {
            throw new IllegalArgumentException("Value cannot be null or empty!");
        }
        for (WidevineSecurityLevel level : WidevineSecurityLevel.values()) {
            if (level.getValue() == value) {
                return level.value;
            }
        }

        throw new IllegalArgumentException("Cannot create enum from " + value + " value!");
    }


    @Override
    public String toString() {
        return String.valueOf(this.value);
    }
}
