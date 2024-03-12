<%
Class SecurityPolicyNcg
    private m_allowMobileAbnormalDevice
    private m_allowExternalDisplay
    private m_controlHdcp

    Public Sub SetAllowMobileAbnormalDevice(b_allowMobileAbnormalDevice)
        If Not IsEmpty(b_allowMobileAbnormalDevice) Then
            If VarType(b_allowMobileAbnormalDevice) = 11 then
                m_allowMobileAbnormalDevice = b_allowMobileAbnormalDevice
            Else
                call Err.Raise(1036, "SecurityPolicyNcg", " The allowMobileAbnormalDevice should be integer")
            End If
        End If
    End Sub

    Public Function GetAllowMobileAbnormalDevice()
        GetAllowMobileAbnormalDevice = m_allowMobileAbnormalDevice
    End Function

    Public Sub SetAllowExternalDisplay(b_allowExternalDisplay)
        If Not IsEmpty(b_allowExternalDisplay) Then
            If VarType(b_allowExternalDisplay) = 11  then
                m_allowExternalDisplay = b_allowExternalDisplay
            Else
                call Err.Raise(1037, "SecurityPolicyNcg", " The allowExternalDisplay should be boolean")
            End If
        End If
    End Sub
    Public Function GetAllowExternalDisplay()
        GetAllowExternalDisplay = m_allowExternalDisplay
    End Function

    Public Sub SetControlHdcp(i_controlHdcp)
        If Not IsEmpty(i_controlHdcp) Then
            If VarType(i_controlHdcp) = 2 OR VarType(i_controlHdcp) = 3 then
                m_controlHdcp = i_controlHdcp
            Else
                call Err.Raise(1038, "SecurityPolicyNcg", " The controlHdcp should be integer")
            End If
        End If
    End Sub
    Public Function GetControlHdcp()
        GetControlHdcp = m_controlHdcp
    End Function

    Public Function ToJsonString()
        s_jsonResult = "{"
        If Not IsEmpty(m_allowMobileAbnormalDevice) Then
            s_jsonResult = s_jsonResult & """allow_mobile_abnormal_device"":" & Lcase(Cstr(m_allowMobileAbnormalDevice))
        End If

        If Not IsEmpty(m_allowExternalDisplay) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """allow_external_display"":" & Lcase(Cstr(m_allowExternalDisplay))
        End If

        If Not IsEmpty(m_controlHdcp) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """control_hdcp"":" & m_controlHdcp
        End If

        s_jsonResult = s_jsonResult & "}"
        ToJsonString = s_jsonResult
    End Function
    
End Class

%>