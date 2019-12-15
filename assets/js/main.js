
function showMajor() {
         document.getElementById("major").style.display = "block";
         document.getElementById("prompt1").style.display = "none";
         document.getElementById("prompt2").style.display = "block";
      }
      function showTerm() {
         document.getElementById("term").style.display = "block";
         document.getElementById("prompt2").style.display = "none";
         document.getElementById("prompt3").style.display = "block";
      }
      function showResult() {
         document.getElementById("prompt3").style.display = "none";
         document.getElementById("result").style.display = "block";
         var major = document.getElementById("majors");
         var majorResult = major.options[major.selectedIndex].text;
         var term = document.getElementById("terms");
         var termResult = term.options[term.selectedIndex].text;
         document.getElementById("majorFreshman").innerHTML = "Welcome to " + majorResult + " " + termResult;
         document.getElementById("majorSophomore").innerHTML = "Welcome to " + majorResult + " " + termResult;
         document.getElementById("majorJunior").innerHTML = "Welcome to " + majorResult + " " + termResult;
         document.getElementById("majorSenior").innerHTML = "Welcome to " + majorResult + " " + termResult;
      }

// initialize Bootstrap tooltip
$( document ).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

// Define Backend URL
// Compatibility: const was introduced in ECMAScript 2015
const backendAPIURL = "https://qmap-backend.herokuapp.com/";


/**
 * Summary: loadCampuses loads a institute_id - Campus Name list from Backend to
 * the specified select-option dropdown.
 * @param  {string} id The id of Select element the function should inject options within.
 * @return {void}
 */
function loadCampuses(id) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    console.log("Loading campus list...");
    if (this.readyState == 4 && this.status == 200) {
      var campusesObject = JSON.parse(this.responseText);
      var campusesHTML = "<option selected value disabled>Select</option>";
      // start from 1 because 0 is "All Institutions"
      for (var i = 1; i < campusesObject.length; i++) {
        var campusHTML = "<option value=\"" + campusesObject[i].institute_id + "\">" + campusesObject[i].descr + "</option>";
        campusesHTML += campusHTML;
        console.log("Loading campus: " + campusesObject[i].institute_id + " " + campusesObject[i].descr);
      }
      document.getElementById(id).innerHTML = campusesHTML;
      console.log("Campus list ready and loadeded to #" + id);
    }
  };
  var APIcampusURL = backendAPIURL + "api/campuses/?format=json";
  xmlhttp.open("GET", APIcampusURL, true);
  xmlhttp.send();
}

/**
 * Summary: loadSpecificCampus functions like loadCampuses(id), but only loads one campus.
 * @param  {string} id The id of Select element the function should inject options within.
 * @param  {string} i_id The institute_id the function should load.
 * @return {void}
 */
function loadSpecificCampus(id, i_id) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    console.log("Loading campus list...");
    if (this.readyState == 4 && this.status == 200) {
      var campusesObject = JSON.parse(this.responseText);
      var campusHTML = "<option selected value=\"" + campusesObject[i_id].institute_id + "\">" + campusesObject[i_id].descr + "</option>";
      console.log("Loading campus: " + campusesObject[i_id].institute_id + " " + campusesObject[i_id].descr);
      }
      document.getElementById(id).innerHTML = campusHTML;
      console.log("Campus list ready and loadeded to #" + id);
    };
  var APIcampusURL = backendAPIURL + "api/campuses/?format=json";
  xmlhttp.open("GET", APIcampusURL, true);
  xmlhttp.send();
}
