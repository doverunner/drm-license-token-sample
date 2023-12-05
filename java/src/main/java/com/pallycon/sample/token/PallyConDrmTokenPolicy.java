package com.pallycon.sample.token;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonPropertyOrder;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.pallycon.sample.exception.PallyConTokenException;
import com.pallycon.sample.token.policy.ExternalKeyPolicy;
import com.pallycon.sample.token.policy.PlaybackPolicy;
import com.pallycon.sample.token.policy.SecurityPolicy;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

/**
 * Create policy data for @ PallyConDrmToken
 */
@JsonInclude(JsonInclude.Include.NON_NULL)
@JsonPropertyOrder({"policy_version", "playback_policy", "security_policy", "external_key"})
public class PallyConDrmTokenPolicy {

    @JsonProperty("policy_version")
    private final int POLICY_VERSION = 2;

    @JsonProperty("playback_policy")
    private PlaybackPolicy playbackPolicy;

    @JsonProperty("security_policy")
    private List<SecurityPolicy> securityPolicy;

    @JsonProperty("external_key")
    private ExternalKeyPolicy externalKey;

    public PallyConDrmTokenPolicy(PolicyBuilder policyBuilder) {
        this.playbackPolicy = policyBuilder.playbackPolicy;
        this.securityPolicy = policyBuilder.securityPolicy;
        this.externalKey = policyBuilder.externalKey;
    }

    //----------------------------- start of builder pattern
    public static class PolicyBuilder{
        private PlaybackPolicy playbackPolicy;
        private List<SecurityPolicy> securityPolicy;
        private ExternalKeyPolicy externalKey;

        public PolicyBuilder() {
        }

        public PolicyBuilder playbackPolicy(PlaybackPolicy playbackPolicy) {
            this.playbackPolicy = playbackPolicy;
            return this;
        }
        public PolicyBuilder securityPolicy(List<SecurityPolicy> securityPolicyList) {
            this.securityPolicy = securityPolicyList;
            return this;
        }
        public PolicyBuilder securityPolicy(SecurityPolicy securityPolicy) {
            this.securityPolicy = Optional.ofNullable(this.securityPolicy).orElse(new ArrayList<SecurityPolicy>());
            this.securityPolicy.add(securityPolicy);
            return this;
        }
        public PolicyBuilder externalKey(ExternalKeyPolicy externalKey) {
            this.externalKey = externalKey;
            return this;
        }

        public PallyConDrmTokenPolicy build() throws PallyConTokenException {
            validate();
            PallyConDrmTokenPolicy policy = new PallyConDrmTokenPolicy(this);
            return policy;
        }

        private void validate() throws PallyConTokenException {
            if (null != this.playbackPolicy) {
                this.playbackPolicy.check();
            }

            if (null != this.externalKey) {
                this.externalKey.check();
            }
        }
    } //----------------------------- end of builder pattern

    public String toJsonString() throws PallyConTokenException {
        ObjectMapper objectMapper = new ObjectMapper();
        try {
            return objectMapper.writeValueAsString(this);
        } catch (JsonProcessingException e) {
            throw new PallyConTokenException("2001");
        }
    }

    public PlaybackPolicy getPlaybackPolicy() {
        return playbackPolicy;
    }

    public List<SecurityPolicy> getSecurityPolicy() {
        return securityPolicy;
    }

    public ExternalKeyPolicy getExternalKey() {
        return externalKey;
    }
}

