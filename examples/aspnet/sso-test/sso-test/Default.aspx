<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="sso_test.WebForm1" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <h1> Test JOSSO</h1>
  
    Username: <%= Request.ServerVariables.Get("HTTP_JOSSO_USER") %>
    <%
        for (int i =0 ; i <  Request.ServerVariables.Count ; i++)
        {

            if (Request.ServerVariables.GetKey(i).IndexOf("HTTP_JOSSO_USER_PROPERTY_")>-1)
            {
                
                %>

     <%=Request.ServerVariables.GetKey(i) %>: <%=Request.ServerVariables.Get(i) %><br/>

    <%
            }
                
 
        }
     %>
</body>
</html>
