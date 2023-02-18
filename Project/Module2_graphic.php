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

  <div class="section">
    <div class="page max">
      <div class="display">
        <h1>Module 2 - Oil graphics</h1>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <canvas id="graph"></canvas>

        <?php
        // Récupération de la valeur sélectionnée
        $selectedValue = $_POST['comboboxoil'];
        $check = $_POST["options"];
        if ($check == 1) {
          $min = $_POST["min1"];
          $max = $_POST["max1"];
          $var = $_POST["P"];
        } else {
          $min = $_POST["min2"];
          $max = $_POST["max2"];
          $var = $_POST["T"];
        }

        // Connexion à la base de données
        $servername = "sql7.freesqldatabase.com";
        $username = "sql7596246";
        $password = "HWEBqf5tTT";
        $dbname = "sql7596246";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Requête SQL pour récupérer les données correspondant à la valeur sélectionnée
        $sql = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='" . $selectedValue . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $t_a = $row["TempA_C"];
            $t_b = $row["TempB_C"];
            $v_a = $row["Va_cst"];
            $v_b = $row["Vb_cst"];
          }
        } else {
          echo "0 results";
        }
        $conn->close();
        ?>

        <script>
          function creategraph() {
            var name = "<?php echo $selectedValue; ?>";
            var min = "<?php echo $min; ?>";
            var max = "<?php echo $max; ?>";
            var variable = "<?php echo $var; ?>";
            var check = "<?php echo $check; ?>";
            var v_a = "<?php echo $v_a; ?>";
            var v_b = "<?php echo $v_b; ?>";
            var t_a = "<?php echo $t_a; ?>" * 1.8 + 32 + 459.67;
            var t_b = "<?php echo $t_b; ?>" * 1.8 + 32 + 459.67;
            document.write("<div class='rect'>");
            document.write("Oil selected :   " + name + "<br>");
            if (check == "1") {
              document.write("Minimum Temperature : " + min + " °C<br>");
              document.write("Maximum Temperature : " + max + " °C<br>");
              document.write("Constant Pressure : " + variable + " bar<br>");
            } else if (check == "2") {
              document.write("Minimum Pressure : " + min + " bar<br>");
              document.write("Maximum Pressure : " + max + " bar<br>");
              document.write("Constant Temperature : " + variable + " °C<br>");
            }
            document.write("</div>");

            var data = [];
            var temp;
            var j = 0;
            if (check == "1") {
              // Créer le graphique
              var ctx = document.getElementById('graph').getContext('2d');
              var temperature = 0;

              // Calculer les constantes
              var consA = (Math.log10(Math.log10(v_b)) - Math.log10(Math.log10(v_a))) / (Math.log10(t_b) - Math.log10(t_a));
              var consB = Math.log10(Math.log10(v_a)) - (consA * Math.log10(t_a));
              // Initialiser un tableau pour stocker les données du graphique
              for (temp = min; temp <= max; temp++) {
                j++;
                temperature = 0;
                temperature = (j + min * 1 - 1) * 1.8 + 32 + 459.67;
                var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));
                var visco = Math.exp(Math.log(10) * (variable / 1000) * (0.0239 + 0.01638 * (visco_t ** 0.278)) + Math.log(visco_t));
                data.push({
                  x: temp,
                  y: visco
                });
              }
              var chart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: data.map(function(i) {
                    return i.x
                  }),
                  datasets: [{
                    label: 'Viscosity',
                    data: data.map(function(i) {
                      return i.y
                    }),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                  }]
                },
                options: {
                  title: {
                    display: true,
                    text: 'Evolution of the viscosity for the oil ' + name + ' as function of temperature with pressure equal to ' + variable + ' bar'
                  },
                  scales: {
                    xAxes: [{
                      scaleLabel: {
                        display: true,
                        labelString: 'Time (units)'
                      }
                    }],
                    yAxes: [{
                      scaleLabel: {
                        display: true,
                        labelString: 'Viscosity (units)'
                      },
                      beginAtZero: true
                    }]
                  }
                }
              });
            } else if (check == 2) {
              var ctx = document.getElementById('graph').getContext('2d');
              nbpressure = max - min + 1;
              temperature = variable * 1.8 + 32 + 459.67;
              var consA = (Math.log10(Math.log10(v_b)) - Math.log10(Math.log10(v_a))) / (Math.log10(t_b) - Math.log10(t_a));
              var consB = Math.log10(Math.log10(v_a)) - ((Math.log10(Math.log10(v_b)) - Math.log10(Math.log10(v_a))) / (Math.log10(t_b) - Math.log10(t_a))) * Math.log10(t_a);
              var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

              for (temp = min; temp <= max; temp++) {
                j++;
                var visco = Math.exp(Math.log(10) * ((j + min * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
                data.push({
                  x: temp,
                  y: visco
                });
              }
              var chart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: data.map(function(i) {
                    return i.x
                  }),
                  datasets: [{
                    label: 'Viscosity',
                    data: data.map(function(i) {
                      return i.y
                    }),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                  }]
                },
                options: {
                  title: {
                    display: true,
                    text: 'Evolution of the viscosity for the oil ' + name + ' as function of pressure with temperature equal to ' + variable + ' °C'
                  },
                  scales: {
                    xAxes: [{
                      scaleLabel: {
                        display: true,
                        labelString: 'Time (units)'
                      }
                    }],
                    yAxes: [{
                      scaleLabel: {
                        display: true,
                        labelString: 'Viscosity (units)'
                      },
                      beginAtZero: true
                    }]
                  }
                }
              });
            }
          }
          creategraph();
        </script>
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
        </div>
      </div>
    </div>
  </div>
</body>

</html>