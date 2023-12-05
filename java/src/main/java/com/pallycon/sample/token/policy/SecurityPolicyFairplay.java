package com.pallycon.sample.token.policy;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonPropertyOrder;
import com.pallycon.sample.token.policy.securityPolicy.fairplay.FairplayHdcpEnforcement;

/**
 * @related security_policy
 */

@JsonInclude(JsonInclude.Include.NON_NULL)
@JsonPropertyOrder
        ({"hdcp_enforcement", "allow_airplay", "allow_av_adapter"})
public class SecurityPolicyFairplay {

    @JsonProperty("hdcp_enforcement")
    private Integer hdcpEnforcement;

    @JsonProperty("allow_airplay")
    private Boolean allowAirplay=true;

    @JsonProperty("allow_av_adapter")
    private Boolean allowAvAdapter=true;

    public SecurityPolicyFairplay() {
    }

    public SecurityPolicyFairplay hdcpEnforcement(FairplayHdcpEnforcement hdcpEnforcement) {
        this.hdcpEnforcement = hdcpEnforcement.getValue();
        return this;
    }
    public SecurityPolicyFairplay allowAirplay(boolean allowAirplay) {
        this.allowAirplay = allowAirplay;
        return this;
    }
    public SecurityPolicyFairplay allowAvAdapter(boolean allowAvAdapter) {
        this.allowAvAdapter = allowAvAdapter;
        return this;
    }

    public Integer getHdcpEnforcement() {
        return hdcpEnforcement;
    }

    public Boolean getAllowAirplay() {
        return allowAirplay;
    }

    public Boolean getAllowAvAdapter() {
        return allowAvAdapter;
    }
}
