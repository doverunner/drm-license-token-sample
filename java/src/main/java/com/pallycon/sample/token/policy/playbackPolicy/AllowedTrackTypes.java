package com.pallycon.sample.token.policy.playbackPolicy;

/**
 * for @playback_policy @allowed_track_types
 */
public enum AllowedTrackTypes {

    ALL("ALL"),
    SD_ONLY("SD_ONLY"),
    SD_HD("SD_HD"),
    SD_UHD1("SD_UHD1"),
    SD_UHD2("SD_UHD2")
    ;

    private String value;

    AllowedTrackTypes(String value) {
        this.value = value;
    }

    public String getValue() {
        return this.value;
    }

}
