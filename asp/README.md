# PallyCon ASP Token Sample

## Configuration

1. Edit Config.asp file to set the Site ID, Site Key, and Access Key values of your PallyCon account. (can be found in PallyCon Console site)

2. Register AES encryptor DLL(RyeolStringEncrypter.dll) by your Windows version(32 or 64bit).
  - Copy the appropriate dll file from 'aes_module' folder to your Windows' System32 folder.
  - Run 'Regsvr32 RyeolStringEncrypter.dll' in command prompt with administrator rights.

3. Set the library corresponding to the server cpu register size used in the pallyConDrmTokenClient class constructor.
```asp
//TODO Required : Set the library corresponding to the cpu register size.
'64bit
Set encrypter = Server.CreateObject ("Ryeol.StringEncrypter")
'32bit
'Set encrypter = Server.CreateObject ("Hyeongryeol.StringEncrypter")
```
 
## Quick Example
```asp
<!--
#Include File= "token/pallyConDrmTokenClient.asp" --><!--
#Include File= "token/policyRequest.asp" --><!--
#Include File= "token/playbackPolicyRequest.asp" --><!--
#Include File= "token/tokenBuilder.asp" --><!--
#Include File= "config.asp" --><%
Dim obj_drmTokenClient, obj_policyRequest
Dim result
on error resume next

` Create token client
Set obj_drmTokenClient = new PallyConDrmTokenClient

' Create token rule builder
Set obj_tokenBuilder = new TokenBuilder

' Create playback policy rule
' https://pallycon.com/docs/en/multidrm/license/license-token/#playback-policy 
Set obj_playbackPolicyRequest = new PlaybackPolicyRequest
obj_playbackPolicyRequest.setLimit False
obj_playbackPolicyRequest.setDuration False

` Build rule
` https://pallycon.com/docs/en/multidrm/license/license-token/#token-rule-json
obj_tokenBuilder.PlaybackPolicy(obj_playbackPolicyRequest)
Set obj_policyRequest = obj_tokenBuilder.Build

If Err.Number <> 0 Then
    Response.write "{""error_code"": """ & Err.Number &_
         """, ""error_message"": """ & Err.Source & " : " & Err.Description &"""}"
    Response.End
End If

' Create Token
` siteId, accessKey, siteKey, userId, cid, policy is Required.
` https://pallycon.com/docs/en/multidrm/license/license-token/#token-json-example
obj_drmTokenClient.Widevine
obj_drmTokenClient.SiteId(SITE_ID)
obj_drmTokenClient.AccessKey(SITE_KEY)
obj_drmTokenClient.SiteKey(ACCESS_KEY)
obj_drmTokenClient.UserId("testUser")
obj_drmTokenClient.Cid("test-cid")
obj_drmTokenClient.Policy(obj_policyRequest)

result = obj_drmTokenClient.Execute()

If Err.Number = 0 Then
    Response.Write result
Else
    Response.Write "{""error_code"": """ & Err.Number &_
     """, ""error_message"": """ & Err.Source & " : " & Err.Description &"""}"
End If
%>

```
