<!DOCTTPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Java Compiler</title>
            <link rel="icon" type="image/png" href="imgs/logo.jpg">
        </head>
        <body>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ; ?>" >
                <label>Select Language :</label>
                <select name="language" style="margin-bottom: 10px;margin-top: 10px; ">
                    <!--<option value="cpp">C++</option>
                    <option value="c">C</option>-->
                    <option value="java">JAVA</option>
                </select></br>
                <textarea placeholder="// Enter your code here. (* The Class Name MUST Be code *)" name="code" rows="16" cols="80"></textarea>
                </br></br>
                <label style="margin-bottom: 10px;margin-top: 10px; ">Input : </label></br></br>
                <textarea placeholder="// Enter your inputs here." name="input" rows="10" cols="80"></textarea>
                </br>
                </br><input type="submit" name="run" value="Run">
            </form>
        </body>
    </html>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($_POST['language']=='java'){
                include("compilers/java.php");
            }
        }
        
            
    ?>
    
    <footer>
        </br><center>Developed By :<a href="https://www.facebook.com/iam.ok.1999" target="_blank">Mohamed Ahmed Dawood</a> | Designed By :<a>مكنتش فاضي اعمل ديزاين </a> يبن الظريفه </center>
    </footer>
    