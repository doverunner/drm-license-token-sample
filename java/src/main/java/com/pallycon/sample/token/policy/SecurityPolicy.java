package com.pallycon.sample.token.policy;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonPropertyOrder;
import com.pallycon.sample.token.policy.common.TrackType;

@JsonInclude(JsonInclude.Include.NON_NULL)
@JsonPropertyOrder({
        "track_type", "widevine", "playready", "fairplay", "ncg"
})
public class SecurityPolicy {

    @JsonProperty("track_type")
    private String trackType;

    @JsonProperty("widevine")
    private SecurityPolicyWidevine widevine;

    @JsonProperty("playready")
    private SecurityPolicyPlayready playready;

    @JsonProperty("fairplay")
    private SecurityPolicyFairplay fairplay;

    @JsonProperty("ncg")
    private SecurityPolicyNcg ncg;

    public SecurityPolicy() {
        this.trackType = TrackType.ALL.getValue();
    }

    public SecurityPolicy trackType(TrackType trackType) {
        this.trackType = trackType.getValue();
        return this;
    }
    public SecurityPolicy widevine(SecurityPolicyWidevine widevine) {
        this.widevine = widevine;
        return this;
    }
    public SecurityPolicy playready(SecurityPolicyPlayready playready) {
        this.playready = playready;
        return this;
    }
    public SecurityPolicy fairplay(SecurityPolicyFairplay fairplay) {
        this.fairplay = fairplay;
        return this;
    }
    public SecurityPolicy ncg(SecurityPolicyNcg ncg) {
        this.ncg = ncg;
        return this;
    }

    public String getTrackType() {
        return this.trackType;
    }

    public SecurityPolicyWidevine getWidevine() {
        return this.widevine;
    }

    public SecurityPolicyPlayready getPlayready() {
        return this.playready;
    }

    public SecurityPolicyFairplay getFairplay() {
        return this.fairplay;
    }

    public SecurityPolicyNcg getNcg() {
        return this.ncg;
    }
}
