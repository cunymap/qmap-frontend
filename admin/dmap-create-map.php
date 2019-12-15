<?php
// Initialize the session
session_start();

// Include config file
require_once( dirname(__FILE__) . '/../dmap-config.php' );

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: dmap-login.php");
    exit;
}

// Load admin info
$id = trim($_SESSION["id"]);
$username = trim($_SESSION["username"]);
$institute_id = trim($_SESSION["institute_id"]);

// Render Create Map page
$page_title = "Create Map - Admin";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <div class="container" id="main-content">
      <div class="row">
        <div class="col-12">
          <div class="page-header">
              <h1 class="text-center">Create a Map</h1>
              <p class="text-center">
                These are all the required fields needed from client to create a map in the database.<br>
                Some fields are user inputs and some are provided with the admin account.
              </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3"></div>
        <div class="col-12 col-md-6">

          <form id="createMapForm">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label class="sr-only" for="map_name">Map Name</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                  </div>
                  <input type="text" id="map_name" placeholder="Map Name" required>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label class="sr-only" for="degree">Degree</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-book-open"></i></div>
                  </div>
                  <input type="text" id="degree" placeholder="Degree" required>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label class="sr-only" for="start_year">Start Year</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                  </div>
                  <input type="text" id="start_year" placeholder="Start Year" required>
                </div>
                <small class="form-text text-muted">Format: SP YYYY for spring, or FA YYYY for fall.</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="institute_id">Institute</label>
                <select id = "institute_id">
                  <option selected value disabled>Loading...</option>
                  <option value = "17">Queens College</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="submit_id">Submitter ID</label>
                <input id="submit_id" type="text" value="<?php echo $id ?>" disabled />
              </div>
            </div>

            <!--display for path-->
            <div class="container">
              <div id="add-path-disp" class="table-response-xl">
                <table class="table table-bordered">
                  <thead>
                    <th class="text-center">First Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem1');">
                    </th>
                    <th class="text-center">Second Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem2');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id ="sem1"></td>
                    <td class="text-center" id ="sem2"></td>
                  </tr>
                  <thead>
                    <th class="text-center">Third Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem3');">
                    </th>
                    <th class="text-center">Fourth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem4');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id="sem3"></td>
                    <td class="text-center" id="sem4"></td>
                  </tr>
                  <thead>
                    <th class="text-center">Fifth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem5');">
                    </th>
                    <th class="text-center">Sixth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem6');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id="sem5"></td>
                    <td class="text-center" id="sem6"></td>
                  </tr>
                  <thead>
                    <th class="text-center">Seventh Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem7');">
                    </th>
                    <th class="text-center">Eighth Semester
                      <input type = "button" value = "Add class" onClick = "addClass('sem8');">
                    </th>
                  </thead>
                  <tr>
                    <td class="text-center" id="sem7"></td>
                    <td class="text-center" id="sem8"></td>
                  </tr>
                </table>
                <div class="text-center">
                  <input id="submitButton"  type="submit" value="Create Map" />
                </div>
              </div>
            </div>

          </form>

        </div>
        <div class="col-12 col-md-3"></div>
      </div>


    </div>
<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>

<?php if (trim($_SESSION["institute_id"]) == 0): ?>
  <script type="text/javascript">
    $(document).ready(function() {
      loadCampuses("institute_id");
    });
  </script>
<?php else: ?>
  <script type="text/javascript">
    $(document).ready(function() {
      loadSpecificCampus("institute_id", <?php echo $institute_id ?>);
    });
  </script>
<?php endif ?>

