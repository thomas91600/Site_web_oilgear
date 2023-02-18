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
      <h1>Module 5 - Appropriate pipe determination</h1>
      <form action="Module5_calculate.php" method="post">
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
        <br><br>
        <div class="field field_v1">
          <label class="ha-screen-reader">Admissible Stress (MPa)</label>
          <input type="number" step="0.01" name='text3' id="text3" class="field__input" placeholder="e.g. 200 MPa">
          <span class="field__label-wrap" aria-hidden="true">
            <span class="field__label">Admissible Stress (MPa)</span>
          </span>
        </div>
        <br><br>
        <div class="field field_v1">
          <label class="ha-screen-reader">Flow (in L/min)</label>
          <input type="number" step="0.01" name='text1' id="text1" class="field__input" placeholder="e.g. 20 l/min">
          <span class="field__label-wrap" aria-hidden="true">
            <span class="field__label">Flow (in L/min)</span>
          </span>
        </div>
        <br><br>
        <select name="combo2" id="combo2">
          <option selected value='0'>Speed (in m/s)</option>
          <option value="1">1</option>
          <option value="3">3</option>
          <option value="5">5</option>
        </select>
        <br><br>
        <div class="field field_v1">
          <label class="ha-screen-reader">Operating Pressure (bar)</label>
          <input type="number" step="0.01" name='text2' id="text2" class="field__input" placeholder="e.g. 3 bar">
          <span class="field__label-wrap" aria-hidden="true">
            <span class="field__label">Operating Pressure (bar)</span>
          </span>
        </div>
        <br><br>
        <div class="field field_v1">
          <label class="ha-screen-reader">Safety coefficient</label>
          <input type="number" step="0.01" name='text4' id="text4" value="3" class="field__input" placeholder="by default : 3">
          <span class="field__label-wrap" aria-hidden="true">
            <span class="field__label">Safety coefficient</span>
          </span>
        </div>
        <br><br>
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
          <button class="noselect green" type="submit" onclick="return validateForm()" name="button1">
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
        <br>
        <div class="middle">
        <button class="noselect blue" type="button" onclick="window.location.href='Module5_from_pipe.php'">
            <span class='longtext'>From a pipe</span>
            <span class="icon">
              <svg fill="#000000" height="30" width="30" viewBox="0 0 24 24" id="pipe-3" data-name="Line Color" xmlns="http://www.w3.org/2000/svg">
                <path id="primary" d="M5,14a4,4,0,0,1,4-4h6V3h4v7a4,4,0,0,1-4,4H9v7H5Z" style="fill: none; stroke: #ffffff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                <path id="secondary" d="M4,21h6M20,3H14" style="fill: none; stroke: #00BFFF; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
              </svg>
            </span>
          </button>
        </div>
      </form>

      <script>
        document.getElementById("combo1").addEventListener("change", function() {
          var selectedOption = this.options[this.selectedIndex];
          var admissibleStress = selectedOption.getAttribute("data-stress");
          document.getElementById("text3").value = admissibleStress;
        });

        function validateForm() {

          var admissible = document.getElementById("text3").value;
          var flow = document.getElementById("text1").value;
          var speed = document.getElementById("combo2").value;
          var pressure = document.getElementById("text2").value;
          var safety = document.getElementById("text4").value;
          if (!admissible || !flow || !speed || !pressure || !safety) {
            alert("Veuillez remplir tous les champs");
            return false;
          }
          return true;
        }
      </script>
    </div>
  </div>

</body>

</html>