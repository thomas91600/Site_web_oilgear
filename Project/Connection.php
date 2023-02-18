<!DOCTYPE html>

<body>
            <div class="field field_v1">
              <label class="ha-screen-reader">Password :</label>
              <input type="text" id='password' class="field__input" >
            </div>
    <button class="noselect green" type="submit" onclick="validateForm()" name="button1">   
        <span class='longtext'>Connection</span>
    </button> 


<script>
        function validateForm() {
          var password = document.getElementById("password").value;
          if (password == "toto") {
            window.location.assign("http://localhost/Oilgear/Project/Add_fluid_input.php");
          } else
          {
            window.location.assign("http://localhost/Oilgear/Project/Accueil.php");
          }
        }
</script>

</body>

</html>