<%
Class ExternalKeyNcg
    private m_cek

    Public Sub SetCek(s_cek)
        If CheckHex64(s_cek) = 1 Then
            m_cek = s_cek
        Else
            call Err.Raise(1047, "ExternalKeyNcg", "The Cek should be 16byte hex String")
        End If
    End Sub

    Public Function GetCek()
        GetCek = m_cek
    End Function

    Public Function ToJsonString()
        s_jsonResult = "{""cek"":""" & m_cek & """}"
        ToJsonString = s_jsonResult
    End Function

    Private Function CheckHex64(s_target)
        Set exReg = New RegExp

        exReg.Pattern = "^[0-9a-f]{64}$"
        exReg.Global = True
        exReg.IgnoreCase = True
        Set match = exReg.Execute(s_target)

        CheckHex32 = match.count
    End Function
    
End Class

%>