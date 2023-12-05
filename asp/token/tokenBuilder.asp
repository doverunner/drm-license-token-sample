<%
Class TokenBuilder
    private m_playbackPolicy
    private m_securityPolicy
    private m_externalKey

    Private Sub Class_Initialize()
        set m_securityPolicy = Server.CreateObject("Scripting.Dictionary")
    End Sub

    Public Sub PlaybackPolicy(o_playbackPolicy)
        Set m_playbackPolicy = o_playbackPolicy
    End Sub

    Public Function GetPlaybackPolicy()
        Set GetPlaybackPolicy = m_playbackPolicy
    End Function

    Public Sub SecurityPolicy(o_securityPolicy)
    Set m_securityPolicy = o_securityPolicy
    End Sub

    Public Sub AddSecurityPolicy(o_securityPolicy)
        m_securityPolicy.add Cstr(m_securityPolicy.Count), o_securityPolicy
    End Sub

    Public Function GetSecuritykPolicy()
        Set GetSecuritykPolicy = m_securityPolicy
    End Function

    Public Sub ExternalKey(o_externalKey)
        Set m_externalKey = o_externalKey
    End Sub

    Public Function GetExternalKey()
        Set GetExternalKey = m_externalKey
    End Function
    
    Public Function Build()
        Dim policyRequest
        Set policyRequest = new PolicyRequest
        
        If Not IsEmpty(m_playbackPolicy) Then
            Call policyRequest.SetPlaybackPolicy(m_playbackPolicy)
        End If
    
        If Not IsEmpty(m_securityPolicy) Then
            Call policyRequest.SetSecurityPolicy(m_securityPolicy)
        End If
    
        If Not IsEmpty(m_externalKey) Then
            Call policyRequest.SetExternalKey(m_externalKey)
        End If
        
        Set Build = policyRequest
    End Function 
End Class
%>