<html>
<head>
    <title>User Registration</title>
    <link href="../theme/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <p>Enter a username with alphanumeric characters only.<br/>
    You must enter a valid email address to receive the confirmation email.</p>
    
    <p><font color="red"><?=$_GET["error"]?></font></p>
    
    <form method="post" action="check.php">
        <table>
            <tr>
                <td>Username: </td><td><input type="text" name="name" maxlength="50" size="10" value="<?=$_GET["name"]?>"/></td>
            </tr>
            <tr>
                <td>Password: </td><td><input type="password" name="pass1" maxlength="50" size="10"/></td>
            </tr>
            <tr>
                <td>Verify Password: </td><td><input type="password" name="pass2" maxlength="50" size="10"/></td>
            </tr>
            <tr>
                <td>Email Address: </td><td><input type="text" name="email" maxlength="70" size="30" value="<?=$_GET["email"]?>"/></td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"/></td>
            </tr>
        </table>
    </form>
</body>
</html>