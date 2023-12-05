package com.pallycon.sample.token.policy;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonPropertyOrder;
import com.pallycon.sample.token.policy.securityPolicy.ncg.NcgControlHdcp;

/**
 * @related security_policy
 */
@JsonInclude(JsonInclude.Include.NON_NULL)
@JsonPropertyOrder({"allow_mobile_abnormal_device", "allow_external_display", "control_hdcp"})

public class SecurityPolicyNcg {

    @JsonProperty("allow_mobile_abnormal_device")
    private Boolean allowMobileAbnormalDevice;
    @JsonProperty("allow_external_display")
    private Boolean allowExternalDisplay;
    @JsonProperty("control_hdcp")
    private Integer controlHdcp;

    public SecurityPolicyNcg() {
    }

    public SecurityPolicyNcg allowMobileAbnormalDevice(boolean allowMobileAbnormalDevice) {
        this.allowMobileAbnormalDevice = allowMobileAbnormalDevice;
        return this;
    }
    public SecurityPolicyNcg allowExternalDisplay(boolean allowExternalDisplay) {
        this.allowExternalDisplay = allowExternalDisplay;
        return this;
    }
    public SecurityPolicyNcg controlHdcp(NcgControlHdcp controlHdcp) {
        this.controlHdcp = controlHdcp.getValue();
        return this;
    }

    public Boolean getAllowMobileAbnormalDevice() {
        return allowMobileAbnormalDevice;
    }

    public Boolean getAllowExternalDisplay() {
        return allowExternalDisplay;
    }

    public Integer getControlHdcp() {
        return controlHdcp;
    }
}
