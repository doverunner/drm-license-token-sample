package com.pallycon.sample.token.policy;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonPropertyOrder;
import com.pallycon.sample.token.policy.common.TrackType;

@JsonInclude(JsonInclude.Include.NON_NULL)
@JsonPropertyOrder({"track_type", "key_id", "key", "iv"})
public class ExternalKeyPolicyMpegCenc {

    @JsonProperty("track_type")
    private TrackType trackType;
    @JsonProperty("key_id")
    private String keyId;
    @JsonProperty("key")
    private String key;
    @JsonProperty("iv")
    private String iv;

    public ExternalKeyPolicyMpegCenc(TrackType trackType, String keyId, String key) {
        this.trackType = trackType;
        this.keyId = keyId;
        this.key = key;
    }

    public ExternalKeyPolicyMpegCenc(TrackType trackType, String keyId, String key, String iv) {
        this.trackType = trackType;
        this.keyId = keyId;
        this.key = key;
        this.iv = iv;
    }

    public String getTrackType() {
        return trackType.getValue();
    }

    public String getKeyId() {
        return keyId;
    }

    public String getKey() {
        return key;
    }

    public String getIv() {
        return iv;
    }
}
