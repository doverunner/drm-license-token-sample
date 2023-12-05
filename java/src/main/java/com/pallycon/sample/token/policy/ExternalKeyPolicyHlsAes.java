package com.pallycon.sample.token.policy;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonPropertyOrder;
import com.pallycon.sample.token.policy.common.TrackType;

@JsonInclude(JsonInclude.Include.NON_NULL)
@JsonPropertyOrder({"track_type", "key", "iv", "key_id"})
public class ExternalKeyPolicyHlsAes {

    @JsonProperty("track_type")
    private TrackType trackType;
    @JsonProperty("key")
    private String key;
    @JsonProperty("iv")
    private String iv;
    @JsonProperty("key_id")
    private String keyId;

    public ExternalKeyPolicyHlsAes(TrackType trackType, String key, String iv, String keyId) {
        this.trackType = trackType;
        this.key = key;
        this.iv = iv;
        this.keyId = keyId;
    }

    public String getTrackType() {
        return trackType.getValue();
    }

    public String getKey() {
        return key;
    }

    public String getIv() {
        return iv;
    }

    public String getKeyId() {
        return keyId;
    }
}
