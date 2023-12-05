<%
Class SecurityPolicyWidevine
    private m_securityLevel
    private m_requiredHdcpVersion
    private m_requiredCgmsFlags
    private m_disableAnalogOutput
    private m_hdcpSrmRule
    private m_overrideDeviceRevocation
    private m_enableLicenseCipher

    Public Sub SetSecurityLevel(i_securityLevel)
        If Not IsEmpty(i_securityLevel) Then
            If VarType(i_securityLevel) = 2 OR VarType(i_securityLevel) = 3 then
                m_securityLevel = i_securityLevel
            Else
                call Err.Raise(1022, "SecurityPolicyWidevine", " The securityLevel should be integer")
            End If
        End If
    End Sub

    Public Function GetSecurityLevel()
        GetSecurityLevel = m_securityLevel
    End Function

    Public Sub SetRequireHdcpVersion(s_requireHdcpVersion)
        If Not IsEmpty(s_requireHdcpVersion) Then
            m_requiredHdcpVersion = s_requireHdcpVersion
        End If
    End Sub

    Public Function GetRequireHdcpVersion()
        GetRequireHdcpVersion = m_requiredHdcpVersion
    End Function

    Public Sub SetRequiredCgmsFlags(s_requiredCgmsFlags)
        If Not IsEmpty(s_requiredCgmsFlags) Then
            m_requiredCgmsFlags = s_requiredCgmsFlags
        End If
    End Sub

    Public Function GetRequiredCgmsFlags()
        GetRequiredCgmsFlags = m_requiredCgmsFlags
    End Function

    Public Sub SetDisableAnalogOutput(b_disableAnalogOutput)
        If Not IsEmpty(s_disableAnalogOutput) Then
            m_disableAnalogOutput = b_disableAnalogOutput
        End If
    End Sub

    Public Function GetDisableAnalogOutput()
        GetDisableAnalogOutput = m_disableAnalogOutput
    End Function

    Public Sub SetHdcpSrmRule(s_hdcpSrmRule)
        If Not IsEmpty(s_hdcpSrmRule) Then
            m_hdcpSrmRule = s_hdcpSrmRule
        End If
    End Sub

    Public Function GetHdcpSrmRule()
        GetHdcpSrmRule = m_hdcpSrmRule
    End Function

    Public Sub SetOverrideDeviceRevocation(b_overrideDeviceRevocation)
        If VarType(b_overrideDeviceRevocation) = 11 then
            m_overrideDeviceRevocation = b_overrideDeviceRevocation
        Else
            call Err.Raise(1023, "SecurityPolicyWidevine", "The override_device_revocation should be boolean")
        End If
    End Sub

    Public Function GetOverrideDeviceRevocation()
        If IsEmpty(m_overrideDeviceRevocation) then
            GetOverrideDeviceRevocation = false
        Else
            GetOverrideDeviceRevocation = m_overrideDeviceRevocation
        End If
    End Function

    Public Sub SetEnableLicenseCipher(b_enableLicenseCipher)
        If VarType(b_enableLicenseCipher) = 11 then
            m_enableLicenseCipher = b_enableLicenseCipher
        Else
            call Err.Raise(1024, "SecurityPolicyWidevine", "The enable_license_cipher should be boolean")
        End If
    End Sub

    Public Function GetEnableLicenseCipher()
        If IsEmpty(m_enableLicenseCipher) then
            GetEnableLicenseCipher = false
        Else
            GetEnableLicenseCipher = m_enableLicenseCipher
        End If
    End Function

    Public Function ToJsonString()
        s_jsonResult = "{"
        If Not IsEmpty(m_securityLevel) Then
            s_jsonResult = s_jsonResult & """security_level"":" & m_securityLevel
        End If

        If Not IsEmpty(m_requiredHdcpVersion) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If

            s_jsonResult = s_jsonResult & """required_hdcp_version"":""" & m_requiredHdcpVersion & """"
        End If

        If Not IsEmpty(m_requiredCgmsFlags) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If

            s_jsonResult = s_jsonResult & """required_cgms_flags"":""" & m_requiredCgmsFlags & """"
        End If

        If Not IsEmpty(m_disableAnalogOutput) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If

            s_jsonResult = s_jsonResult & """disable_analog_output"":" & Lcase(Cstr(m_disableAnalogOutput))
        End If

        If Not IsEmpty(m_hdcpSrmRule) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If

            s_jsonResult = s_jsonResult & """hdcp_srm_rule"":""" & m_hdcpSrmRule & """"
        End If

        If Not IsEmpty(m_overrideDeviceRevocation) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If

            s_jsonResult = s_jsonResult & """override_device_revocation"":" & Lcase(Cstr(m_overrideDeviceRevocation))
        End If

        If Not IsEmpty(m_enableLicenseCipher) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If

            s_jsonResult = s_jsonResult & """enable_license_cipher"":" & Lcase(Cstr(m_enableLicenseCipher))
        End If

        s_jsonResult = s_jsonResult & "}"
        ToJsonString = s_jsonResult
    End Function

End Class

%>
