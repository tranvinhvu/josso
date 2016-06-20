<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="index.aspx.cs" Inherits="sso_test.protect.WebForm1" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <h1> Protected Page</h1>
  <p>
    Username: <%= Request.ServerVariables.Get("HTTP_JOSSO_USER") %> <br/>
    First Name: <%= Request.ServerVariables.Get("HTTP_JOSSO_USER_PROPERTY_FIRST_NAME") %><br/>
    Last Name: <%= Request.ServerVariables.Get("HTTP_JOSSO_USER_PROPERTY_LAST_NAME") %> <br/>
   </p>

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

    <a href="http://ec2-52-29-151-100.eu-central-1.compute.amazonaws.com:8080/preauthn/modify?back_to=http://localhost/partnerapp/protected/index.aspx">
        Edit profile
    </a>
</body>
</html>
