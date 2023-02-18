<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<canvas id="graph"></canvas>

<form>
  <?php

  $value = isset($_POST["value"]) ? $_POST["value"] : "";
  echo $value;

  for ($i = 0; $i < $value; $i++) {
    ${"name$i"} = isset($_POST["comboboxoil$i"]) ? $_POST["comboboxoil$i"] : "";
    ${"min$i"} = isset($_POST["min$i"]) ? $_POST["min$i"] : "";
    ${"max$i"} = isset($_POST["max$i"]) ? $_POST["max$i"] : "";
    ${"choice$i"} = isset($_POST["choix$i"]) ? $_POST["choix$i"] : "";
    ${"var$i"} = isset($_POST["var$i"]) ? $_POST["var$i"] : "";
  }

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

  if ($value == 1) {
    $sql = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name0'";
    $result0 = $conn->query($sql);
    if ($result0->num_rows > 0) {
      while ($row = $result0->fetch_assoc()) {
        // output data of each row
        $t_a0 = $row["TempA_C"];
        $t_b0 = $row["TempB_C"];
        $v_a0 = $row["Va_cst"];
        $v_b0 = $row["Vb_cst"];
      }
    }
  ?>
    <script>
      function creategraph() {
        var name0 = "<?php echo $name0; ?>";
        var min0 = "<?php echo $min0; ?>";
        var max0 = "<?php echo $max0; ?>";
        var check = "<?php echo $choice0; ?>";


        if (check == "v=f(T)") {
          var variable = "<?php echo $var0; ?>";
        } else if (check == "v=f(P)") {
          var variable = "<?php echo $var0; ?>";
        }


        var v_a0 = "<?php echo $v_a0; ?>";
        var v_b0 = "<?php echo $v_b0; ?>";
        var t_a0 = "<?php echo $t_a0; ?>" * 1.8 + 32 + 459.67;
        var t_b0 = "<?php echo $t_b0; ?>" * 1.8 + 32 + 459.67;


        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name0 + "<br>");
        if (check == "v=f(T)") {
          document.write("Minimum Temperature : " + min0 + " °C<br>");
          document.write("Maximum Temperature : " + max0 + " °C<br>");
          document.write("Constant Pressure : " + variable + " bar<br>");
        } else if (check == "v=f(P)") {
          document.write("Minimum Pressure : " + min0 + " bar<br>");
          document.write("Maximum Pressure : " + max0 + " bar<br>");
          document.write("Constant Temperature : " + variable + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;
        if (check == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph').getContext('2d');

          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - (consA * Math.log10(t_a0));

          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min0; temp <= max0; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min0 * 1 - 1) * 1.8 + 32 + 459.67;
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of temperature with pressure equal to ' + variable + ' bar'
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
        } else if (check == "v=f(P)") {
          var ctx = document.getElementById('graph').getContext('2d');
          nbpressure = max0 - min0 + 1;
          temperature = variable * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - ((Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0))) * Math.log10(t_a0);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min0; temp <= max0; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min0 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of pressure with temperature equal to ' + variable + ' °C'
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







  <?php
  } else if ($value == 2) {
    $sql = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name0'";
    $sql1 = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name1'";
    $result0 = $conn->query($sql);
    if ($result0->num_rows > 0) {
      while ($row = $result0->fetch_assoc()) {
        // output data of each row
        $t_a0 = $row["TempA_C"];
        $t_b0 = $row["TempB_C"];
        $v_a0 = $row["Va_cst"];
        $v_b0 = $row["Vb_cst"];
      }
    }
  ?>
    <script>
      function creategraph() {
        var name0 = "<?php echo $name0; ?>";
        var min0 = "<?php echo $min0; ?>";
        var max0 = "<?php echo $max0; ?>";
        var check = "<?php echo $choice0; ?>";

        if (check == "v=f(T)") {
          var variable = "<?php echo $var0; ?>";
        } else if (check == "v=f(P)") {
          var variable = "<?php echo $var0; ?>";
        }
        var v_a0 = "<?php echo $v_a0; ?>";
        var v_b0 = "<?php echo $v_b0; ?>";
        var t_a0 = "<?php echo $t_a0; ?>" * 1.8 + 32 + 459.67;
        var t_b0 = "<?php echo $t_b0; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name0 + "<br>");
        if (check == "v=f(T)") {
          document.write("Minimum Temperature : " + min0 + " °C<br>");
          document.write("Maximum Temperature : " + max0 + " °C<br>");
          document.write("Constant Pressure : " + variable + " bar<br>");
        } else if (check == "v=f(P)") {
          document.write("Minimum Pressure : " + min0 + " bar<br>");
          document.write("Maximum Pressure : " + max0 + " bar<br>");
          document.write("Constant Temperature : " + variable + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;
        if (check == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph').getContext('2d');

          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - (consA * Math.log10(t_a0));
          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min0; temp <= max0; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min0 * 1 - 1) * 1.8 + 32 + 459.67;
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of temperature with pressure equal to ' + variable + ' bar'
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
        } else if (check == "v=f(P)") {
          var ctx = document.getElementById('graph').getContext('2d');
          nbpressure = max0 - min0 + 1;
          temperature = variable * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - ((Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0))) * Math.log10(t_a0);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min0; temp <= max0; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min0 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of pressure with temperature equal to ' + variable + ' °C'
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

    <?php
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
      while ($row = $result1->fetch_assoc()) {
        // output data of each row
        $t_a1 = $row["TempA_C"];
        $t_b1 = $row["TempB_C"];
        $v_a1 = $row["Va_cst"];
        $v_b1 = $row["Vb_cst"];
      }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <canvas id="graph1"></canvas>
    <script>
      function creategraph() {
        var name1 = "<?php echo $name1; ?>";
        var min1 = "<?php echo $min1; ?>";
        var max1 = "<?php echo $max1; ?>";
        var check1 = "<?php echo $choice1; ?>";

        if (check1 == "v=f(T)") {
          var variable1 = "<?php echo $var1; ?>";
        } else if (check1 == "v=f(P)") {
          var variable1 = "<?php echo $var1; ?>";
        }

        var v_a1 = "<?php echo $v_a1; ?>";
        var v_b1 = "<?php echo $v_b1; ?>";
        var t_a1 = "<?php echo $t_a1; ?>" * 1.8 + 32 + 459.67;
        var t_b1 = "<?php echo $t_b1; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name1 + "<br>");
        if (check1 == "v=f(T)") {
          document.write("Minimum Temperature : " + min1 + " °C<br>");
          document.write("Maximum Temperature : " + max1 + " °C<br>");
          document.write("Constant Pressure : " + variable1 + " bar<br>");
        } else if (check1 == "v=f(P)") {
          document.write("Minimum Pressure : " + min1 + " bar<br>");
          document.write("Maximum Pressure : " + max1 + " bar<br>");
          document.write("Constant Temperature : " + variable1 + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;
        if (check1 == "v=f(T)") {

          // Créer le graphique
          var ctx = document.getElementById('graph1').getContext('2d');

          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1));
          var consB = Math.log10(Math.log10(v_a1)) - (consA * Math.log10(t_a1));
          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min1; temp <= max1; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min1 * 1 - 1) * 1.8 + 32 + 459.67;
            var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));
            var visco = Math.exp(Math.log(10) * (variable1 / 1000) * (0.0239 + 0.01638 * (visco_t ** 0.278)) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name1 + ' as function of temperature with pressure equal to ' + variable1 + ' bar'
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
        } else if (check1 == "v=f(P)") {
          var ctx = document.getElementById('graph1').getContext('2d');
          nbpressure = max1 - min1 + 1;
          temperature = variable1 * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1));
          var consB = Math.log10(Math.log10(v_a1)) - ((Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1))) * Math.log10(t_a1);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min1; temp <= max1; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min1 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name1 + ' as function of pressure with temperature equal to ' + variable1 + ' °C'
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
  <?php
  } else if ($value == 3) {
    $sql = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name0'";
    $sql1 = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name1'";
    $sql2 = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name2'";
    $result0 = $conn->query($sql);
    if ($result0->num_rows > 0) {
      while ($row = $result0->fetch_assoc()) {
        // output data of each row
        $t_a0 = $row["TempA_C"];
        $t_b0 = $row["TempB_C"];
        $v_a0 = $row["Va_cst"];
        $v_b0 = $row["Vb_cst"];
      }
    }
  ?>
    <script>
      function creategraph() {
        var name0 = "<?php echo $name0; ?>";
        var min0 = "<?php echo $min0; ?>";
        var max0 = "<?php echo $max0; ?>";
        var check = "<?php echo $choice0; ?>";


        if (check == "v=f(T)") {
          var variable = "<?php echo $var0; ?>";
        } else if (check == "v=f(P)") {
          var variable = "<?php echo $var0; ?>";
        }

        var v_a0 = "<?php echo $v_a0; ?>";
        var v_b0 = "<?php echo $v_b0; ?>";
        var t_a0 = "<?php echo $t_a0; ?>" * 1.8 + 32 + 459.67;
        var t_b0 = "<?php echo $t_b0; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name0 + "<br>");
        if (check == "v=f(T)") {
          document.write("Minimum Temperature : " + min0 + " °C<br>");
          document.write("Maximum Temperature : " + max0 + " °C<br>");
          document.write("Constant Pressure : " + variable + " bar<br>");
        } else if (check == "v=f(P)") {
          document.write("Minimum Pressure : " + min0 + " bar<br>");
          document.write("Maximum Pressure : " + max0 + " bar<br>");
          document.write("Constant Temperature : " + variable + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;
        if (check == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph').getContext('2d');

          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - (consA * Math.log10(t_a0));

          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min0; temp <= max0; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min0 * 1 - 1) * 1.8 + 32 + 459.67;
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of temperature with pressure equal to ' + variable + ' bar'
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
        } else if (check == "v=f(P)") {
          var ctx = document.getElementById('graph').getContext('2d');
          nbpressure = max0 - min0 + 1;
          temperature = variable * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - ((Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0))) * Math.log10(t_a0);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min0; temp <= max0; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min0 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of pressure with temperature equal to ' + variable + ' °C'
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

    <?php
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
      while ($row = $result1->fetch_assoc()) {
        // output data of each row
        $t_a1 = $row["TempA_C"];
        $t_b1 = $row["TempB_C"];
        $v_a1 = $row["Va_cst"];
        $v_b1 = $row["Vb_cst"];
      }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <canvas id="graph1"></canvas>
    <script>
      function creategraph() {
        var name1 = "<?php echo $name1; ?>";
        var min1 = "<?php echo $min1; ?>";
        var max1 = "<?php echo $max1; ?>";
        var check1 = "<?php echo $choice1; ?>";

        if (check1 == "v=f(T)") {
          var variable1 = "<?php echo $var1; ?>";
        } else if (check1 == "v=f(P)") {
          var variable1 = "<?php echo $var1; ?>";
        }


        var v_a1 = "<?php echo $v_a1; ?>";
        var v_b1 = "<?php echo $v_b1; ?>";
        var t_a1 = "<?php echo $t_a1; ?>" * 1.8 + 32 + 459.67;
        var t_b1 = "<?php echo $t_b1; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name1 + "<br>");
        if (check1 == "v=f(T)") {
          document.write("Minimum Temperature : " + min1 + " °C<br>");
          document.write("Maximum Temperature : " + max1 + " °C<br>");
          document.write("Constant Pressure : " + variable1 + " bar<br>");
        } else if (check1 == "v=f(P)") {
          document.write("Minimum Pressure : " + min1 + " bar<br>");
          document.write("Maximum Pressure : " + max1 + " bar<br>");
          document.write("Constant Temperature : " + variable1 + " °C<br>");
        }
        document.write("</div>");


        var data = [];
        var temp;
        var j = 0;
        if (check1 == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph1').getContext('2d');
          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1));
          var consB = Math.log10(Math.log10(v_a1)) - (consA * Math.log10(t_a1));
          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min1; temp <= max1; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min1 * 1 - 1) * 1.8 + 32 + 459.67;
            var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));
            var visco = Math.exp(Math.log(10) * (variable1 / 1000) * (0.0239 + 0.01638 * (visco_t ** 0.278)) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name1 + ' as function of temperature with pressure equal to ' + variable1 + ' bar'
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
        } else if (check1 == "v=f(P)") {
          var ctx = document.getElementById('graph1').getContext('2d');
          nbpressure = max1 - min1 + 1;
          temperature = variable1 * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1));
          var consB = Math.log10(Math.log10(v_a1)) - ((Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1))) * Math.log10(t_a1);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min1; temp <= max1; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min1 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name1 + ' as function of pressure with temperature equal to ' + variable1 + ' °C'
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
    <?php
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
      while ($row = $result2->fetch_assoc()) {
        // output data of each row
        $t_a2 = $row["TempA_C"];
        $t_b2 = $row["TempB_C"];
        $v_a2 = $row["Va_cst"];
        $v_b2 = $row["Vb_cst"];
      }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <canvas id="graph2"></canvas>
    <script>
      function creategraph() {
        var name2 = "<?php echo $name2; ?>";
        var min2 = "<?php echo $min2; ?>";
        var max2 = "<?php echo $max2; ?>";
        var check2 = "<?php echo $choice2; ?>";
        if (check2 == "v=f(T)") {
          var variable2 = "<?php echo $var2; ?>";
        } else if (check2 == "v=f(P)") {
          var variable2 = "<?php echo $var2; ?>";
        }

        var v_a2 = "<?php echo $v_a2; ?>";
        var v_b2 = "<?php echo $v_b2; ?>";
        var t_a2 = "<?php echo $t_a2; ?>" * 1.8 + 32 + 459.67;
        var t_b2 = "<?php echo $t_b2; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name2 + "<br>");
        if (check2 == "v=f(T)") {
          document.write("Minimum Temperature : " + min2 + " °C<br>");
          document.write("Maximum Temperature : " + max2 + " °C<br>");
          document.write("Constant Pressure : " + variable2 + " bar<br>");
        } else if (check2 == "v=f(P)") {
          document.write("Minimum Pressure : " + min2 + " bar<br>");
          document.write("Maximum Pressure : " + max2 + " bar<br>");
          document.write("Constant Temperature : " + variable2 + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;
        if (check2 == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph2').getContext('2d');
          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b2)) - Math.log10(Math.log10(v_a2))) / (Math.log10(t_b2) - Math.log10(t_a2));
          var consB = Math.log10(Math.log10(v_a2)) - (consA * Math.log10(t_a2));
          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min2; temp <= max2; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min2 * 1 - 1) * 1.8 + 32 + 459.67;
            var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));
            var visco = Math.exp(Math.log(10) * (variable2 / 1000) * (0.0239 + 0.01638 * (visco_t ** 0.278)) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name2 + ' as function of temperature with pressure equal to ' + variable2 + ' bar'
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
        } else if (check2 == "v=f(P)") {
          var ctx = document.getElementById('graph2').getContext('2d');
          nbpressure = max2 - min2 + 1;
          temperature = variable2 * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b2)) - Math.log10(Math.log10(v_a2))) / (Math.log10(t_b2) - Math.log10(t_a2));
          var consB = Math.log10(Math.log10(v_a2)) - ((Math.log10(Math.log10(v_b2)) - Math.log10(Math.log10(v_a2))) / (Math.log10(t_b2) - Math.log10(t_a2))) * Math.log10(t_a2);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min2; temp <= max2; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min2 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name2 + ' as function of pressure with temperature equal to ' + variable2 + ' °C'
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
  <?php
  } else if ($value == 4) {


    $sql = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name0'";
    $sql1 = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name1'";
    $sql2 = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name2'";
    $sql3 = "SELECT TempA_C, TempB_C, Va_cst, Vb_cst FROM fluid_data_oil WHERE Name_fluid='$name3'";
    $result0 = $conn->query($sql);
    if ($result0->num_rows > 0) {
      while ($row = $result0->fetch_assoc()) {
        // output data of each row
        $t_a0 = $row["TempA_C"];
        $t_b0 = $row["TempB_C"];
        $v_a0 = $row["Va_cst"];
        $v_b0 = $row["Vb_cst"];
      }
    }
  ?>
    <script>
      function creategraph() {
        var name0 = "<?php echo $name0; ?>";
        var min0 = "<?php echo $min0; ?>";
        var max0 = "<?php echo $max0; ?>";
        var check = "<?php echo $choice0; ?>";

        if (check == "v=f(T)") {
          var variable = "<?php echo $var0; ?>";
        } else if (check == "v=f(P)") {
          var variable = "<?php echo $var0; ?>";
        }

        var v_a0 = "<?php echo $v_a0; ?>";
        var v_b0 = "<?php echo $v_b0; ?>";
        var t_a0 = "<?php echo $t_a0; ?>" * 1.8 + 32 + 459.67;
        var t_b0 = "<?php echo $t_b0; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name0 + "<br>");
        if (check == "v=f(T)") {
          document.write("Minimum Temperature : " + min0 + " °C<br>");
          document.write("Maximum Temperature : " + max0 + " °C<br>");
          document.write("Constant Pressure : " + variable + " bar<br>");
        } else if (check == "v=f(P)") {
          document.write("Minimum Pressure : " + min0 + " bar<br>");
          document.write("Maximum Pressure : " + max0 + " bar<br>");
          document.write("Constant Temperature : " + variable + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;

        if (check == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph').getContext('2d');

          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - (consA * Math.log10(t_a0));

          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min0; temp <= max0; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min0 * 1 - 1) * 1.8 + 32 + 459.67;
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of temperature with pressure equal to ' + variable + ' bar'
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
        } else if (check == "v=f(P)") {
          var ctx = document.getElementById('graph').getContext('2d');
          nbpressure = max0 - min0 + 1;
          temperature = variable * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0));
          var consB = Math.log10(Math.log10(v_a0)) - ((Math.log10(Math.log10(v_b0)) - Math.log10(Math.log10(v_a0))) / (Math.log10(t_b0) - Math.log10(t_a0))) * Math.log10(t_a0);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min0; temp <= max0; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min0 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name0 + ' as function of pressure with temperature equal to ' + variable + ' °C'
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

    <?php
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
      while ($row = $result1->fetch_assoc()) {
        // output data of each row
        $t_a1 = $row["TempA_C"];
        $t_b1 = $row["TempB_C"];
        $v_a1 = $row["Va_cst"];
        $v_b1 = $row["Vb_cst"];
      }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <canvas id="graph1"></canvas>
    <script>
      function creategraph() {
        var name1 = "<?php echo $name1; ?>";
        var min1 = "<?php echo $min1; ?>";
        var max1 = "<?php echo $max1; ?>";
        var check1 = "<?php echo $choice1; ?>";
        if (check1 == "v=f(T)") {
          var variable1 = "<?php echo $var1; ?>";
        } else if (check1 == "v=f(P)") {
          var variable1 = "<?php echo $var1; ?>";
        }

        var v_a1 = "<?php echo $v_a1; ?>";
        var v_b1 = "<?php echo $v_b1; ?>";
        var t_a1 = "<?php echo $t_a1; ?>" * 1.8 + 32 + 459.67;
        var t_b1 = "<?php echo $t_b1; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name1 + "<br>");
        if (check1 == "v=f(T)") {
          document.write("Minimum Temperature : " + min1 + " °C<br>");
          document.write("Maximum Temperature : " + max1 + " °C<br>");
          document.write("Constant Pressure : " + variable1 + " bar<br>");
        } else if (check1 == "v=f(P)") {
          document.write("Minimum Pressure : " + min1 + " bar<br>");
          document.write("Maximum Pressure : " + max1 + " bar<br>");
          document.write("Constant Temperature : " + variable1 + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;
        if (check1 == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph1').getContext('2d');
          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1));
          var consB = Math.log10(Math.log10(v_a1)) - (consA * Math.log10(t_a1));
          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min1; temp <= max1; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min1 * 1 - 1) * 1.8 + 32 + 459.67;
            var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));
            var visco = Math.exp(Math.log(10) * (variable1 / 1000) * (0.0239 + 0.01638 * (visco_t ** 0.278)) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name1 + ' as function of temperature with pressure equal to ' + variable1 + ' bar'
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
        } else if (check1 == "v=f(P)") {
          var ctx = document.getElementById('graph1').getContext('2d');
          nbpressure = max1 - min1 + 1;
          temperature = variable1 * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1));
          var consB = Math.log10(Math.log10(v_a1)) - ((Math.log10(Math.log10(v_b1)) - Math.log10(Math.log10(v_a1))) / (Math.log10(t_b1) - Math.log10(t_a1))) * Math.log10(t_a1);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min1; temp <= max1; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min1 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name1 + ' as function of pressure with temperature equal to ' + variable1 + ' °C'
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
    <?php
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
      while ($row = $result2->fetch_assoc()) {
        // output data of each row
        $t_a2 = $row["TempA_C"];
        $t_b2 = $row["TempB_C"];
        $v_a2 = $row["Va_cst"];
        $v_b2 = $row["Vb_cst"];
      }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <canvas id="graph2"></canvas>
    <script>
      function creategraph() {
        var name2 = "<?php echo $name2; ?>";
        var min2 = "<?php echo $min2; ?>";
        var max2 = "<?php echo $max2; ?>";
        var check2 = "<?php echo $choice2; ?>";

        if (check2 == "v=f(T)") {
          var variable2 = "<?php echo $var2; ?>";
        } else if (check2 == "v=f(P)") {
          var variable2 = "<?php echo $var2; ?>";
        }

        var v_a2 = "<?php echo $v_a2; ?>";
        var v_b2 = "<?php echo $v_b2; ?>";
        var t_a2 = "<?php echo $t_a2; ?>" * 1.8 + 32 + 459.67;
        var t_b2 = "<?php echo $t_b2; ?>" * 1.8 + 32 + 459.67;

        document.write("<div class='rect'>");
        document.write("Oil selected :   " + name2 + "<br>");
        if (check2 == "v=f(T)") {
          document.write("Minimum Temperature : " + min2 + " °C<br>");
          document.write("Maximum Temperature : " + max2 + " °C<br>");
          document.write("Constant Pressure : " + variable2 + " bar<br>");
        } else if (check2 == "v=f(P)") {
          document.write("Minimum Pressure : " + min2 + " bar<br>");
          document.write("Maximum Pressure : " + max2 + " bar<br>");
          document.write("Constant Temperature : " + variable2 + " °C<br>");
        }
        document.write("</div>");

        var data = [];
        var temp;
        var j = 0;
        if (check2 == "v=f(T)") {
          // Créer le graphique
          var ctx = document.getElementById('graph2').getContext('2d');
          var temperature = 0;
          // Calculer les constantes
          var consA = (Math.log10(Math.log10(v_b2)) - Math.log10(Math.log10(v_a2))) / (Math.log10(t_b2) - Math.log10(t_a2));
          var consB = Math.log10(Math.log10(v_a2)) - (consA * Math.log10(t_a2));
          // Initialiser un tableau pour stocker les données du graphique
          for (temp = min2; temp <= max2; temp++) {
            j++;
            temperature = 0;
            temperature = (j + min2 * 1 - 1) * 1.8 + 32 + 459.67;
            var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));
            var visco = Math.exp(Math.log(10) * (variable2 / 1000) * (0.0239 + 0.01638 * (visco_t ** 0.278)) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name2 + ' as function of temperature with pressure equal to ' + variable2 + ' bar'
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
        } else if (check2 == "v=f(P)") {
          var ctx = document.getElementById('graph2').getContext('2d');
          nbpressure = max2 - min2 + 1;
          temperature = variable2 * 1.8 + 32 + 459.67;
          var consA = (Math.log10(Math.log10(v_b2)) - Math.log10(Math.log10(v_a2))) / (Math.log10(t_b2) - Math.log10(t_a2));
          var consB = Math.log10(Math.log10(v_a2)) - ((Math.log10(Math.log10(v_b2)) - Math.log10(Math.log10(v_a2))) / (Math.log10(t_b2) - Math.log10(t_a2))) * Math.log10(t_a2);
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

          for (temp = min2; temp <= max2; temp++) {
            j++;
            var visco = Math.exp(Math.log(10) * ((j + min2 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
                text: 'Evolution of the viscosity for the oil ' + name2 + ' as function of pressure with temperature equal to ' + variable2 + ' °C'
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

  <?php
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) {
      while ($row = $result3->fetch_assoc()) {
        // output data of each row
        $t_a3 = $row["TempA_C"];
        $t_b3 = $row["TempB_C"];
        $v_a3 = $row["Va_cst"];
        $v_b3 = $row["Vb_cst"];
      }
    }
  }
  ?>


  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  <canvas id="graph3"></canvas>
  <script>
    function creategraph() {
      var name3 = "<?php echo $name3; ?>";
      var min3 = "<?php echo $min3; ?>";
      var max3 = "<?php echo $max3; ?>";
      var check3 = "<?php echo $choice3; ?>";
      if (check3 == "v=f(T)") {
        var variable3 = "<?php echo $var3; ?>";
      } else if (check3 == "v=f(P)") {
        var variable3 = "<?php echo $var3; ?>";
      }

      var v_a3 = "<?php echo $v_a3; ?>";
      var v_b3 = "<?php echo $v_b3; ?>";
      var t_a3 = "<?php echo $t_a3; ?>" * 1.8 + 32 + 459.67;
      var t_b3 = "<?php echo $t_b3; ?>" * 1.8 + 32 + 459.67;

      document.write("<div class='rect'>");
      document.write("Oil selected :   " + name3 + "<br>");
      if (check3 == "v=f(T)") {
        document.write("Minimum Temperature : " + min3 + " °C<br>");
        document.write("Maximum Temperature : " + max3 + " °C<br>");
        document.write("Constant Pressure : " + variable3 + " bar<br>");
      } else if (check3 == "v=f(P)") {
        document.write("Minimum Pressure : " + min3 + " bar<br>");
        document.write("Maximum Pressure : " + max3 + " bar<br>");
        document.write("Constant Temperature : " + variable3 + " °C<br>");
      }
      document.write("</div>");


      var data = [];
      var temp;
      var j = 0;
      if (check3 == "v=f(T)") {

        // Créer le graphique
        var ctx = document.getElementById('graph3').getContext('2d');
        var temperature = 0;
        // Calculer les constantes
        var consA = (Math.log10(Math.log10(v_b3)) - Math.log10(Math.log10(v_a3))) / (Math.log10(t_b3) - Math.log10(t_a3));
        var consB = Math.log10(Math.log10(v_a3)) - (consA * Math.log10(t_a3));
        // Initialiser un tableau pour stocker les données du graphique
        for (temp = min3; temp <= max3; temp++) {
          j++;
          temperature = 0;
          temperature = (j + min3 * 1 - 1) * 1.8 + 32 + 459.67;
          var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));
          var visco = Math.exp(Math.log(10) * (variable3 / 1000) * (0.0239 + 0.01638 * (visco_t ** 0.278)) + Math.log(visco_t));
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
              text: 'Evolution of the viscosity for the oil ' + name3 + ' as function of temperature with pressure equal to ' + variable3 + ' bar'
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
      } else if (check3 == "v=f(P)") {
        var ctx = document.getElementById('graph3').getContext('2d');
        nbpressure = max3 - min3 + 1;
        temperature = variable3 * 1.8 + 32 + 459.67;
        var consA = (Math.log10(Math.log10(v_b3)) - Math.log10(Math.log10(v_a3))) / (Math.log10(t_b3) - Math.log10(t_a3));
        var consB = Math.log10(Math.log10(v_a3)) - ((Math.log10(Math.log10(v_b3)) - Math.log10(Math.log10(v_a3))) / (Math.log10(t_b3) - Math.log10(t_a3))) * Math.log10(t_a3);
        var visco_t = Math.exp(Math.log(10) * Math.exp(Math.log(10) * (consA * Math.log10(temperature) + consB)));

        for (temp = min3; temp <= max3; temp++) {
          j++;
          var visco = Math.exp(Math.log(10) * ((j + min3 * 1 - 1) / 1000) * (0.0239 + 0.01638 * (Math.pow(visco_t, 0.278))) + Math.log(visco_t));
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
              text: 'Evolution of the viscosity for the oil ' + name3 + ' as function of pressure with temperature equal to ' + variable3 + ' °C'
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

</form>

</html>