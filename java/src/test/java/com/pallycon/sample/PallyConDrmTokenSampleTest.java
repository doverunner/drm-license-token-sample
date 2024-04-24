package com.pallycon.sample;

import com.pallycon.sample.token.policy.common.TrackType;
import com.pallycon.sample.token.policy.playbackPolicy.AllowedTrackTypes;
import com.pallycon.sample.token.policy.securityPolicy.fairplay.FairplayHdcpEnforcement;
import com.pallycon.sample.token.policy.securityPolicy.ncg.NcgControlHdcp;
import com.pallycon.sample.token.policy.securityPolicy.playready.DigitalAudioProtection;
import com.pallycon.sample.exception.PallyConTokenException;
import com.pallycon.sample.token.policy.securityPolicy.playready.AnalogVideoProtection;
import com.pallycon.sample.token.policy.securityPolicy.playready.DigitalVideoProtection;
import com.pallycon.sample.token.policy.securityPolicy.playready.PlayreadySecurityLevel;
import com.pallycon.sample.token.policy.securityPolicy.widevine.HdcpSrmRule;
import com.pallycon.sample.token.policy.securityPolicy.widevine.RequiredCgmsFlags;
import com.pallycon.sample.token.policy.securityPolicy.widevine.RequiredHdcpVersion;
import com.pallycon.sample.token.policy.securityPolicy.widevine.WidevineSecurityLevel;
import com.pallycon.sample.token.PallyConDrmTokenClient;
import com.pallycon.sample.token.PallyConDrmTokenPolicy;
import com.pallycon.sample.token.policy.*;
import com.pallycon.sample.v2.PolicyTest;
import org.junit.Before;
import org.junit.Test;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

/**
 * Sample Code for creating token.
 */
public class PallyConDrmTokenSampleTest {

    private static Logger logger = LoggerFactory.getLogger(PolicyTest.class);

    private String licenseTokenForPlayready = "";
    private String licenseTokenForWidevine = "";
    private String licenseTokenForFairplay = "";
    private String licenseTokenForNCG = "";

    private PallyConDrmTokenPolicy policy = null;
    private PallyConDrmTokenClient tokenForPlayready = null;
    private PallyConDrmTokenClient tokenForWidevine = null;
    private PallyConDrmTokenClient tokenForFairplay = null;
    private PallyConDrmTokenClient tokenForNCG = null;

    private PlaybackPolicy playbackPolicy = new PlaybackPolicy();
    private SecurityPolicy securityPolicyForAll = new SecurityPolicy();

    /**
     * NOTICE :
     * In this tutorial, we're going to create default license token for Widevine, PlayReady, FairPlay.
     *
     * STEPS TO GET TOKEN
     * 1. set up policies
     * 2. build policy
     * 3. create token
     *
     *  TODO need to fill out `Config.java`.
     *  fields in Config will be automatically match to `PallyConDrmTokenClient`
     *  Also `siteId, siteKey, accessKey, userId, cId` of PallyConDrmTokenClient can be substituted independently if want.
     */

    /**
     * 1. set up policies
     * In this tutorial,
     *      we only use `playback_policy`, `security_policy`
     *      Except `external_key`.
     * */
    @Before
    public void setUpPolicies() {
        SecurityPolicyWidevine widevineForAll = new SecurityPolicyWidevine()
                .securityLevel(WidevineSecurityLevel.SW_SECURE_CRYPTO)
                .requiredHdcpVersion(RequiredHdcpVersion.HDCP_NONE)
                .requiredCgmsFlags(RequiredCgmsFlags.CGMS_NONE)
                .hdcpSrmRule(HdcpSrmRule.HDCP_SRM_RULE_NONE)
                .overrideDeviceRevocation(true);
        SecurityPolicyFairplay fairplayForAll = new SecurityPolicyFairplay()
                .hdcpEnforcement(FairplayHdcpEnforcement.HDCP_NONE)
                .allowAvAdapter(true)
                .allowAirplay(true);
        SecurityPolicyPlayready playreadyForAll = new SecurityPolicyPlayready()
                .securityLevel(PlayreadySecurityLevel.LEVEL_150)
                .analogVideoProtection(AnalogVideoProtection.LEVEL_100)
                .digitalVideoProtection(DigitalVideoProtection.LEVEL_100)
                .digitalAudioProtection(DigitalAudioProtection.LEVEL_100);

        SecurityPolicyNcg ncgForAll = new SecurityPolicyNcg()
                .allowMobileAbnormalDevice(true)
                .allowExternalDisplay(true)
                .controlHdcp(NcgControlHdcp.HDCP_NONE);


        this.playbackPolicy
                .allowedTrackTypes(AllowedTrackTypes.SD_HD)
                .persistent(false);
        this.securityPolicyForAll
                .widevine(widevineForAll)
                .fairplay(fairplayForAll)
                .playready(playreadyForAll)
                .ncg(ncgForAll)
                .trackType(TrackType.ALL);
    }

