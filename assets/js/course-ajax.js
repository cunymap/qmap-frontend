// load campus list
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  console.log("Loading campus list...");
  if (this.readyState == 4 && this.status == 200) {
    var campusesObject = JSON.parse(this.responseText);
    var campusesHTML = "<option selected value disabled>Select</option>";
    // start from 1 because 0 is "All Institutions"
    for (var i = 1; i < campusesObject.length; i++) {
      var campusHTML = "<option value=\"" + campusesObject[i].code + "\">" + campusesObject[i].descr + "</option>";
      campusesHTML += campusHTML;
      console.log("Loading campus: " + campusesObject[i].code + " " + campusesObject[i].descr);
    }
    document.getElementById("campuses").innerHTML = campusesHTML;
    console.log("Campus list Ready");
  }
};
var APIcampusURL = "https://cs355web.herokuapp.com/api/campuses/?format=json";
xmlhttp.open("GET", APIcampusURL, true);
xmlhttp.send();

// load major list
$('#campuses').on('change', function() {
  document.getElementById("majors").innerHTML = "<option selected value disabled>Loading...</option>";
  document.getElementById("major").style.display = "block";
  document.getElementById("term").style.display = "none";
  var APImajorURL = "https://cs355web.herokuapp.com/api/degrees/";
  var campus = $("#campuses").val();
  APImajorURL += campus + "/?format=json";

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    console.log("Loading major list for " + campus + "...");
    if (this.readyState == 4 && this.status == 200) {
      var majorsObject = JSON.parse(this.responseText);
      var majorsHTML = "<option selected value disabled>Select</option>";
      for (var i = 0; i < majorsObject.length; i++) {
        var majorHTML = "<option value=\"" + majorsObject[i].acad_plan + "\">" + majorsObject[i].degree_long_descr + " " + majorsObject[i].degree_descr + "</option>";
        majorsHTML += majorHTML;
        console.log("Loading major: " + majorsObject[i].acad_plan);
      }
      document.getElementById("majors").innerHTML = majorsHTML;
      console.log("Major list Ready");
    }
  };
  xmlhttp.open("GET", APImajorURL, true);
  xmlhttp.send();
});

// load term list
$('#terms').on('change', function() {
  console.log("Term AJAX to be implemented...");
});

$(document).ready(function() {
  $("#prompt-content").text("Choose your campus to continue.");
});
