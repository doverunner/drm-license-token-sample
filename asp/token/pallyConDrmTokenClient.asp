<!--
#include File="../util/CryptSHA256.asp" --><!--
#include File="../util/Base64.asp" --><%
Const IV = "0123456789abcdef"

Class pallyConDrmTokenClient
    private encrypter
    private m_timestamp
    private m_drmType
    private m_siteId
    private m_userId
    private m_cid
    private m_keyRotation
    private m_accessKey
    private m_siteKey
    private m_policy
    private m_encPolicy
    private m_responseFormat
    private m_hash

    private Sub Class_Initialize()

        //TODO Required : Set the library corresponding to the cpu register size.
        '64bit
		Set encrypter = Server.CreateObject ("Ryeol.StringEncrypter")
        '32bit
		'Set encrypter = Server.CreateObject ("Hyeongryeol.StringEncrypter")

		encrypter.InitialVector = IV

        Dim current, currentDate, currentTime
        current=DateAdd("H", (TIME_ZONE*-1), Now())
        currentDate=FormatDateTime(current, 2)
        currentTime=FormatDateTime(current, 4)
        currentSecond=Right(current, 3)
        m_timestamp= currentDate & "T" & currentTime & currentSecond & "Z"
        call Widevine
        ' response.write m_timestamp
    end Sub

    Public Sub Playready()
        m_drmType = "PlayReady"
    end Sub

    Public Sub Widevine()
        m_drmType = "Widevine"
    end Sub

    Public Sub Fairplay()
        m_drmType = "FairPlay"
    end Sub

    Public Sub Ncg()
        m_drmType = "NCG"
    end Sub

    Public Sub SiteId(s_siteId)
        m_siteId = s_siteId
    end Sub

    Public Sub UserId(s_userId)
        m_userId = s_userId
    end Sub

    Public Sub Cid(s_cid)
        m_cid = s_cid
    end Sub

    Public Sub KeyRotation(s_keyRotation)
            m_keyRotation = s_keyRotation
        end Sub

    Public Sub AccessKey(s_accessKey)
        m_accessKey = s_accessKey
    end Sub
    Public Sub SiteKey(s_siteKey)
        m_siteKey = s_siteKey
        encrypter.Key = m_siteKey
    end Sub

    Public Sub Policy(o_policyRequest)
        If("PolicyRequest" = TypeName(o_policyRequest)) Then
            Set m_policy = o_policyRequest
        Else
            //TODO
            call Err.Raise(1000, "test", "test Message")
        End If
    end Sub

    Public Sub ResponseFormat(s_responseFormat)
        m_responseFormat = s_responseFormat
    end Sub

    Public Function Execute()
        Dim tt
        Call CheckValidation
        m_encPolicy = CreatePolicy
        m_hash = CreateHash

        Execute = Base64encode(ToJsonString)
    End Function

    Public Function ToJsonString
        s_jsonResult = "{""drm_type"":""" & m_drmType & ""","
        s_jsonResult = s_jsonResult & """site_id"":""" & m_siteId & ""","
        s_jsonResult = s_jsonResult & """user_id"":""" & m_userId & ""","
        s_jsonResult = s_jsonResult & """cid"":""" & m_cid & ""","
        s_jsonResult = s_jsonResult & """policy"":""" & m_encPolicy & ""","
        s_jsonResult = s_jsonResult & """timestamp"":""" & m_timestamp & ""","
        If Not IsEmpty(m_responseFormat) Then
        s_jsonResult = s_jsonResult & """response_format"":""" & m_responseFormat & ""","
        End If
        If Not IsEmpty(m_keyRotation) Then
            s_jsonResult = s_jsonResult & """key_rotation"":" & Lcase(Cstr(m_keyRotation)) & ","
        End If
        s_jsonResult = s_jsonResult & """hash"":""" & m_hash & """}"

        ToJsonString = s_jsonResult
    End Function
    private Sub CheckValidation()
        If IsEmpty(m_userId) Then
            call Err.Raise(1000, "Token err", "The userId is Required")
        End If
        If IsEmpty(m_cid) Then
            call Err.Raise(1001, "Token err", "The cid is Required")
        End If
        If IsEmpty(m_siteId) Then
            call Err.Raise(1002, "Token err", "The siteId is Required")
        End If
        If IsEmpty(m_accessKey) Then
            call Err.Raise(1003, "Token err", "The accessKey is Required")
        End If
        If IsEmpty(m_siteKey) Then
            call Err.Raise(1004, "Token err", "The siteKey is Required")
        End If
        If IsEmpty(m_policy) Then
            call Err.Raise(1005, "Token err", "The policy is Required")
        End If
    End Sub

    private Function CreatePolicy
        s_policy = m_policy.ToJsonString
        CreatePolicy = encrypter.Encrypt(s_policy)
    End Function

    private Function CreateHash
        Dim hexData, body
        Set Sha = New CryptSHA256

        body = m_accessKey & m_drmType & m_siteId & m_userId & m_cid & m_encPolicy & m_timestamp

        hexData = Sha.SHA256(body)

        CreateHash = BinaryToText(TextToBinary(hexData, "bin.hex"), "bin.base64")
    End Function

    Public Function GetDrmType()
        GetDrmType = m_drmType
    end Function

    Public Function GetSiteId()
        GetSiteId = m_siteId
    end Function

    Public Function GetUserId()
        GetUserId = m_userId
    end Function

    Public Function GetCid()
        GetCid = m_cid
    end Function

    Public Function GetAccessKey()
        GetAccessKey = m_accessKey
    end Function

    Public Function GetSiteKey()
        GetSiteKey = m_siteKey
    end Function

    Public Function GetResponseFormat()
        GetResponseFormat = m_responseFormat
    end Function

    Public Function GetPolicy()
        Set GetPolicy = m_policy
    end Function

    Function TextToBinary(text, dataType)
        Dim dom
        Set dom = CreateObject("Microsoft.XMLDOM")
        dom.loadXML("<PALLYCON/>")
        dom.documentElement.nodeTypedValue = text
        dom.documentElement.dataType = dataType
        TextToBinary = dom.documentElement.nodeTypedValue
    End Function

    Function BinaryToText(binary, dataType)
        Dim dom
        Set dom = CreateObject("Microsoft.XMLDOM")
        dom.loadXML("<PALLYCON/>")
        dom.documentElement.dataType = dataType
        dom.documentElement.nodeTypedValue = binary
        dom.documentElement.removeAttribute("dt:dt")
        BinaryToText = dom.documentElement.nodeTypedValue
    End Function




End Class
%>
