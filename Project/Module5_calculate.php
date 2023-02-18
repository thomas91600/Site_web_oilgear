<!DOCTYPE html>

<head>
  <title>Oilgear - module 5</title>
  <link href="Style/accueil.css" rel="stylesheet" type="text/css" />
  <link href="Style/style_input.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" href="Images/Oilgear_icon.png" />
  <meta charset="utf-8" />
</head>

<body onload="calculate()">
  <?php include("Header.php"); ?>

  <div class="section">
    <div class="page">
      <div class="display">
        <h1>Module 5 - Appropriate pipe determination</h1>

        <?php
        // Récupération de la valeur sélectionnée
        $pipe = $_POST['combo1'];
        $flow = $_POST['text1'];
        $speed = $_POST['combo2'];
        $pressure = $_POST['text2'];
        $safety = $_POST['text4'];
        $stress = $_POST['text3'];

        $innerRadius = sqrt((($flow * 50) / ($speed * pi() * 3)));
        $minThick = $innerRadius * (sqrt((($stress + $pressure / 10) / ($stress - $pressure / 10))) - 1);
        $minThickSafeCoef = $minThick * $safety;
        $minExtDia = $innerRadius * 2 + $minThickSafeCoef * 2;
        $minIntDia = $innerRadius * 2;
        ?>

        <div class="rect">
          <label>Pype Type :&emsp;</label>
          <em><?php echo $pipe; ?></em>
          <br><br>
          <label>Flow :&emsp;</label>
          <?php echo $flow; ?>
          <label>&emsp;L/min</label>
          <br><br>
          <label>Speed :&emsp;</label>
          <?php echo $speed; ?>
          <label>&emsp;m/s</label>
          <br><br>
          <label>Operating Pressure :&emsp;</label>
          <?php echo $pressure; ?>
          <label>&emsp;bar</label>
          <br><br>
          <label>Safety Coefficient :&emsp;</label>
          <?php echo $safety; ?>
          <label>&emsp;(default : 3)</label>
          <br><br>
          <label>Admissible Stress :&emsp;</label>
          <?php echo $stress; ?>
          <label>&emsp;MPa</label>
          <br><br>
          <label>Inner Radius :&emsp;</label>
          <div class="field field_v1">
            <label class="ha-screen-reader">Inner Radius (in mm)</label>
            <input type="number" step="0.01" name='innerRadius' id="innerRadius" value="<?php echo $innerRadius; ?>" class="field__input" placeholder="e.g. 10 mm">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">Inner Radius (in mm)</span>
            </span>
          </div>
          <br><br>
          <label>Minimum Thickness :&emsp;</label>
          <div class="field field_v1">
            <label class="ha-screen-reader">Minimum Thickness (in mm)</label>
            <input type="number" step="0.01" name='minThick' id="minThick" value="<?php echo $minThick; ?>" class="field__input" placeholder="e.g. 10 mm">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">Minimum Thickness (in mm)</span>
            </span>
          </div>
          <br><br>
          <label>Minimum Thinkness with Safety Coefficient :&emsp;</label>
          <div class="field field_v1">
            <label class="ha-screen-reader">Min Thinkness w/ saf coef (in mm)</label>
            <input type="number" step="0.01" name='minThickSafeCoef' id="minThickSafeCoef" value="<?php echo $minThickSafeCoef; ?>" class="field__input" placeholder="e.g. 10 mm">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">Min Thinkness w/ saf coef (in mm)</span>
            </span>
          </div>
          <br><br>
          <label>Minimum External Diameter :&emsp;</label>
          <div class="field field_v1">
            <label class="ha-screen-reader">Min External Diameter (in mm)</label>
            <input type="number" step="0.01" name='minExtDia' id="minExtDia" value="<?php echo $minExtDia; ?>" class="field__input" placeholder="e.g. 10 mm">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">Min External Diameter (in mm)</span>
            </span>
          </div>
          <br><br>
          <label>Minimum Internal Diameter :&emsp;</label>
          <div class="field field_v1">
            <label class="ha-screen-reader">Min Internal Diameter (in mm)</label>
            <input type="number" step="0.01" name='minIntDia' id="minIntDia" value="<?php echo $minIntDia; ?>" class="field__input" placeholder="e.g. 10 mm">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">Min Internal Diameter (in mm)</span>
            </span>
          </div>
          <br>
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
          <button class="noselect green" type="submit" onclick="return findpipe()" name="button1">
            <span class='longtext'>Find a pipe</span>
            <span class="icon">
              <svg fill="#000000" height="30" width="30" viewBox="0 0 24 24" id="pipe-3" data-name="Line Color" xmlns="http://www.w3.org/2000/svg">
                <path id="primary" d="M5,14a4,4,0,0,1,4-4h6V3h4v7a4,4,0,0,1-4,4H9v7H5Z" style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                <path id="secondary" d="M4,21h6M20,3H14" style="fill: none; stroke: #00BFFF; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
              </svg>
            </span>
          </button>
        </div>
        <div class="rect" id='result' style="display:none">
          <h2>Result</h2>
          <br>
          <label>Pype Type :&emsp;</label>
          <label id='respipetype'></label>
          <br><br>
          <label>External Diameter :&emsp;</label>
          <label id='resextdiam'></label>
          <label>&emsp;mm</label>
          <br><br>
          <label>Minimum Thinckness :&emsp;</label>
          <label id='resminthinck'></label>
          <label>&emsp;mm</label>
        </div>
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

$sql2 = "SELECT Pipe_Type,External_Diameter,Wall_Thickness,Internal_Diameter FROM pipe WHERE Pipe_Type='".$pipe."'and External_Diameter>='".$minExtDia."'and Wall_Thickness>='".$minThickSafeCoef."'and Internal_Diameter >='".$minIntDia."' LIMIT 1";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
  while($row = $result2->fetch_assoc()) {
    $result_pipe = $row['Pipe_Type'];
    $result_wall_thickness = $row['Wall_Thickness'];
    $result_diametre_ext = $row['External_Diameter'];
    $result_diametre_int = $row['Internal_Diameter'];
  }
}
 else {
    echo "0 results";
}
$conn->close();
?>

<script>
function findpipe() {
            var pipe = "<?php echo $pipe; ?>";
            var flow = "<?php echo $flow; ?>";
            var speed = "<?php echo $speed; ?>";
            var pressure = "<?php echo $pressure; ?>";
            var safety = "<?php echo $safety; ?>";
            var stress = "<?php echo $stress; ?>";
            var innerRadius = document.getElementById("innerRadius").value;
            var minThick = document.getElementById("minThick").value;
            var minThickSafeCoef = document.getElementById("minThickSafeCoef").value;
            var minExtDia = document.getElementById("minExtDia").value;
            var minIntDia = document.getElementById("minIntDia").value;
            document.getElementById("result").style.display = "block";
            document.getElementById("respipetype").innerHTML = "<?php echo $result_pipe; ?>".toString();
            document.getElementById("resextdiam").innerHTML = "<?php echo $result_diametre_ext; ?>".toString();
            document.getElementById("resminthinck").innerHTML = "<?php echo $result_wall_thickness; ?>".toString();
          }
</script>
        </script>
      </div>
    </div>
  </div>

</body>

</html>