<script>
      var hostname = "https://cs355map.herokuapp.com" //"http://127.0.0.1:8000"
      var endpoint = "/api/map/"

      $("#submitButton").click(function(event){
        event.preventDefault();
      });
      $('#submitButton').on('click',function(){
          $.ajax({
              url: hostname + endpoint,
              type: 'POST',
              data: {
                  map_name: $('#map_name').val(),
                  degree: $('#degree').val(),
                  start_year: $('#start_year').val(),
                  institute_id: $('#institute_id').val(),
                  submit_id: $('#submit_id').val(),
                  sem1_class1: $('#sem1_class1').val(),
                  sem1_class2: $('#sem1_class2').val(),
                  sem1_class3: $('#sem1_class3').val(),
                  sem1_class4: $('#sem1_class4').val(),
                  sem1_class5: $('#sem1_class5').val(),
                  sem1_class6: $('#sem1_class6').val(),
                  sem1_class7: $('#sem1_class7').val(),
                  sem2_class1: $('#sem2_class1').val(),
                  sem2_class2: $('#sem2_class2').val(),
                  sem2_class3: $('#sem2_class3').val(),
                  sem2_class4: $('#sem2_class4').val(),
                  sem2_class5: $('#sem2_class5').val(),
                  sem2_class6: $('#sem2_class6').val(),
                  sem2_class7: $('#sem2_class7').val(),
                  sem3_class1: $('#sem3_class1').val(),
                  sem3_class2: $('#sem3_class2').val(),
                  sem3_class3: $('#sem3_class3').val(),
                  sem3_class4: $('#sem3_class4').val(),
                  sem3_class5: $('#sem3_class5').val(),
                  sem3_class6: $('#sem3_class6').val(),
                  sem3_class7: $('#sem3_class7').val(),
                  sem3_class1: $('#sem3_class1').val(),
                  sem3_class2: $('#sem3_class2').val(),
                  sem3_class3: $('#sem3_class3').val(),
                  sem3_class4: $('#sem3_class4').val(),
                  sem3_class5: $('#sem3_class5').val(),
                  sem3_class6: $('#sem3_class6').val(),
                  sem3_class7: $('#sem3_class7').val(),
                  sem4_class1: $('#sem4_class1').val(),
                  sem4_class2: $('#sem4_class2').val(),
                  sem4_class3: $('#sem4_class3').val(),
                  sem4_class4: $('#sem4_class4').val(),
                  sem4_class5: $('#sem4_class5').val(),
                  sem4_class6: $('#sem4_class6').val(),
                  sem4_class7: $('#sem4_class7').val(),
                  sem5_class1: $('#sem5_class1').val(),
                  sem5_class2: $('#sem5_class2').val(),
                  sem5_class3: $('#sem5_class3').val(),
                  sem5_class4: $('#sem5_class4').val(),
                  sem5_class5: $('#sem5_class5').val(),
                  sem5_class6: $('#sem5_class6').val(),
                  sem5_class7: $('#sem5_class7').val(),
                  sem6_class1: $('#sem6_class1').val(),
                  sem6_class2: $('#sem6_class2').val(),
                  sem6_class3: $('#sem6_class3').val(),
                  sem6_class4: $('#sem6_class4').val(),
                  sem6_class5: $('#sem6_class5').val(),
                  sem6_class6: $('#sem6_class6').val(),
                  sem6_class7: $('#sem6_class7').val(),
                  sem7_class1: $('#sem7_class1').val(),
                  sem7_class2: $('#sem7_class2').val(),
                  sem7_class3: $('#sem7_class3').val(),
                  sem7_class4: $('#sem7_class4').val(),
                  sem7_class5: $('#sem7_class5').val(),
                  sem7_class6: $('#sem7_class6').val(),
                  sem7_class7: $('#sem7_class7').val(),
                  sem8_class1: $('#sem8_class1').val(),
                  sem8_class2: $('#sem8_class2').val(),
                  sem8_class3: $('#sem8_class3').val(),
                  sem8_class4: $('#sem8_class4').val(),
                  sem8_class5: $('#sem8_class5').val(),
                  sem8_class6: $('#sem8_class6').val(),
                  sem8_class7: $('#sem8_class7').val(),
              },
              contentType: 'application/x-www-form-urlencoded',
              async: false,
              success: function(data) {
                  alert("Map created. See console log for details.");
                  console.log(data);
              },
              error: function(e){
                  alert('Error: ' + e);
              }
          });
      });


/*validating that form inputs are not empty... in progress still for the Classes
  Additionally, not sure where to call from because of the submit button
*/
      function validateForm(){

        if(document.getElementById("map_name").value==""||
            document.getElementById("degrees").value=="degrees" ||
            document.getElementById("start_year").value==""){

              document.getElementById("formFeedback").innerHTML="Incomplete Inputs";
              return false;
        }
        return true;
      }

//Adds class input fields in table based off add class button
      function addClass(element)
      {
        var semester = document.getElementById(element);

        var x = (semester.childElementCount/2) ;
        var classNum = x + 1;
        var field;
        if(classNum>8)
        {
          return;
        }
        else if(classNum == 8 )
        {
          var x = document.createElement("BR");
          field = document.createTextNode("Max number of Classes reached");
        }
        else
        {
        var x = document.createElement("BR");
        field = newClassField(element,classNum);
        }
        semester.appendChild(field);
        semester.appendChild(x);
      }

      function newClassField(semester,classNum)
      {
        var field = document.createElement("INPUT");
        field.setAttribute("type", "text");
        field.placeholder = "Enter Class";
        field.id = semester + "_class" + classNum ;
        return field;
      }
</script>
