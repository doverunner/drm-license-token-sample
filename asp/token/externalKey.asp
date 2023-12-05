<%
Class ExternalKey
    private m_mpegCenc
    private m_hlsAes
    private m_ncg

    Private Sub Class_Initialize()
        set m_mpegCenc = Server.CreateObject("Scripting.Dictionary")
        set m_hlsAes = Server.CreateObject("Scripting.Dictionary")
    End Sub


    Public Sub SetMpegCenc(o_mpegCencDic)
        Set m_mpegCenc = o_mpegCencDic
    End Sub

    Public Sub AddMpegCenc(o_mpegCenc)
        m_mpegCenc.add Cstr(m_mpegCenc.Count), o_mpegCenc
    End Sub

    Public Function GetMpegCenc()
        Set GetMpegCenc = m_mpegCenc
    End Function

    Public Sub SetHlsAes(o_hlsAesDic)
        Set m_hlsAes = o_hlsAesDic
    End Sub

    Public Sub AddHlsAes(o_hlsAes)
        m_hlsAes.add Cstr(m_hlsAes.Count), o_hlsAes
    End Sub

    Public Function GetHlsAes()
        Set GetHlsAes = m_hlsAes
    End Function


    Public Sub SetNcg(o_ncg)
        Set m_ncg = o_ncg
    End Sub

    Public Function GetNcg()
        Set GetNcg = m_ncg
    End Function

    Public Function ToJsonString()
        s_jsonResult = "{"
        If Not IsEmpty(m_mpegCenc) Then
            i_mpegCencSize = m_mpegCenc.Count
            arr_mpegCencItems = m_mpegCenc.Items
            s_jsonResult = s_jsonResult & """mpeg_cenc"":["
            For i=0 To i_mpegCencSize-1
                If i <> 0 Then
                    s_jsonResult = s_jsonResult & ","
                End If
                 s_jsonResult = s_jsonResult & arr_mpegCencItems(i).ToJsonString
            Next
            s_jsonResult = s_jsonResult &  "]"
        End If

        If Not IsEmpty(m_hlsAes) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If
            i_hlsAesSize = m_hlsAes.Count
            arr_hlsAesItems = m_hlsAes.Items

            s_jsonResult = s_jsonResult & """hls_aes"":["
            For i=0 To i_hlsAesSize-1
                If i <> 0 Then
                    s_jsonResult = s_jsonResult & ","
                End If
                 s_jsonResult = s_jsonResult & arr_hlsAesItems(i).ToJsonString 
            Next
            s_jsonResult = s_jsonResult &  "]"
        End If

        If Not IsEmpty(m_ncg) Then
            If s_jsonResult <> "{" Then
                s_jsonResult = s_jsonResult & ","
            End If
            s_jsonResult = s_jsonResult & """ncg"":" & m_ncg.ToJsonString
        End If
        s_jsonResult = s_jsonResult & "}"
        ToJsonString = s_jsonResult
    End Function
End Class

%>