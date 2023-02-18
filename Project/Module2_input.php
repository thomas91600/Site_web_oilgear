<!DOCTYPE html>

<head>
  <title>Oilgear - module 2</title>
  <link href="Style/accueil.css" rel="stylesheet" type="text/css" />
  <link href="Style/style_input.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" href="Images/Oilgear_icon.png" />
  <meta charset="utf-8" />
</head>

<body>
  <?php include("Header.php"); ?>

  <div class="page">
    <div class="display">
      <h1>Module 2 - Oil graphics</h1>
      <form action="Module2_graphic.php" method="post">
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
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
          echo "<select name=comboboxoil>";
          echo "<option selected value='0'>Select your oil</option>";
          while ($row = $result2->fetch_assoc()) {

            echo "<option value='" . $row['Name_fluid'] . "'required>" . $row['Name_fluid'] . "</option>";
          }
          echo "</select>";
        } else {
          echo "0 results";
        }

        $conn->close();
        ?>
        <br><br>
        <div class="middle">
          <label class="rad-label">
            <input type="radio" class="rad-input" id="radio1" name="options" value="1" onclick="showHideTextboxes(this)">
            <div class="rad-design"></div>
            <div class="rad-text">v = F(T)</div>
          </label>
          <label class="rad-label">
            <input type="radio" class="rad-input" id="radio2" name="options" value="2" onclick="showHideTextboxes(this)">
            <div class="rad-design"></div>
            <div class="rad-text">v = F(P)</div>
          </label>
        </div>

        <div class="rect" id="textboxes1" style="display:none">
          <label>v=f(T) with P constant with T=</label>
          <br><br>
          <div class="field field_v1">
            <label class="ha-screen-reader">T min (in °C)</label>
            <input type="number" step="0.01" name='min1' id='min1' class="field__input" placeholder="e.g. 40 °C">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">T min (in °C)</span>
            </span>
          </div>
          <label>to </label>
          <div class="field field_v1">
            <label class="ha-screen-reader">T max (in °C)</label>
            <input type="number" step="0.01" name='max1' id='max1' class="field__input" placeholder="e.g. 100 °C">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">T max (in °C)</span>
            </span>
          </div>
          <br>
          <label>for P equal to :
            <div class="field field_v1">
              <label class="ha-screen-reader">P (in bar)</label>
              <input type="number" step="0.01" name='P' id='P' class="field__input" placeholder="e.g. 3 bar">
              <span class="field__label-wrap" aria-hidden="true">
                <span class="field__label">P (in bar)</span>
              </span>
            </div>
        </div>

        <div class="rect" id="textboxes2" style="display:none">
          <label>v=f(P) with T constant with P=</label>
          <br><br>
          <div class="field field_v1">
            <label class="ha-screen-reader">P min (in bar)</label>
            <input type="number" step="0.01" name='min2' id='min2' class="field__input" placeholder="e.g. 3 bar">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">P min (in bar)</span>
            </span>
          </div>
          <label>to </label>
          <div class="field field_v1">
            <label class="ha-screen-reader">P max (in bar)</label>
            <input type="number" step="0.01" name='max2' id='max2' class="field__input" placeholder="e.g. 10 bar">
            <span class="field__label-wrap" aria-hidden="true">
              <span class="field__label">P max (in bar)</span>
            </span>
          </div>
          <br>
          <label>for T equal to :
            <div class="field field_v1">
              <label class="ha-screen-reader">T (in °C)</label>
              <input type="number" step="0.01" name='T' id='T' class="field__input" placeholder="e.g. 40 °C">
              <span class="field__label-wrap" aria-hidden="true">
                <span class="field__label">T (in °C)</span>
              </span>
            </div>
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
            <span class='longtext'>Create graph</span>
            <span class="icon">
              <svg fill="#000000" height="30" width="30" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.00 512.00" enable-background="new 0 0 512 512" xml:space="preserve">
                <path d="M256,0C114.609,0,0,114.609,0,256s114.609,256,256,256s256-114.609,256-256S397.391,0,256,0z M256,472 c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"></path>
                <path d="M352,128c-17.625,0-32,14.344-32,32c0,11.938,6.641,22.25,16.375,27.75L306,288.188c-0.656-0.047-1.312-0.188-2-0.188 c-5.391,0-10.406,1.469-14.875,3.859l-35.781-39.172C255.031,248.781,256,244.5,256,240c0-17.656-14.344-32-32-32s-32,14.344-32,32 c0,8.672,3.5,16.516,9.109,22.281l-33.859,58.609C164.906,320.375,162.5,320,160,320c-17.656,0-32,14.375-32,32s14.344,32,32,32 s32-14.375,32-32c0-9.375-4.125-17.75-10.594-23.625l33.438-57.875c2.906,0.875,5.969,1.5,9.156,1.5 c7.266,0,13.891-2.531,19.266-6.625l33.953,37.203C273.938,307.609,272,313.562,272,320c0,17.625,14.359,32,32,32 c17.625,0,32-14.375,32-32c0-11.312-5.906-21.188-14.781-26.875l30.562-101.156c0.078,0,0.125,0.031,0.219,0.031 c17.625,0,32-14.344,32-32S369.625,128,352,128z M160,368c-8.844,0-16-7.141-16-16s7.156-16,16-16s16,7.141,16,16 S168.844,368,160,368z M224,256c-8.844,0-16-7.156-16-16s7.156-16,16-16s16,7.156,16,16S232.844,256,224,256z M304,336 c-8.859,0-16-7.141-16-16s7.141-16,16-16s16,7.141,16,16S312.859,336,304,336z M352,176c-8.859,0-16-7.156-16-16s7.141-16,16-16 s16,7.156,16,16S360.859,176,352,176z"></path>
              </svg>
            </span>
          </button>
        </div>
        <br><br>
        </form>
        <form action="Multi_graph.php" method="post">
        <label>Number of fluid to compare : </label>
        <div class="field field_v1">
          <label class="ha-screen-reader">Number of fluid</label>
          <input type="number" step="1" name='number' id='number' class="field__input" placeholder="from 2 to 4">
          <span class="field__label-wrap" aria-hidden="true">
            <span class="field__label">Number of fluid</span>
          </span>
        </div>
        <br><br>
        <div class="middle">
          <button class="noselect blue" type="submit" name="button_multi">
            <span class='longtext'>Multi graph</span>
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4,11H13v3a1,1,0,0,1-2,0V13H8a1,1,0,0,1,0-2h3V8a1,1,0,0,1,2,0v3h3a1,1,0,0,1,0,2Z" />
              </svg>
            </span>
          </button>
        </div>
      </form>
     

      <script>
        function showHideTextboxes(radio) {
          if (radio.id == "radio1") {
            document.getElementById("textboxes1").style.display = "block";
            document.getElementById("textboxes2").style.display = "none";
            document.getElementById("min1").value = "";
            document.getElementById("max1").value = "";
            document.getElementById("P").value = "";
          } else if (radio.id == "radio2") {
            document.getElementById("textboxes1").style.display = "none";
            document.getElementById("textboxes2").style.display = "block";
            document.getElementById("min2").value = "";
            document.getElementById("max2").value = "";
            document.getElementById("T").value = "";
          }
        }

        function validateForm() {
          var radio = document.querySelector('input[name="options"]:checked');
          if (!radio) {
            alert("Veuillez choisir un type de graphique.");
            return false;
          }
          if (radio.id == "radio1") {
            var min1 = document.getElementById("min1").value;
            var max1 = document.getElementById("max1").value;
            var P = document.getElementById("P").value;
            if (!min1 || !max1 || !P) {
              alert("Veuillez remplir tous les champs");
              return false;
            }
            return true;
          } else if (radio.id == "radio2") {
            var min2 = document.getElementById("min2").value;
            var max2 = document.getElementById("max2").value;
            var T = document.getElementById("T").value;
            if (!min2 || !max2 || !T) {
              alert("Veuillez remplir tous les champs");
              return false;
            }
            return true;
          }
        }
      </script>
    </div>
  </div>

</body>

</html>