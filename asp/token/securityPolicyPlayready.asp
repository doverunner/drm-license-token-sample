<%
Class SecurityPolicyPlayready
    private m_securityLevel
    private m_digitalVideoProtectionLevel
    private m_analogVideoProtectionLevel
    private m_digitalAudioProtectionLevel
    private m_requireHdcpType1

    Public Sub SetSecurityLevel(i_securityLevel)
        If Not IsEmpty(i_securityLevel) Then
            If VarType(i_securityLevel) = 2 OR VarType(i_securityLevel) = 3 then
                m_securityLevel = i_securityLevel
            Else
                call Err.Raise(1027, "SecurityPolicyPlayready", " The securityLevel should be integer")
            End If
        End If
    End Sub

    Public Function GetSecurityLevel()
        GetSecurityLevel = m_securityLevel
    End Function

    Public Sub SetDigitalVideoProtectionLevel(i_digitalVideoProtectionLevel)
        If Not IsEmpty(i_digitalVideoProtectionLevel) Then
            If VarType(i_digitalVideoProtectionLevel) = 2 OR VarType(i_digitalVideoProtectionLevel) = 3 then
                m_digitalVideoProtectionLevel = i_digitalVideoProtectionLevel
            Else
                call Err.Raise(1028, "SecurityPolicyPlayready", " The digitalVideoProtectionLevel should be integer")
            End If
        End If
    End Sub

    Public Function GetDigitalVideoProtectionLevel()
        GetDigitalVideoProtectionLevel = m_digitalVideoProtectionLevel
    End Function

    Public Sub SetAnalogVideoProtectionLevel(i_analogVideoProtectionLevel)
        If Not IsEmpty(i_analogVideoProtectionLevel) Then
            If VarType(i_analogVideoProtectionLevel) = 2 OR VarType(i_analogVideoProtectionLevel) = 3 then
                m_analogVideoProtectionLevel = i_analogVideoProtectionLevel
            Else
                call Err.Raise(1029, "SecurityPolicyPlayready", " The analogVideoProtectionLevel should be integer")
            End If
        End If
    End Sub

    Public Function GetAnalogVideoProtectionLevel()
        GetAnalogVideoProtectionLevel = m_analogVideoProtectionLevel
    End Function

    Public Sub SetDigitalAudioProtectionLevel(i_digitalAudioProtectionLevel)
        If Not IsEmpty(i_digitalAudioProtectionLevel) Then
            If VarType(i_digitalAudioProtectionLevel) = 2 OR VarType(i_digitalAudioProtectionLevel) = 3 then
                m_digitalAudioProtectionLevel = i_digitalAudioProtectionLevel
            Else
                call Err.Raise(1030, "SecurityPolicyPlayready", " The digitalAudioProtectionLevel should be integer")
            End If
        End If
    End Sub

    Public Function GetDigitalAudioProtectionLevel()
        GetDigitalAudioProtectionLevel = m_digitalAudioProtectionLevel
    End Function

    Public Sub SetRequireHdcpType1(i_requireHdcpType1)
        If Not IsEmpty(i_requireHdcpType1) Then
            If VarType(i_requireHdcpType1) = 2 OR VarType(i_requireHdcpType1) = 3 then
                m_requireHdcpType1 = i_requireHdcpType1
            Else
                call Err.Raise(1032, "SecurityPolicyPlayready", " The requireHdcpType1 should be integer")
            End If
        End If
    End Sub

    Public Function GetRequireHdcpType1()
        GetRequireHdcpType1 = m_requireHdcpType1
    End Function


    Public Function ToJsonString()
        s_jsonResult = "{"
        If Not IsEmpty(m_securityLevel) Then
            s_jsonResult = s_jsonResult & """security_level"":" & m_securityLevel
        End If

        If Not IsEmpty(m_digitalVideoProtectionLevel) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """digital_video_protection_level"":" & m_digitalVideoProtectionLevel
        End If

        If Not IsEmpty(m_analogVideoProtectionLevel) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """analog_video_protection_level"":" & m_analogVideoProtectionLevel
        End If

        If Not IsEmpty(m_digitalAudioProtectionLevel) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """digital_audio_protection_level"":" & m_digitalAudioProtectionLevel
        End If

        If Not IsEmpty(m_requireHdcpType1) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """require_hdcp_type1"":" & Lcase(Cstr(m_requireHdcpType1))
        End If

        s_jsonResult = s_jsonResult & "}"
        ToJsonString = s_jsonResult
    End Function
    
End Class

%>