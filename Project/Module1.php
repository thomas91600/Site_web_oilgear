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

    <div class="section">
        <div class="page">
            <div class="display">
                <h1>Module 1 - Thermodynamic properties of a fluid for a given pressure and temperature</h1>

                <div class="middle">
                    <select name="combo1" id="combo1" onclick="showHideComboBox()">
                        <option selected value='0'>Select a type of fluid</option>
                        <option value="Water based fluids">Water based fluids</option>
                        <option value="Oil fluids">Oil fluids</option>
                    </select>
                </div>

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

                    $sql2 = "SELECT * FROM fluid_data_water";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        echo "<select name=combo3 id=combo3 style='display:none'>";
                        echo "<option selected value='0'>Select your water</option>";
                        while ($row = $result2->fetch_assoc()) {

                            echo "<option value='" . $row['FluideEauGlacelf']
                                . "' data-densite='" . $row['Density']
                                . "' data-speheat='" . $row['Specific_heat']
                                . "' data-visco='" . $row['	Kinematic_viscosity']
                                . "' data-themcond='" . $row['Thermal_conductivity']
                                . "'required>" . $row['FluideEauGlacelf'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                    <label id='data-densite' style="display:none"></label>
                    <label id='data-speheat' style="display:none"></label>
                    <label id='data-visco' style="display:none"></label>
                    <label id='data-themcond' style="display:none"></label>
                </div>

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

                    $sql2 = "SELECT * FROM fluid_data_oil";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        echo "<select name=combo2 id=combo2 style='display:none'>";
                        echo "<option selected value='0'>Select your oil</option>";
                        while ($row = $result2->fetch_assoc()) {

                            echo "<option value='" . $row['Name_fluid']
                                . "' data-densite='" . $row['Densite_API']
                                . "' data-t_a='" . $row['TempA_C']
                                . "' data-v_a='" . $row['Va_cst']
                                . "' data-t_b='" . $row['TempB_C']
                                . "' data-v_b='" . $row['Vb_cst']
                                . "'required>" . $row['Name_fluid'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                    <label id='data-densite' style="display:none"></label>
                    <label id='data-t_a' style="display:none"></label>
                    <label id='data-v_a' style="display:none"></label>
                    <label id='data-t_b' style="display:none"></label>
                    <label id='data-v_b' style="display:none"></label>
                </div>

                <div class="middle">
                    <div class="field field_v1">
                        <label class="ha-screen-reader">Pressure (in bar)</label>
                        <input type="number" step="0.01" name='text1' id="text1" class="field__input" placeholder="e.g. 3 bar">
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">Pressure (in bar)</span>
                        </span>
                    </div>
                </div>

                <div class="middle">
                    <div class="field field_v1">
                        <label class="ha-screen-reader">Temperature (in °C)</label>
                        <input type="number" step="0.01" name='text2' id="text2" class="field__input" placeholder="e.g. 10 °C">
                        <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">Temperature (in °C)</span>
                        </span>
                    </div>
                </div>

                <div class="middle">
                    <button class="noselect red" type="button" value="back" onclick="window.location.href='Accueil.php'">
                        <span class='text'>Cancel</span>
                        <span class="icon">
                            <svg fill="#000000" height="30" width="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M384,277.333H179.499 l48.917,48.917c8.341,8.341,8.341,21.824,0,30.165c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251 l-85.333-85.333c-1.963-1.963-3.52-4.309-4.608-6.933c-2.155-5.205-2.155-11.093,0-16.299c1.088-2.624,2.645-4.971,4.608-6.933 l85.333-85.333c8.341-8.341,21.824-8.341,30.165,0s8.341,21.824,0,30.165l-48.917,48.917H384c11.776,0,21.333,9.557,21.333,21.333 S395.776,277.333,384,277.333z">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <button class="noselect green" type="submit" onclick="return calculation()" name="button1">
                        <span class='text'>Calculate</span>
                        <span class="icon">
                            <svg fill="#000000" height="30" width="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.45,7.83h-2.8v2.81a.5.5,0,0,1-1,0V7.83H13.84a.5.5,0,0,1,0-1h2.81V4.02a.5.5,0,0,1,1,0V6.83h2.8A.5.5,0,0,1,20.45,7.83Z"></path>
                                <path d="M3.545,7.83a.5.5,0,0,1,0-1h6.619a.5.5,0,0,1,0,1Z"></path>
                                <path d="M13.836,16.05a.5.5,0,0,1,0-1h6.619a.5.5,0,0,1,0,1Z"></path>
                                <path d="M13.836,20.191a.5.5,0,0,1,0-1h6.619a.5.5,0,0,1,0,1Z"></path>
                                <path d="M9.55,19.61a.5.5,0,0,1-.71.7L6.86,18.33c-.66.65-1.33,1.32-1.99,1.98a.5.5,0,0,1-.71-.7l1.99-1.99L4.16,15.63a.5.5,0,0,1,.71-.7l.58.58,1.4,1.4c.67-.66,1.33-1.32,1.99-1.98a.5.5,0,0,1,.71.7L7.56,17.62Z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="rect" id='result' style="display:none">
                    <h2>Results</h2>
                    <br>
                    <label>Density :&emsp;</label>
                    <label id='resdensity'></label>
                    <label>&emsp;kg.m-3</label>
                    <br><br>
                    <label>Viscosity :&emsp;</label>
                    <label id='resviscosity'></label>
                    <label>&emsp;(cst)</label>
                    <br><br>
                    <label>Specific Heat :&emsp;</label>
                    <label id='resspeheat'></label>
                    <label>&emsp;J.kg-1.K-1</label>
                    <br><br>
                    <label>Thermal Conductivity :&emsp;</label>
                    <label id='resthemcond'></label>
                    <label>&emsp;W.m-1.K-1</label>
                </div>

                <script>
                    document.getElementById("combo2").addEventListener("change", function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var densite_api = selectedOption.getAttribute("data-densite");
                        document.getElementById("data-densite").value = densite_api;
                        var t_a = selectedOption.getAttribute("data-t_a");
                        document.getElementById("data-t_a").value = t_a;
                        var v_a = selectedOption.getAttribute("data-v_a");
                        document.getElementById("data-v_a").value = v_a;
                        var t_b = selectedOption.getAttribute("data-t_b");
                        document.getElementById("data-t_b").value = t_b;
                        var v_b = selectedOption.getAttribute("data-v_b");
                        document.getElementById("data-v_b").value = v_b;
                    });
                    document.getElementById("combo3").addEventListener("change", function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var densite_api = selectedOption.getAttribute("data-densite");
                        document.getElementById("data-densite").value = densite_api;
                        var speheat = selectedOption.getAttribute("data-speheat");
                        document.getElementById("data-speheat").value = speheat;
                        var visco = selectedOption.getAttribute("data-visco");
                        document.getElementById("data-visco").value = visco;
                        var themcond = selectedOption.getAttribute("data-themcond");
                        document.getElementById("data-themcond").value = themcond;
                    });

                    function showHideComboBox() {
                        if (document.getElementById("combo1").value == "0") {
                            document.getElementById("combo2").style.display = "none";
                            document.getElementById("combo3").style.display = "none";
                        }
                        if (document.getElementById("combo1").value == "Oil fluids") {
                            document.getElementById("combo2").style.display = "block";
                            document.getElementById("combo3").style.display = "none";
                        }
                        if (document.getElementById("combo1").value == "Water based fluids") {
                            document.getElementById("combo3").style.display = "block";
                            document.getElementById("combo2").style.display = "none";
                        }
                    }

                    function calculation() {

                        try {
                            if (document.getElementById("combo1").value == "Oil fluids") {
                                var name_fluid = document.getElementById("combo2").value;
                                var pressure = parseFloat(document.getElementById("text1").value);
                                var temp = parseFloat(document.getElementById("text2").value);

                                var densite_api = parseFloat(document.getElementById("data-densite").value);
                                var t_a = parseFloat(document.getElementById("data-t_a").value * 1.8 + 32 + 459.67);
                                var v_a = parseFloat(document.getElementById("data-v_a").value);
                                var t_b = parseFloat(document.getElementById("data-t_b").value * 1.8 + 32 + 459.67);
                                var v_b = parseFloat(document.getElementById("data-v_b").value);

                                var consA = (Math.log10(Math.log10(v_b)) - Math.log10(Math.log10(v_a))) / (Math.log10(t_b) - Math.log10(t_a));
                                var consB = Math.log10(Math.log10(v_a)) - ((Math.log10(Math.log10(v_b)) - Math.log10(Math.log10(v_a))) / (Math.log10(t_b) - Math.log10(t_a))) * Math.log10(t_a)

                                var temp_calc = temp * 1.8 + 32 + 459.67;

                                var v_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temp_calc) + consB)));
                                var visco = Math.exp(Math.log(10) * (pressure / 1000) * (0.0239 + 0.01638 * Math.pow(v_t, 0.278)) + Math.log(v_t));

                                var density = ((((141.5 / (densite_api + 131.5)) * (8.331 / 231) / 386.4) / Math.pow(0.08333, 4)) * 515.38) * (1 - 0.000355 * (temp - 15));
                                var specific_density = density / 1000;
                                var specific_heat = (1 / Math.pow(specific_density, 0.5)) * (0.388 + 0.00045 * temp) * 4186.800000009;

                                var therm_conduc = ((0.813 / specific_density) * (1 - 0.0003 * ((temp * 9 / 5) + 32 - 32)) / 3600 / 144) * 12 * 3600 * 1.7295772056;
                            }

                            if (document.getElementById("combo1").value == "Water based fluids") {
                                var name_fluid = document.getElementById("combo3").value;
                                var pressure = parseFloat(document.getElementById("text1").value);
                                var temp = parseFloat(document.getElementById("text2").value);

                                var c1 = 5.074 * Math.pow(10, -10);
                                var c2 = -3.26 * Math.pow(10, -12);
                                var c3 = 4.16 * Math.pow(10, -15);
                                var cp = 1 + (c1 + temp * c2 + c3 * temp) * (pressure * Math.pow(10, 5) - 101325);

                                var density_a1 = 999.20571;
                                var density_a2 = 0.095390097;
                                var density_a3 = -0.007618664;
                                var density_a4 = 3.13058E-05;
                                var density_a5 = -6.17377E-08;
                                var density_a6 = 0.43368858;
                                var density_a7 = 2.54957E-05;
                                var density_a8 = -2.8988E-07;
                                var density_a9 = 9.57843E-10;
                                var density_a10 = 0.00176275;
                                var density_a11 = -0.000123127;
                                var density_a12 = 1.36594E-06;
                                var density_a13 = 4.04546E-09;
                                var density_a14 = -1.46732E-05;
                                var density_a15 = 8.83916E-07;
                                var density_a16 = -1.10213E-09;
                                var density_a17 = 4.24726E-11;
                                var density_a18 = -3.95918E-14;

                                var density_b1 = -0.79999223;
                                var density_b2 = 0.002409365;
                                var density_b3 = -0.00002581;
                                var density_b4 = 6.85608E-08;
                                var density_b5 = 0.000629761;
                                var density_b6 = -9.36264E-07;

                                var heat_a1 = 4.192843;
                                var heat_a2 = -0.000227325;
                                var heat_a3 = 2.36863E-06;
                                var heat_a4 = 1.67009E-10;
                                var heat_a5 = -0.003978228;
                                var heat_a6 = 3.22914E-05;
                                var heat_a7 = -1.07252E-09;
                                var heat_a8 = 1.91297E-05;
                                var heat_a9 = -4.17583E-07;
                                var heat_a10 = 2.30627E-09;

                                var heat_b1 = 0.005020186;
                                var heat_b2 = -9.96123E-06;
                                var heat_b3 = 6.81489E-08;
                                var heat_b4 = -2.60462E-05;
                                var heat_b5 = 4.58529E-08;
                                var heat_b6 = 7.64173E-10;
                                var heat_b7 = -3.6488E-08;
                                var heat_b8 = 2.4963E-10;
                                var heat_b9 = 1.18642E-06;
                                var heat_b10 = 4.34586E-09;

                                if (name_fluid == "Fresh Water") {
                                    var density = (-0.003663 * Math.pow(temp, 2)) - 0.059732 * temp + 1000.260714 + cp;
                                    var visco = ((0.00000000003259 * Math.pow(temp, 4) - 0.000000009063 * Math.pow(temp, 3) + 0.0000009834 * Math.pow(temp, 2) - 0.00005521 * temp + 0.00178) / density) * Math.pow(10, 6);
                                    var specific_heat = (0.00001 * Math.pow(temp, 2) - 0.0014 * temp + 4.2125) * 1000;
                                    var therm_conduc = -0.0000094839 * Math.pow(temp, 2) + 0.0021359779 * temp + 0.5599843467;
                                }
                                if (name_fluid == "Glacelf 10 %") {
                                    var density = (-0.003496 * Math.pow(temp, 2)) - 0.104875 * temp + 1017.110714;
                                    var visco = (0.0000000000000390625 * Math.pow(temp, 4) - 1.255787037E-11 * Math.pow(temp, 3) + 1.50868055555E-09 * Math.pow(temp, 2) - 8.534391534392E-08 * temp + 2.49960317460398E-06) * Math.pow(10, 6);
                                    var specific_heat = (0.000002 * Math.pow(temp, 2) + 0.0006 * temp + 4.0496) * 1000;
                                    var therm_conduc = 0;
                                }
                                if (name_fluid == "Glacelf 20 %") {
                                    var density = (-0.002268 * Math.pow(temp, 2)) - 0.309355 * temp + 1036.003279;
                                    var visco = (6.510417E-14 * Math.pow(temp, 4) - 1.961805556E-11 * Math.pow(temp, 3) + 2.21354166666E-09 * Math.pow(temp, 2) - 1.2015873015871E-07 * temp + 3.39404761904851E-06) * Math.pow(10, 6);
                                    var specific_heat = (-0.00002 * Math.pow(temp, 2) + 0.0039 * temp + 3.910001) * 1000;
                                    var therm_conduc = 0;
                                }
                                if (name_fluid == "Glacelf 30 %") {
                                    var density = (-0.002312 * Math.pow(temp, 2)) - 0.342607 * temp + 1050.892857;
                                    var visco = (1.0416667E-13 * Math.pow(temp, 2) - 2.986111111E-11 * Math.pow(temp, 3) + 0.00000000325 * Math.pow(temp, 2) - 1.7246031746028E-07 * temp + 4.69523809523918E-06) * Math.pow(10, 6);
                                    var specific_heat = (-0.00003 * Math.pow(temp, 2) + 0.0045 * temp + 3.77) * 1000;
                                    var therm_conduc = 0;
                                }
                                if (name_fluid == "Glacelf 40 %") {
                                    var density = (-0.00171 * Math.pow(temp, 2)) - 0.450875 * temp + 1066.696429;
                                    var visco = (0.0000000000001953125 * Math.pow(temp, 4) - 5.306712963E-11 * Math.pow(temp, 3) + 5.39756944444E-09 * Math.pow(temp, 2) - 2.6340608465599E-07 * temp + 6.50039682539808E-06) * Math.pow(10, 6);
                                    var specific_heat = (-0.00003 * Math.pow(temp, 2) + 0.0062 * temp + 3.4589) * 1000;
                                    var therm_conduc = 0;
                                }
                                if (name_fluid == "Glacelf 50 %") {
                                    var density = -(0.001397 * Math.pow(temp, 2)) - 0.515982 * temp + 1080.689286;
                                    var visco = (2.9947917E-13 * Math.pow(temp, 4) - 7.991898148E-11 * Math.pow(temp, 3) + 7.94618055554E-09 * Math.pow(temp, 2) - 3.7780423280407E-07 * temp + 8.99484126984276E-06) * Math.pow(10, 6);
                                    var specific_heat = (-0.00002 * Math.pow(temp, 2) + 0.00701 * temp + 3.1796) * 1000;
                                    var therm_conduc = 0;
                                }
                                if (name_fluid == "Sea Water") {
                                    var density = (density_a1 + density_a2 * temp + density_a3 * Math.pow(temp, 2) + density_a4 * Math.pow(temp, 3) + density_a5 * Math.pow(temp, 4) + density_a6 * pressure * 0.1 + density_a7 * (pressure * 0.1) * Math.pow(temp, 2) + density_a8 * (pressure * 0.1) * Math.pow(temp, 3) + density_a9 * (pressure * 0.1) * Math.pow(temp, 4) + density_a10 * (Math.pow((pressure * 0.1), 2)) + density_a11 * (Math.pow((pressure * 0.1), 2)) * temp + density_a12 * (Math.pow((pressure * 0.1), 2)) * (Math.pow(temp, 2)) + density_a13 * (Math.pow((pressure * 0.1), 2)) * (Math.pow(temp, 3)) + density_a14 * (Math.pow((pressure * 0.1), 3)) + density_a15 * (Math.pow((pressure * 0.1), 3)) * temp + density_a16 * (Math.pow((pressure * 0.1), 3)) * (Math.pow(temp, 2)) + density_a17 * (Math.pow((pressure * 0.1), 3)) * (Math.pow(temp, 3)) + density_a18 * (Math.pow((pressure * 0.1), 3)) * (Math.pow(temp, 4))) - (density_b1 * 35 + density_b2 * 35 * temp + density_b3 * 35 * Math.pow(temp, 2) + density_b4 * 35 * Math.pow(temp, 3) + density_b5 * 35 * pressure * 0.1 + density_b6 * 35 * Math.pow((pressure * 0.1), 2));
                                    var visco = ((4.2844 * Math.pow(10, -5) + Math.pow(0.157 * Math.pow(temp + 64.993, 2) - 91.296, -1)) / density) * Math.pow(10, 6);
                                    /* pas le bon resultat */var specific_heat = Math.pow(10, 3) * (heat_a1 + heat_a2 * temp + heat_a3 * Math.pow(temp, 2) + heat_a4 * Math.pow(temp, 4) + heat_a5 * pressure * 0.1 + heat_a6 * pressure * 0.1 * temp + heat_a7 * pressure * 0.1 * Math.pow(temp, 3) + heat_a8 * ((pressure * 0.1) ^ 2) + heat_a9 * ((pressure * 0.1) ^ 2) * temp + heat_a10 * ((pressure * 0.1) ^ 2) * Math.pow(temp, 2)) - (temp + 273.15) * (heat_b1 * 35 + heat_b2 * (35 ^ 2) + heat_b3 * (35 ^ 3) + heat_b4 * 35 * temp + heat_b5 * 35 * Math.pow(temp, 2) + heat_b6 * 35 * Math.pow(temp, 3) + heat_b7 * (35 ^ 2) * temp + heat_b8 * (35 ^ 3) * temp + heat_b9 * 35 * pressure * 0.1 + heat_b10 * 35 * temp * pressure * 0.1);
                                    var therm_conduc = 0;
                                }
                            }

                            document.getElementById("result").style.display = "block";
                            document.getElementById("resdensity").innerHTML = density.toString();
                            document.getElementById("resviscosity").innerHTML = visco.toString();
                            document.getElementById("resspeheat").innerHTML = specific_heat.toString();
                            document.getElementById("resthemcond").innerHTML = therm_conduc.toString();

                        } catch {
                            alert('Error calculation');
                        }
                    }
                </script>
            </div>
        </div>
    </div>

</body>


</html>