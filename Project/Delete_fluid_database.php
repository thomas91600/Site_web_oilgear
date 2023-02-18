<!DOCTYPE html>

<head>
    <title>Oilgear - add fluid</title>
    <link href="Style/accueil.css" rel="stylesheet" type="text/css" />
    <link href="Style/input.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="Images/Oilgear_icon.png" />
    <meta charset="utf-8" />
</head>

<body>
    <?php include("Header.php"); ?>

    <div class="page">
        <form action="Accueil.php" method="post">
            <div class="middle">    
                <div id="loading" class="wrapper">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="shadow"></div>
                    <div class="shadow"></div>
                    <div class="shadow"></div>
                    <span>Loading</span>
                </div>
            </div>

            <div class="middle">    
                <div id="check" style="visibility: hidden">
                    <svg width="153px" height="153px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#00ff00" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.048"></g>
                        <g id="SVGRepo_iconCarrier"> 
                            <path d="M16 3.93552C14.795 3.33671 13.4368 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 11.662 20.9814 11.3283 20.9451 11M21 5L12 14L9 11" stroke="#51cb25" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path> 
                        </g>
                    </svg>
                </div>
            </div>

            <div class="middle">    
                <div id="error" style="visibility: hidden">
                    <svg width="151px" height="151px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"> <title>error</title> 
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> 
                                <g id="add" fill="#ff0000" transform="translate(42.666667, 42.666667)"> 
                                    <path d="M213.333333,3.55271368e-14 C331.136,3.55271368e-14 426.666667,95.5306667 426.666667,213.333333 C426.666667,331.136 331.136,426.666667 213.333333,426.666667 C95.5306667,426.666667 3.55271368e-14,331.136 3.55271368e-14,213.333333 C3.55271368e-14,95.5306667 95.5306667,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C119.232,42.6666667 42.6666667,119.232 42.6666667,213.333333 C42.6666667,307.434667 119.232,384 213.333333,384 C307.434667,384 384,307.434667 384,213.333333 C384,119.232 307.434667,42.6666667 213.333333,42.6666667 Z M262.250667,134.250667 L292.416,164.416 L243.498667,213.333333 L292.416,262.250667 L262.250667,292.416 L213.333333,243.498667 L164.416,292.416 L134.250667,262.250667 L183.168,213.333333 L134.250667,164.416 L164.416,134.250667 L213.333333,183.168 L262.250667,134.250667 Z" id="error"> </path> 
                                </g> 
                            </g> 
                        </g>
                    </svg>
                </div>
            </div>

            <div class="middle">
                <button class="noselect red" type="submit">
                    <span class='text'>Home</span>
                    <span class="icon">
                        <svg fill="#000000" height="30" width="30" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512 512" xml:space="preserve">
                            <path
                                d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M384,277.333H179.499 l48.917,48.917c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251 l-85.333-85.333c-1.963-1.963-3.52-4.309-4.608-6.933c-2.155-5.205-2.155-11.093,0-16.299c1.088-2.624,2.645-4.971,4.608-6.933 l85.333-85.333c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165l-48.917,48.917H384c11.776,0,21.333,9.557,21.333,21.333 S395.776,277.333,384,277.333z">
                            </path>
                        </svg>
                    </span>
                </button>
            </div>

            <?php
                //echo "<meta charset=\"utf-8\">";
                //echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"g20style.css\">";
                //identifier votre BDD
                //$database = "oilgear";
                //identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
                //$db_handle = mysqli_connect('localhost', 'root', '');
                //$db_found = mysqli_select_db($db_handle, $database);


                $nom = isset($_POST["comboboxoil"])? $_POST["comboboxoil"] : "";

                $sql = "";
                $servername = "sql7.freesqldatabase.com";
                $username = "sql7596246";
                $password = "HWEBqf5tTT";
                $dbname = "sql7596246";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "DELETE FROM fluid_data_oil WHERE Name_fluid='$nom'";

                if($conn->query($sql) === TRUE) {
                    ?><!DOCTYPE html>
                    <script type="text/javascript">
                        function showDivLoading() {
                            document.getElementById("loading").style.visibility = "hidden";
                        }
                        setTimeout("showDivLoading()", 3000); // after 3s
                        function showDivCheck() {
                            document.getElementById("check").style.visibility = "visible";
                        }
                        setTimeout("showDivCheck()", 3000); // after 3s
                    </script>                    
                    <?php
                    //header('Location: Accueil.php');
                }
                else{
                    echo($conn->error);
                    ?><!DOCTYPE html>
                    <script type="text/javascript">
                        function showDivLoading() {
                            document.getElementById("loading").style.visibility = "hidden";
                        }
                        setTimeout("showDivLoading()", 3000); // after 3s
                        function showDivError() {
                            document.getElementById("error").style.visibility = "visible";
                        }
                        setTimeout("showDivError()", 3000); // after 3s
                    </script>                 
                <?php
                }
                $conn->close();            
            ?>
        </form>
    </div>
</body>
</html>

