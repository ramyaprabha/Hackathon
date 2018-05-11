<html>
<body>
    <?php
        exec('python C:\xampp\htdocs\pyth\sqldb2.py');
        $out= shell_exec ('python C:\xampp\htdocs\pyth\sqldb2.py');
        echo $out;
    ?>
        
</body>
</html>