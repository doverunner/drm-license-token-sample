package com.pallycon.sample.token.policy.common;

/**
 * for @security_policy @track_type
 * for @external_key @mpeg_cenc
 * for @external_key @hls_aes
 */
public enum TrackType {

    ALL("ALL"),
    ALL_VIDEO("ALL_VIDEO"),
    AUDIO("AUDIO"),
    SD("SD"),
    HD("HD"),
    UHD1("UHD1"),
    UHD2("UHD2");

    private String value;

    TrackType(String value) {
        this.value = value;
    }

    public String getValue() {
        return this.value;
    }

}
