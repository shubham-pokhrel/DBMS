<html>
    <head>
        <title> Form </title>
        
    </head>
    <body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <centre>
                <b>
                    <h1> Registration Page</h1>
                </b>
            </centre>
            <hr>
            Name <input type="Name" name= "Name" size="20"><br /><br />
            Contact number <input type="contact" name= "contact" size="10"><br /><br />
            Card number <input type="card" name="card" size="5"><br /><br />
            <centre>
                <input type="submit" name="submit" value="Submit">
                <button type="button" name="Search" onclick="search()">Search</button>
            </centre>
        </form>

    </body>
    <?php
        if(isset($_POST['submit']))
        {
            $name = $_POST['Name'];
            $card = $_POST['card'];
            $contact = $_POST['contact'];
        
            $name = trim($name);
            $card = trim($card);
            $contact = trim($contact);

            if (empty($name) || empty($card) || empty($contact)) 
                {
                    echo "Please fill in all the fields.";
                   // header("Location: index.php?error=Please fill in all the required fields."); //if want to refresh the page or move to another page
                    exit();
                }    
            else
                {   
                    //database information
                    $servername = "fdb26.awardspace.net";
                    $username = "3442939_shubhampokhrel";
                    $password = "@12345Zxcv";
                    $dbname = "3442939_shubhampokhrel";
                
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) 
                        {
                            die("Connection failed: " . $conn->connect_error);
                        }
                    $sql_check = "SELECT * FROM DBMS WHERE ID_CARD_NO = '$card'";
                    //echo "$sql_check";
                    $result_check = $conn->query($sql_check);
            
                    if ($result_check->num_rows > 0) 
                        {
                            // Card number already exists
                            echo "<p>Given card number is already registered for another user.</p>";
                        }
                    else
                        {
                            // Card number not exists in database
                            $sql = "INSERT INTO DBMS (NAME, ID_CARD_NO, CONTACT_NUMBER) VALUES ('$name', '$card', '$contact')"; 
                            echo "Form submitted successfully.";
                            mysqli_query($conn,$sql) or die(mysqli_error($conn));
                        }
                    
                    //mysqli_query($conn,$SQL1) or die(mysqli_error($conn));
                    $conn->close();
                }    
            // if (empty($name) && empty($card) && !empty($contact))
            //     {
            //         echo "search with contact";
            //         exit();
            //     }
            // elseif(empty($name) && empty($contact) && !empty($card))
            // {
            //     echo "search with card";
            // } 
            // elseif(empty($card) && empty($contact) && !empty($name))
            // {
            //     echo "search with name";
            // } 
        }
        // function searchData() {
        //     // Replace this with your actual PHP function logic
        //     echo "Hello from PHP function!";
        // }
    ?>
    <script>
        function search()
            {
                // var form = document.getElementById("Form");

                // var name = form.elements['Name'].value.trim();
                // var card = form.elements['card'].value.trim();
                // var contact = form.elements['contact'].value.trim();

                window.location.href = "search.php";

            //    if (name === '' && card === '' && contact !='' )
            //         {
            //             alert("search with contact");
            //             return; 
            //         }
            //     elseif (name === '' && contact === '' && card !='' )
            //         {
            //             alert("search with card");
            //             return; 
            //         } 
            //     elseif (contact === '' && card === '' && name !='' )
            //         {
            //             alert("search with name");
            //             return; 
            //         }  
                     
            }
    </script>        
</html>