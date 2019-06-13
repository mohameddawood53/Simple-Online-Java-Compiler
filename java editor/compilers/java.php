
    <?php
        $output             = "";
        putenv("PATH=C:\Program Files\Java\jdk1.8.0_144\bin");
        //shell_exec("javac code.java 2>&1");
        //echo shell_exec("java code 2>&1");
        
        // Variables 
        $cc                 = "javac";                       // CMD Command for Compileing the code file 
        $out                = "java code";                   // CMD Command for executeing the code file 
        $code               = $_POST['code'];                // Getting the value of the code field
        $input              = $_POST['input'];               // Getting the values of the inputs field
        $code_path          = "code.java";                   // The path of the code file for compileing 
        $input_file         = "input.txt";                   // The path of the input file 
        $error_file         = "error.txt";                   // The path of the error file 
        $runtime_file       = "runtime.txt";                 // The path of the runtime errors file ( Stores the runtime errors in the program )
        $executable         = "*.class";
        $command            = $cc . " " . $code_path;        // CMD Compile permission 
        $command_error      = $command . " 2>" .$error_file; // CMD Getting Errors Permission 
        $runtime_error_file = $out. " 2>".$runtime_file;      // CMD Getting Runtime Erros Permission 
        
		$error_file_open   = fopen($error_file,'w+') or die("Unable to open file!");
        $file_code         = fopen($code_path,'w+') or die("Unable to open file!");
        fwrite($file_code,$code);
        fclose($file_code);
        $file_in           = fopen($input_file,'w+') or die("Unable to open file!");
        fwrite($file_in,$input);
        fclose($file_in);
        
        exec("cacls  $executable /g everyone:f"); 
    	exec("cacls  $error_file /g everyone:f");
        
        // compiling the file
        shell_exec($command);
        $error               = file_get_contents($error_file);
        
        // the conditions
        if (trim($error)=="")
        {
            if (trim($input)=="")
            {
                shell_exec($runtime_error_file);
                $runtime_error= file_get_contents($runtime_file);
                $output       = shell_exec($out);
            }else{
                shell_exec($runtime_error_file);
                $runtime_error= file_get_contents($runtime_file);
                $out          = $out . " < " .$input_file;
                $output       = shell_exec($out);
            }
            ?>
            <label style="margin-bottom: 10px;margin-top: 10px; ">Output : </label></br></br>
            <textarea placeholder="// The result is :"  rows="10" cols="80"><?php echo $output; ?></textarea>
            <?php
        }else if (!strpos($error,"error"))
        {
            if (trim($input) == "")
            {
                $output=shell_exec($out);
            }else{
                $out=$out." < ".$input_file;
			    $output=shell_exec($out);
            }
            ?>
            <label style="margin-bottom: 10px;margin-top: 10px; ">Output : </label></br></br>
            <textarea placeholder="// The result is :"  rows="10" cols="80"><?php echo $output; ?></textarea>
            <?php
        }else
            {
                ?>
                <label style="margin-bottom: 10px;margin-top: 10px; ">Output : </label></br></br>
                <textarea placeholder="// The result is :"  rows="10" cols="80"><?php echo "<pre>$error</pre>"; ?></textarea>
                <?php
                
            }
                        exec("del $code_path");
			exec("del *.txt");
			exec("del $executable");
    ?>


			
		
