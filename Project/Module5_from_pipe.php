<!DOCTYPE html>

<head>
    <title>Oilgear - module 5</title>
    <link href="Style/accueil.css" rel="stylesheet" type="text/css" />
    <link href="Style/style_input.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="Images/Oilgear_icon.png" />
    <meta charset="utf-8" />
</head>

<body>
    <?php include("Header.php"); ?>

    <div class="page">
        <div class="display">
            <h1>Module 5 - Specifications pipe determination</h1>

            <div class="middle">
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

                $sql2 = "SELECT DISTINCT pipe_type,admissible_stress FROM pipe";
                $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0) {
                    echo "<select name='combo1' id='combo1'>";
                    echo "<option selected value='0'>Select your pipe type</option>";
                    while ($row = $result2->fetch_assoc()) {
                        echo "<option value='" . $row['pipe_type'] . "' data-stress='" . $row['admissible_stress'] . "'>" . $row['pipe_type'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
            </div>
            <input name='text2' id="text2" style="display:none">
            <div class="middle">
                <select name="combo2" id="combo2">
                    <option selected value='0'>External Diameter (in mm)</option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                </select>
                <label>X</label>
                <select name="combo3" id="combo3">
                    <option selected value='0'>Minimum Thinckness (in mm)</option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="middle">
                <select name="combo4" id="combo4">
                    <option selected value='0'>Speed (in m/s)</option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="middle">
                <div class="field field_v1">
                    <label class="ha-screen-reader">Safety coefficient</label>
                    <input type="number" step="0.01" name='text1' id="text1" value="3" class="field__input" placeholder="by default : 3">
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Safety coefficient</span>
                    </span>
                </div>
            </div>

            <div class="middle">
                <button class="noselect red" type="button" value="back" onclick="history.go(-1)">
                    <span class='text'>Cancel</span>
                    <span class="icon">
                        <svg fill="#000000" height="30" width="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                            <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M384,277.333H179.499 l48.917,48.917c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251 l-85.333-85.333c-1.963-1.963-3.52-4.309-4.608-6.933c-2.155-5.205-2.155-11.093,0-16.299c1.088-2.624,2.645-4.971,4.608-6.933 l85.333-85.333c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165l-48.917,48.917H384c11.776,0,21.333,9.557,21.333,21.333 S395.776,277.333,384,277.333z">
                            </path>
                        </svg>
                    </span>
                </button>
                <button class="noselect green" type="submit" onclick="return find_spe_pipe()" name="button1">
                    <span class='text'>Pipe spe</span>
                    <span class="icon">
                        <svg fill="#000000" height="30" width="30" viewBox="0 0 24 24" id="pipe-3" data-name="Line Color" xmlns="http://www.w3.org/2000/svg">
                            <path id="primary" d="M5,14a4,4,0,0,1,4-4h6V3h4v7a4,4,0,0,1-4,4H9v7H5Z" style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                            <path id="secondary" d="M4,21h6M20,3H14" style="fill: none; stroke: #00BFFF; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                        </svg>
                    </span>
                </button>
            </div>
            <div class="rect" id='result' style="display:none">
                <h2>Specifications of my pipe</h2>
                <br>
                <label>Flow :&emsp;</label>
                <label id='resflow'></label>
                <label>&emsp;L/min</label>
                <br><br>
                <label>Operating Pressure :&emsp;</label>
                <label id='respressure'></label>
                <label>&emsp;bar</label>
            </div>

            <script>
                document.getElementById("combo1").addEventListener("change", function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var admissibleStress = selectedOption.getAttribute("data-stress");
                    document.getElementById("text2").value = admissibleStress;
                });

                function find_spe_pipe() {
                    try {
                        var pipe = document.getElementById("combo1").value;
                        var stress = document.getElementById("text2").value;
                        var extdiam = document.getElementById("combo2").value;
                        var minthinck = document.getElementById("combo3").value;
                        var speed = document.getElementById("combo4").value;
                        var safetycoef = document.getElementById("text1").value;

                        var innerradius = extdiam / 2 - minthinck;
                        var section = Math.pow((extdiam - 2 * minthinck) / 2, 2) * Math.PI;
                        var nb = Math.pow(minthinck / innerradius, 2);

                        var resflow = speed * section * 0.06;
                        var respressure = (10 * stress * nb) / (2 + nb);

                        document.getElementById("result").style.display = "block";
                        document.getElementById("resflow").innerHTML = resflow.toString();
                        document.getElementById("respressure").innerHTML = respressure.toString();
                    } catch {
                        alert('Error calculation');
                    }
                }
            </script>
        </div>
    </div>

</body>

</html>