<html>
<body>
        <?php 
        $PSWD="skcet";
        $USR="Admin";
        echo $_POST["Username"]; 
        if($USR==$_POST["Username"] && $PSWD==$_POST["Password"])
        {
                header("Location: ../admin.html");
        }
        else{
                $message = "Username and/or Password incorrect.\\nTry again.";
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('$message')
                        window.location.href='../form.html';
                        </SCRIPT>");
                exit;
         }

        ?>
        
</body>
</html>