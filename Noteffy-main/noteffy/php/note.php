<?php
    function signUp(&$jsonData){ // this function signups the new user and save there auth data for further use
        if(isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Password1']) && isset($_POST['Email'])){
            if($_POST['Password']!==$_POST['Password1']){
                echo "<script>
                message('Sign Up failed','message_failure');
                </script>";
            }
            else if($_POST['Password']===$_POST['Password1']){
                $users_count = count($jsonData['Users']);
                str_pad($_POST["Username"],32,'#',STR_PAD_RIGHT);
                $jsonData['Users'][$users_count]['User_Name'] = $_POST['Username'];
                $jsonData['Users'][$users_count]['Password'] = encrypt_data($_POST['Password'],str_pad($_POST["Username"],32,'#',STR_PAD_RIGHT));
                $jsonData['Users'][$users_count]['Email'] = $_POST['Email'];
                $jsonData['Users'][$users_count]['Notes'] = array();
                $jsonData['Users'][$users_count]['To-do'] = array();
                $email = $jsonData["Users"][$users_count]["Email"];
                $type = 1;
                $data = '';
                $command = "python C:/Users/DELL/OneDrive/Documents/GitHub/Noteffy/Noteffy-main/noteffy/python/mail.py $email $type $data";
                $otp = (int)exec($command);
                echo <<<_END
                    <script>
                        //Insert Some loading screen here
                        let val = prompt("Enter otp");
                        if(val!=$otp){
                             // Changed
                            window.location.href = '../html/signUp.html?err=iotp&activity=signup&mail=$email';
                        }
                    </script>
                _END;
                
                if(isset($_COOKIE["user"])){
                    echo "<script>clearCookies();</script>";
                }
                setcookie("user",$_POST['Username'],time()+(24*60*60),"/");
                echo "<script>message('Successfully Logged in','message_success'); window.location.href = window.location.href</script>";
            }
        }
    }
    function signIn(&$jsonData){ //this function uses the saved data to verify and let the old user sign in
        if(isset($_POST['User_Name_']) && isset($_POST['Password_'])){
            $users_count = count($jsonData["Users"]);
            $errc = "uid";$name = "";
            for($i = 0;$i < $users_count;$i++){
                // echo $i.'<br>';
                if($jsonData["Users"][$i]["User_Name"] === $_POST['User_Name_']){
                    if($jsonData["Users"][$i]["Password"]===encrypt_data($_POST["Password_"],str_pad($_POST["User_Name_"],32,'#',STR_PAD_RIGHT))){
                        setcookie("user",$jsonData["Users"][$i]["User_Name"]);
                        echo "<script>window.location.href = window.location.href</script>";
                        return ;
                    }
                    else{
                        $name = $jsonData["Users"][$i]["User_Name"];
                        $errc = "upwd";
                    }
                }
            }
            echo '<script>window.location.href="../html/signUp.html?err='.$errc.'&name='.$name.'&activity='.($errc=='uid'?"signup":"signin").'";</script>';
            return;
            
            }
        }
    function getUser(){ // this function fetches the user from the data
        if(isset($_COOKIE["user"])){
            return $_COOKIE["user"];
        }
        else
            return " "; 
    }
    function Delete_Note(&$jsonData){
        if(isset($_GET["N_no"]) && isset($_GET["User"])){
            $n_no = $_GET["N_no"];
            $User = $_GET["User"];
            $userName = getUser($jsonData);
            for($i=0;$i<count($jsonData["Users"]);$i++){
                if($jsonData["Users"][$i]["User_Name"]== $userName && $i==$User){
                    array_splice($jsonData["Users"][$User]["Notes"],$n_no,1);
                    echo "<script>window.location.href = '../php/main.php'</script>";
                    return;
                }
            }
            echo "<Script>window.location.href = '../HTML/error.html'</script>";
        }
    }
    function fetch_store(&$jsonData){ // this function fetches and stores the new note created by by the user
        $user = -1;
        $User_count = count($jsonData['Users']);
        $userName = getUser($jsonData);
        //Do not disturb until later
        echo ' ';
        
        for($i=0;$i<$User_count;$i++){
            if($jsonData['Users'][$i]['User_Name']==$userName)
              $user = $i;
        }
        if(isset($_POST['Title']) && isset($_POST['Note']) && isset($_POST['Date'])){
            $Note_count = count($jsonData['Users'][$user]['Notes']);
            $jsonData['Users'][$user]['Notes'][$Note_count]['Title'] = $_POST['Title'];
            $jsonData['Users'][$user]['Notes'][$Note_count]['Date'] = $_POST['Date'];
            $jsonData['Users'][$user]['Notes'][$Note_count]['Content'] = $_POST['Note'];
        }
        return $user;
    }
    function display(&$jsonData,$user){ // this function displays the user's notes in a scatter manner
        $count = count($jsonData['Users'][$user]['Notes']);
        for ($i=0; $i < $count; $i++){
            $item = $jsonData['Users'][$user]['Notes'][$i];
            $j = $i+1;
            $noteimg = "../media/note".rand(1,3).".png";
            $pinimg = "../media/pin".rand(1,3).".png";
            $title = substr(explode(' ',$item['Title'])[0],0,5);
            $content = $item['Content'];
            $visible = substr($content,0,25);
            echo "<div class=\"divi\" style=\"background-image:url($noteimg);\">
                    <div class=\"topic\">
                        <label id=\"topic\">$j.$title</label>
                        <img id=\"pin\" src=$pinimg alt=\"pin\">
                    </div>
                    <div class=\"data\">
                        <div class=\"screen\">
                            $content
                        </div>
                        <div class=\"control\">
                            <button onclick=\"\">
                                <img src=\"../media/edit.png\" alt=\"\">
                            </button>
                            <button onclick=\"\">
                                <a href='https://web.whatsapp.com/' style='text-decoration:none;'>
                                    <img src=\"../media/share.png\" alt=\"\">
                                </a>
                            </button>
                            <button onclick=\"\">
                                <a href='../php/main.php?N_no=$i&User=$user' style='text-decoration:none;'>
                                    <img src=\"../media/delete.png\" alt=\"\">
                                </a>
                            </button>
                        </div>
                    </div>
                </div>";
        }
    }
?>