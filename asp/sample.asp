<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"
%><%Response.ChaRset ="utf-8"
 Session.codepage="65001"
Response.codepage="65001"
Response.ContentType="text/html;charset=utf-8"
%><!--
#Include File= "token/pallyConDrmTokenClient.asp" --><!--
#Include File= "token/policyRequest.asp" --><!--
#Include File= "token/playbackPolicy.asp" --><!--
#Include File= "token/securityPolicy.asp" --><!--
#Include File= "token/securityPolicyWidevine.asp" --><!--
#Include File= "token/externalKey.asp" --><!--
#Include File= "token/externalKeympegCenc.asp" --><!--
#Include File= "token/externalKeyHlsAes.asp" --><!--
#Include File= "token/tokenBuilder.asp" --><!--
#Include File= "config.asp" --><%
Dim obj_drmTokenClient, obj_policyRequest
Dim result

on error resume next
Set obj_drmTokenClient = new PallyConDrmTokenClient
Set obj_tokenBuilder = new TokenBuilder

' /* Sample Rule */

//Create Playback Policy Sample
Set obj_playbackPolicy = new PlaybackPolicy
obj_playbackPolicy.setPersistent true
obj_playbackPolicy.setLicenseDuration 150
obj_playbackPolicy.setAllowedTrackTypes "SD_HD"
' obj_playbackPolicy.SetMaxStreamPerUser 5

//Create Security Policy Sample
set d_securityPolicy = Server.CreateObject("Scripting.Dictionary")

Set obj_securityPolicy = new SecurityPolicy

Set obj_securityPolicyWidevine = new SecurityPolicyWidevine
obj_securityPolicyWidevine.SetRequireHdcpVersion "HDCP_V1"
' obj_securityPolicyWidevine.SetEnableLicenseCipher true

obj_securityPolicy.setTrackType "HD"
obj_securityPolicy.setWidevine obj_securityPolicyWidevine

d_securityPolicy.add Cstr(d_securityPolicy.Count), obj_securityPolicy

' Set obj_externalKey = new ExternalKey

' Set obj_externalKeyMpegCenc = new ExternalKeyMpegCenc
' obj_externalKeyMpegCenc.SetKeyId "12345616123456FF3456123456123456"
' obj_externalKeyMpegCenc.SetKey "12345616123456dd3456123456123456"

' Set obj_externalKeyMpegCenc2 = new ExternalKeyMpegCenc
' obj_externalKeyMpegCenc2.SetKeyId "aa345616123456FF3456123456123456"
' obj_externalKeyMpegCenc2.SetKey "bb345616123456dd3456123456123456"

' Set obj_externalKeyHlsAes = new ExternalKeyHlsAes
' obj_externalKeyHlsAes.SetKeyId "12345616123456FF3456123456123456"
' obj_externalKeyHlsAes.SetKey "12345616123456dd3456123456123456"

' obj_externalKey.AddMpegCenc obj_externalKeyMpegCenc
' obj_externalKey.AddMpegCenc obj_externalKeyMpegCenc2
' obj_externalKey.AddHlsAes obj_externalKeyHlsAes


obj_tokenBuilder.PlaybackPolicy(obj_playbackPolicy)
obj_tokenBuilder.SecurityPolicy(d_securityPolicy)
' obj_tokenBuilder.ExternalKey(obj_externalKey)

' /* create token rule build */
Set obj_policyRequest = obj_tokenBuilder.Build

If Err.Number <> 0 Then
    ' Response.Write "build err"
    Response.write "{""error_code"": """ & Err.Number &_
         """, ""error_message"": """ & Err.Source & " : " & Err.Description &"""}"
    Response.End
End If

' /* create token */
obj_drmTokenClient.Widevine
obj_drmTokenClient.SiteId(SITE_ID)
obj_drmTokenClient.AccessKey(ACCESS_KEY)
obj_drmTokenClient.SiteKey(SITE_KEY)
obj_drmTokenClient.UserId("testUser")
obj_drmTokenClient.Cid("test-cid")
obj_drmTokenClient.Policy(obj_policyRequest)

result = obj_drmTokenClient.Execute()

If Err.Number = 0 Then
    Response.Write result & "<br/>"
    ' Response.Write "<br/>"
    ' Response.Write obj_drmTokenClient.ToJsonString
    ' Response.Write "<br/>"
    ' Response.Write obj_drmTokenClient.GetPolicy.ToJsonString
Else
    ' Response.Write "Execute Err"
    Response.Write "{""error_code"": """ & Err.Number &_
     """, ""error_message"": """ & Err.Source & " : " & Err.Description &"""}" & "<br/>"
End If
%>