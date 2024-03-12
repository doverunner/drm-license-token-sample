<%
Class ExternalKeyHlsAes
    private m_trackType
    private m_key
    private m_iv
    private m_keyId

    Public Sub SetKey(s_key)
        If CheckHex32(s_key) = 1 Then
            m_key = s_key
        Else
            call Err.Raise(1044, "ExternalKeyHlsAes", "The Key should be 16byte hex String")
        End If
    End Sub
    Public Function GetKey()
        GetKey = m_key
    End Function

    Public Sub SetIv(s_iv)
        If CheckHex32(s_iv) = 1 Then
            m_iv = s_iv
        Else
            call Err.Raise(1045, "ExternalKeyHlsAes", "The Iv should be 16byte hex String")
        End If
    End Sub

    Public Function GetIv()
        GetIv = m_iv
    End Function

    Public Sub SetTrackType(s_trackType)
        m_trackType = s_trackType
    End Sub

    Public Function GetTrackType()
        GetTrackType = m_trackType
    End Function

    Public Sub SetKeyId(s_keyId)
        If CheckHex32(s_keyId) = 1 Then
            m_keyId = s_keyId
        Else
            call Err.Raise(1046, "ExternalKeyHlsAes", "The KeyId should be 16byte hex String")
        End If
    End Sub

    Public Function GetKeyId()
        GetIv = m_keyId
    End Function

    Public Function ToJsonString()
        s_jsonResult = "{"
        If Not IsEmpty(m_trackType) Then
            s_jsonResult = s_jsonResult & """track_type"":""" & m_trackType & ""","
        Else
            s_jsonResult = s_jsonResult & """track_type"":""ALL"","
        End If
        s_jsonResult = s_jsonResult & """key"":""" & m_key & ""","
        s_jsonResult = s_jsonResult & """key_id"":""" & m_keyId & ""","
        s_jsonResult = s_jsonResult & """iv"":""" & m_iv & """}"
        ToJsonString = s_jsonResult
    End Function

    Private Function CheckHex32(s_target)
        Set exReg = New RegExp

        exReg.Pattern = "^[0-9a-f]{32}$"
        exReg.Global = True
        exReg.IgnoreCase = True
        Set match = exReg.Execute(s_target)

        CheckHex32 = match.count
    End Function
    
    
End Class

%>