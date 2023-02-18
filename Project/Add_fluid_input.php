<!DOCTYPE html>

<head>
    <title>Oilgear - add fluid</title>
    <link href="Style/accueil.css" rel="stylesheet" type="text/css" />
    <link href="Style/input.css" rel="stylesheet" type="text/css" />
    <link href="Style/style_input.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="Images/Oilgear_icon.png" />
    <meta charset="utf-8" />
</head>

<body>
    <?php include("Header.php"); ?>

    <div class="page">


        <div id="choix" style="display:block">
            <h1>Modify the database</h1>
            <div class="middle">
                <label class="rad-label">
                    <input type="radio" class="rad-input" id="radio1" name="options" value="1" onclick="showHideTextboxes(this)">
                    <div class="rad-design"></div>
                    <div class="rad-text">Add a fluid</div>
                </label>
                <label class="rad-label">
                    <input type="radio" class="rad-input" id="radio2" name="options" value="2" onclick="showHideTextboxes(this)">
                    <div class="rad-design"></div>
                    <div class="rad-text">Delete a fluid</div>
                </label>
            </div>
        </div>

        <form action="Add_fluid_database.php" method="post">
            <div class="rect" id="add" style="display:none">
                <h1>Add a fluid to database</h1>
                <div>
                    <div class="field field_v1">
                        <label for="nom" class="ha-screen-reader">Name of the fluid</label>
                        <input type="text" name="nom" class="field__input" placeholder="e.g. BP ENERGOL THB 32" required>
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">Name of the fluid</span>
                        </span>
                    </div>
                    <div class="field field_v1">
                        <label for="T_a" class="ha-screen-reader">T_a (in °C)</label>
                        <input type="number" step="0.01" name="T_a" class="field__input" placeholder="represents a temperature of the oil, normally set to 40 °C" required>
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">T_a (in °C)</span>
                        </span>
                    </div>
                    <div class="field field_v1">
                        <label for="V_a" class="ha-screen-reader">V_a at T_a (cst)</label>
                        <input type="number" step="0.01" name="V_a" class="field__input" placeholder="represents the viscosity of the oil at T_a" required>
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">V_a at T_a (cst)</span>
                        </span>
                    </div>
                    <div class="field field_v1">
                        <label for="T_b" class="ha-screen-reader">T_b (in °C)</label>
                        <input type="number" step="0.01" name="T_b" class="field__input" placeholder="represents a temperature of the oil, normaly set to 100 °C" required>
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">T_b (in °C)</span>
                        </span>
                    </div>
                    <div class="field field_v1">
                        <label for="V_b" class="ha-screen-reader">V_b at T_b (cst)</label>
                        <input type="number" step="0.01" name="V_b" class="field__input" placeholder="represents the viscosity of the oil at T_b" required>
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">V_b at T_b (cst)</span>
                        </span>
                    </div>
                    <div class="field field_v1">
                        <label for="API_Grav" class="ha-screen-reader">API Gravity [° API]</label>
                        <input type="number" step="0.01" name="API_Grav" class="field__input" placeholder="represents the API gravity of the oil" required>
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">API Gravity [° API]</span>
                        </span>
                    </div>
                </div>
                <div class="middle">
                    <button class="noselect red" onclick="window.location.href='Accueil.php'">
                        <span class='text'>Cancel</span>
                        <span class="icon">
                            <svg fill="#000000" height="30" width="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M384,277.333H179.499 l48.917,48.917c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251 l-85.333-85.333c-1.963-1.963-3.52-4.309-4.608-6.933c-2.155-5.205-2.155-11.093,0-16.299c1.088-2.624,2.645-4.971,4.608-6.933 l85.333-85.333c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165l-48.917,48.917H384c11.776,0,21.333,9.557,21.333,21.333 S395.776,277.333,384,277.333z">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <button class="noselect green" type="submit" name="button1">
                        <span class='text'>Add fluid</span>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4,11H13v3a1,1,0,0,1-2,0V13H8a1,1,0,0,1,0-2h3V8a1,1,0,0,1,2,0v3h3a1,1,0,0,1,0,2Z" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>

        <form action="Delete_fluid_database.php" method="post">
            <div class="rect" id="delete" style="display:none">
                <h1>Delete a fluid in database</h1>
                <br>
                <div class="field field_v1">
                    <label for="nom" class="ha-screen-reader">Name of the fluid</label>
                    <?php

                    $servername = "sql7.freesqldatabase.com";
                    $username = "sql7596246";
                    $password = "HWEBqf5tTT";
                    $dbname = "sql7596246";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql2 = "SELECT Name_fluid FROM fluid_data_oil";
                    $tableau = array();
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            $tableau[] = $row['Name_fluid'];
                        }
                    } else {
                        echo "0 results";
                    }
                    $size = count($tableau);
                    echo "<select name=comboboxoil>";
                    foreach ($tableau as $namee) {
                        echo "<option value='" . $namee . "'>" . $namee . "</option>";
                    }
                    echo "</select>";
                    $conn->close();
                    ?>
                </div>
                <br><br>
                <div class="middle">
                    <button class="noselect red" onclick="window.location.href='Accueil.php'">
                        <span class='text'>Cancel</span>
                        <span class="icon">
                            <svg fill="#000000" height="30" width="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M384,277.333H179.499 l48.917,48.917c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251 l-85.333-85.333c-1.963-1.963-3.52-4.309-4.608-6.933c-2.155-5.205-2.155-11.093,0-16.299c1.088-2.624,2.645-4.971,4.608-6.933 l85.333-85.333c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165l-48.917,48.917H384c11.776,0,21.333,9.557,21.333,21.333 S395.776,277.333,384,277.333z">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <button class="noselect green" type="submit" name="button1">
                        <span class='longtext'>Delete fluid</span>
                        <span class="icon">
                            <svg viewBox="0 0 1024 1024" height="30" width="30" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                <path d="M960 160h-291.2a160 160 0 0 0-313.6 0H64a32 32 0 0 0 0 64h896a32 32 0 0 0 0-64zM512 96a96 96 0 0 1 90.24 64h-180.48A96 96 0 0 1 512 96zM844.16 290.56a32 32 0 0 0-34.88 6.72A32 32 0 0 0 800 320a32 32 0 1 0 64 0 33.6 33.6 0 0 0-9.28-22.72 32 32 0 0 0-10.56-6.72zM832 416a32 32 0 0 0-32 32v96a32 32 0 0 0 64 0v-96a32 32 0 0 0-32-32zM832 640a32 32 0 0 0-32 32v224a32 32 0 0 1-32 32H256a32 32 0 0 1-32-32V320a32 32 0 0 0-64 0v576a96 96 0 0 0 96 96h512a96 96 0 0 0 96-96v-224a32 32 0 0 0-32-32z" fill="#ffffff"></path>
                                <path d="M384 768V352a32 32 0 0 0-64 0v416a32 32 0 0 0 64 0zM544 768V352a32 32 0 0 0-64 0v416a32 32 0 0 0 64 0zM704 768V352a32 32 0 0 0-64 0v416a32 32 0 0 0 64 0z" fill="#ffffff"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

</body>
<script>
    function showHideTextboxes(radio) {
        if (radio.id == "radio1") {
            alert("add");
            document.getElementById("add").style.display = "block";
            document.getElementById("delete").style.display = "none";
            document.getElementById("choix").style.display = "none";
        } else if (radio.id == "radio2") {
            document.getElementById("add").style.display = "none";
            document.getElementById("delete").style.display = "block";
            document.getElementById("choix").style.display = "none";
            alert("delete");
        }
    }
</script>

</html>