    /**
     * 2. build policy
     * */
    private void buildPolicy() throws PallyConTokenException {
        this.policy = new PallyConDrmTokenPolicy
                .PolicyBuilder()
                .playbackPolicy(playbackPolicy)
                .securityPolicy(securityPolicyForAll)
                .build();
        logger.debug("policyJson: {}" , this.policy.toJsonString());
    }

    /**
     * 3. create token for Playready
     * */
    @Test
    public void makeBasicTokenForPlayready() {
        try {
            // build policy.
            buildPolicy();

            // use default settings included.
            // if want to replace fields, see #makeTokenForFairplay.
            this.tokenForPlayready = new PallyConDrmTokenClient().policy(policy);

            // generate token.
            this.licenseTokenForPlayready = this.tokenForPlayready.execute();
            logger.debug("tokenForPlayready JSON: {}", this.tokenForPlayready.toJsonString());

        } catch (PallyConTokenException e) {
            this.licenseTokenForPlayready = e.getMessage();
        } catch (Exception e) {
            this.licenseTokenForPlayready = "unexpected Exception || " + e.getMessage();
        }

        logger.debug("result_licenseTokenForPlayready: {}", this.licenseTokenForPlayready);
    }

    /**
     * 3. create token for Widevine.
     * */
    @Test
    public void makeTokenForWidevine() {
        try {
            // build policy.
            buildPolicy();

            // if want to replace more fields, see #makeTokenForFairplay.
            this.tokenForWidevine = new PallyConDrmTokenClient().widevine().policy(policy);

            // generate token.
            this.licenseTokenForWidevine = this.tokenForWidevine.execute();
            logger.debug("tokenForWidevine JSON : {}", this.tokenForWidevine.toJsonString());

        } catch (PallyConTokenException e) {
            licenseTokenForWidevine = e.getMessage();
        } catch (Exception e) {
            this.licenseTokenForWidevine = "unexpected Exception || " + e.getMessage();
        }
        logger.debug("result_licenseTokenForWidevine: {}", licenseTokenForWidevine);
    }

    /**
     * 3. create token for Fairplay
     * */
    @Test
    public void makeTokenForFairplay() {
        try {
            // build policy.
            buildPolicy();

            this.tokenForFairplay = new PallyConDrmTokenClient().fairplay().policy(policy);

            // generate token.
            this.licenseTokenForFairplay = this.tokenForFairplay.execute();
            logger.debug("tokenForFairplay JSON : {}", this.tokenForFairplay.toJsonString());
        } catch (PallyConTokenException e) {
            licenseTokenForFairplay = e.getMessage();
        } catch (Exception e) {
            this.licenseTokenForFairplay = "unexpected Exception || " + e.getMessage();
        }
        logger.debug("result_licenseTokenForFairPlay: {}", licenseTokenForFairplay);
    }




    /**
     * 3. create token for NCG
     * */
    @Test
    public void makeTokenForNCG() {
        try {
            // build policy.
            buildPolicy();

            this.tokenForNCG = new PallyConDrmTokenClient().ncg().policy(policy);

            // generate token.
            this.licenseTokenForNCG = this.tokenForNCG.execute();
            logger.debug("tokenForNCG JSON : {}", this.tokenForNCG.toJsonString());
        } catch (PallyConTokenException e) {
            licenseTokenForNCG = e.getMessage();
        } catch (Exception e) {
            this.licenseTokenForNCG = "unexpected Exception || " + e.getMessage();
        }
        logger.debug("result_licenseTokenForNCG: {}", licenseTokenForNCG);
    }
}
