<%
Class SecurityPolicy
    private m_trackType
    private m_widevine
    private m_playready
    private m_fairplay
    private m_ncg

    Public Sub SetTrackType(s_trackType)
        m_trackType = s_trackType

    End Sub

    Public Function GetTrackType()
        GetTrackType = m_trackType
    End Function

    Public Sub SetWidevine(o_widevine)
        Set m_widevine = o_widevine
    End Sub

    Public Function GetWidevine()
        Set GetWidevine = m_widevine
    End Function

    Public Sub SetPlayready(o_playready)
        Set m_playready = o_playready
    End Sub

    Public Function GetPlayready()
        Set GetPlayready = m_playready
    End Function

    Public Sub SetFairplay(o_fairplay)
        Set m_fairplay = o_fairplay
    End Sub

    Public Function GetFairplay()
        Set GetFairplay = m_fairplay
    End Function

    Public Sub SetNcg(o_ncg)
        Set m_ncg = o_ncg
    End Sub

    Public Function GetNcg()
        Set GetNcg = m_ncg
    End Function


    Public Function ToJsonString()
        If Not IsEmpty(m_trackType) Then
            s_jsonResult = "{""track_type"":""" & m_trackType & """"
        Else
            s_jsonResult = "{""track_type"": ""ALL"""
        End If

        If Not IsEmpty(m_widevine) Then
            s_jsonResult = s_jsonResult & ", ""widevine"":" & m_widevine.ToJsonString
        End If
        If Not IsEmpty(m_playready) Then
            s_jsonResult = s_jsonResult & ", ""playready"":" & m_playready.ToJsonString
        End If
        If Not IsEmpty(m_fairplay) Then
            s_jsonResult = s_jsonResult & ", ""fairplay"":" & m_fairplay.ToJsonString
        End If
        If Not IsEmpty(m_fairplay) Then
            s_jsonResult = s_jsonResult & ", ""ncg"":" & m_ncg.ToJsonString
        End If

        s_jsonResult = s_jsonResult & "}"
        ToJsonString = s_jsonResult
    End Function
    
End Class

%>