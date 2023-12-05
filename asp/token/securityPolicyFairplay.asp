<%
Class SecurityPolicyFairplay
    private m_hdcpEnforcement
    private m_allowAirplay
    private m_allowAvAdapter

    Public Sub SetHdcpEnforcement(i_hdcpEnforcement)
        If Not IsEmpty(i_hdcpEnforcement) Then
            If VarType(i_hdcpEnforcement) = 2 OR VarType(i_hdcpEnforcement) = 3 then
                m_hdcpEnforcement = i_hdcpEnforcement
            Else
                call Err.Raise(1033, "SecurityPolicyFairplay", " The hdcpEnforcement should be integer")
            End If
        End If
    End Sub
    Public Function GetHdcpEnforcement()
        GetHdcpEnforcement = m_hdcpEnforcement
    End Function

    Public Sub SetAllowAirplay(b_allowAirplay)
        If Not IsEmpty(b_allowAirplay) Then
            If VarType(b_allowAirplay) = 11  then
                m_allowAirplay = b_allowAirplay
            Else
                call Err.Raise(1034, "SecurityPolicyFairplay", " The allowAirplay should be boolean")
            End If
        End If
    End Sub
    Public Function GetAllowAirplay()
        GetAllowAirplay = m_allowAirplay
    End Function

    Public Sub SetAllowAvAdapter(b_allowAvAdapter)
        If Not IsEmpty(b_allowAvAdapter) Then
            If VarType(b_allowAvAdapter) = 11  then
                m_allowAvAdapter = b_allowAvAdapter
            Else
                call Err.Raise(1035, "SecurityPolicyFairplay", " The allowAvAdapter should be boolean")
            End If
        End If
    End Sub
    Public Function GetAllowAvAdapter()
        GetAllowAvAdapter = m_allowAvAdapter
    End Function

    Public Function ToJsonString()
        s_jsonResult = "{"
        If Not IsEmpty(m_hdcpEnforcement) Then
            s_jsonResult = s_jsonResult & """hdcp_enforcement"":" & m_hdcpEnforcement
        End If

        If Not IsEmpty(m_allowAirplay) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """allow_airplay"":" & Lcase(Cstr(m_allowAirplay))
        End If

        If Not IsEmpty(m_allowAvAdapter) Then
            If s_jsonResult <> "{" Then
            s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """allow_av_adapter"":" & Lcase(Cstr(m_allowAvAdapter))
        End If

        s_jsonResult = s_jsonResult & "}"
        ToJsonString = s_jsonResult
    End Function
    
End Class

%>