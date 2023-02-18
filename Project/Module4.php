<!DOCTYPE html>

NATURE OF THE FLUID TO HEAT <br><br>
<select name="combo1" id="combo1" onclick="showHideComboBox()">
<option selected value='0'>Select a type of fluid</option>
<option value="Water based fluids">Water based fluids</option>
<option value="Oil fluids">Oil fluids</option>
</select>
<br><br>
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

$sql2 = "SELECT * FROM fluid_data_water";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
echo "<select name=combo3 id=combo3 style='display:none'>";
echo "<option selected value='0'>Select your oil</option>";
while ($row = $result2->fetch_assoc()) {
echo "<option value='" . $row['FluideEauGlacelf']
    . "' data-densite='" . $row['Density']
    . "' data-specific_heat='" . $row['Specific_heat']
    . "' data-kinematic_viscosity='" . $row['Kinematic_viscosity']
    . "' data-thermal_conductivity='" . $row['Thermal_conductivity']
    . "'required>" . $row['FluideEauGlacelf'] . "</option>";
    }
echo "</select>";
} else {
echo "0 results";
}

$conn->close();
?>

<input type="checkbox" id="cb1" onclick="showHideNotReference()">
<label for="cb1">The reference is not in the database</label>
<div id="textboxes" style="display:none;">
 ρ <input type="text" placeholder=""> kg.m-3<br><br>
 Cp <input type="text" placeholder=""> J.kg-1.K-1<br><br>
 h <input type="text" placeholder=""> W.m-2.K-1
</div>
<br><br>

HEATING CONDITIONS
<br><br>
Initial fluid temperature: <input type="text" placeholder=""> °C <br><br>
Final fluid temperature: <input type="text" placeholder=""> °C <br><br>
Desired heating time: <input type="text" placeholder=""> h <br><br>
% of fluid in reservoir (Std: 75%): <input type="text" placeholder="75"> % 
<br><br>

HEAT LOSS
<br><br>
External temperature: <input type="text" placeholder=""> °C <br><br>
Insulation thickness: <input type="text" placeholder=""> mm <br><br>
<input type="checkbox" id="cb2" onclick="showHideBoat()">
<label for="cb2">Boat</label>
<div id="textboxes1" style="display:none;">
Hull thickness (Std: 10 mm): <input type="text" placeholder="10"> mm <br><br>
Sea temperature: <input type="text" placeholder=""> °C<br><br>
</div>
<br><br>
RESERVOIR CHARACTERISTICS
<br><br>
Reservoir : 
<select name="reservoir" id="reservoir" onclick="showHideOtherMaterials()">
  <option value="option1">Aluminium</option>
  <option value="option2">Steel</option>
  <option value="option3">Stainless Steel</option>
  <option value="option4">Other Materials</option>
</select>

<div id="other-materials-container" style="display:none;">
  <br>
  ρ <input type="text" name="other-material-1" id="other-material-1"> kg.m-3<br><br>
  Cp <input type="text" name="other-material-2" id="other-material-2"> J.kg-1.K-1<br><br>
  λ <input type="text" name="other-material-3" id="other-material-3"> W.m-2.K-1<br><br>
</div><br><br>
Reservoir wall thickness (Std: 20 mm): <input type="text" placeholder="20"> mm <br><br>

Reservoir shape :
<select name="reservoir_shape" id="reservoir_shape" onclick="showImage()">
  <option value="cylindrical">Cylindrical</option>
  <option value="rectangular">Rectangular</option>
  <option value="200L">Standard 200 L</option>
  <option value="400L">Standard 400 L</option>
  <option value="1000L">Standard 1000 L</option>
  <option value="2000L">Standard 2000 L</option>
  <option value="5000L">Standard 5000 L</option>
</select>
<br><br>
<img id="image">
<br><br>
External reservoir <br><br>
L <input type="text" name="L" id="L"> 
 x W <input type="text" name="W" id="W">
 x H <input type="text" name="H" id="H"> mm
<br><br>

<button type="submit" name="button1">
<span class='text'>Calculate</span>


<script>
    function showHideComboBox() {
    if (document.getElementById("combo1").value == "0") {
    document.getElementById("combo2").style.display = "none";
    document.getElementById("combo3").style.display = "none";
    }
    if (document.getElementById("combo1").value == "Oil fluids") {
    document.getElementById("combo2").style.display = "block";
    document.getElementById("combo3").style.display = "none";
    document.getElementById("cb1").checked = false;
    textboxes.style.display = "none";
    }
    if (document.getElementById("combo1").value == "Water based fluids") {
    document.getElementById("combo3").style.display = "block";
    document.getElementById("combo2").style.display = "none";
    document.getElementById("cb1").checked = false;
    textboxes.style.display = "none";
    }
    }

    function showHideNotReference() {
    var checkbox = document.getElementById("cb1");
    var textboxes = document.getElementById("textboxes");

    checkbox.addEventListener("change", function() {
      if (checkbox.checked) {
        textboxes.style.display = "block";
        document.getElementById("combo2").style.display = "none";
        document.getElementById("combo3").style.display = "none";
      } else {
        textboxes.style.display = "none";
      }
    });
  }

  function showHideBoat() {
    var checkbox = document.getElementById("cb2");
    var textboxes = document.getElementById("textboxes1");

    checkbox.addEventListener("change", function() {
      if (checkbox.checked) {
        textboxes.style.display = "block";
      } else {
        textboxes.style.display = "none";
      }
    });
  }

  function showHideOtherMaterials(){
    document.getElementById("reservoir").addEventListener("change", function() {
  if (this.value === "option4") {
    document.getElementById("other-materials-container").style.display = "block";
  } else {
    document.getElementById("other-materials-container").style.display = "none";
  }
});
  }

  function showImage(){
    document.getElementById("reservoir_shape").addEventListener("change", function(){
  var selectedOption = this.value;
  var imageElement = document.getElementById("image");
  var checkbox = document.getElementById("cb2");
  switch(selectedOption){
    case "cylindrical":
        if (checkbox.checked) {
        imageElement.src = "Images/Cylinder_Boat.jpg";
      } else {
        imageElement.src = "Images/Cylinder.jpg";
      }
      break;
    case "rectangular":
        if (checkbox.checked) {
            imageElement.src = "Images/Cube_Boat.jpg";
      } else {
        imageElement.src = "Images/Cube.jpg";
      }
      break;
    case "200L":
        if (checkbox.checked) {
            imageElement.src = "Images/Cube_Boat.jpg";
      } else {
        imageElement.src = "Images/Cube.jpg";
      }
      break;
    case "400L":
        if (checkbox.checked) {
            imageElement.src = "Images/Cube_Boat.jpg";
      } else {
        imageElement.src = "Images/Cube.jpg";
      }
      break;
    case "1000L":
        if (checkbox.checked) {
            imageElement.src = "Images/Cube_Boat.jpg";
      } else {
        imageElement.src = "Images/Cube.jpg";
      }
      break;
    case "2000L":
        if (checkbox.checked) {
            imageElement.src = "Images/Cube_Boat.jpg";
      } else {
        imageElement.src = "Images/Cube.jpg";
      }
      break;
    case "5000L":
        if (checkbox.checked) {
            imageElement.src = "Images/Cube_Boat.jpg";
      } else {
        imageElement.src = "Images/Cube.jpg";
      }
      break;
    default:
      imageElement.src = "";
  }
});
  }
</script>

</html>