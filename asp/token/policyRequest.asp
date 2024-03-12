<%
Class PolicyRequest
    private m_policyVersion
    private m_playbackPolicy
    private m_securityPolicy
    private m_externalKey

    Private Sub Class_Initialize()
        set m_securityPolicy = Server.CreateObject("Scripting.Dictionary")
        m_policyVersion = 2
    End Sub

    Public Sub SetPolicyVersion(i_policyVersion)
        m_policyVersion = i_policyVersion
    End Sub
    Public Function GetPolicyVersion()
        GetPolicyVersion = m_policyVersion
    End Function

    Public Sub SetPlaybackPolicy(o_playbackPolicy)
        Set m_playbackPolicy = o_playbackPolicy
    End Sub
    Public Function GetPlaybackPolicy()
        Set GetPlaybackPolicy = m_playbackPolicy
    End Function

    Public Sub SetSecurityPolicy(o_securityPolicy)
        Set m_securityPolicy = o_securityPolicy
    End Sub
    Public Function GetSecuritykPolicy()
        Set GetSecuritykPolicy = m_securityPolicy
    End Function
    Public Sub AddSecurityPolicy(o_securityPolicy)
        m_securityPolicy.add Cstr(m_securityPolicy.Count), o_securityPolicy
    End Sub

    Public Sub SetExternalKey(o_externalKey)
        Set m_externalKey = o_externalKey
    End Sub

    Public Function GetExternalKey()
        Set GetExternalKey = m_externalKey
    End Function

    Public Function ToJsonString()
        s_jsonResult = "{""policy_version"":"
            s_jsonResult = s_jsonResult & m_policyVersion
        If Not IsEmpty(m_playbackPolicy) Then
            s_jsonResult = s_jsonResult & ",""playback_policy"":" & m_playbackPolicy.ToJsonString
        End If
        If Not IsEmpty(m_securityPolicy) Then
            i_securitySize = m_securityPolicy.Count
            s_jsonResult = s_jsonResult & ",""security_policy"":["


            For i=0 To i_securitySize-1
                If i <> 0 Then
                    s_jsonResult = s_jsonResult & ","
                End If
                 s_jsonResult = s_jsonResult & m_securityPolicy(cstr(i)).ToJsonString
            Next
            s_jsonResult = s_jsonResult &  "]"
        End If

        If Not IsEmpty(m_externalKey) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """external_key"":" & m_externalKey.ToJsonString
        End If
        s_jsonResult = s_jsonResult & "}"

        ToJsonString = s_jsonResult
    End Function
End Class

%>