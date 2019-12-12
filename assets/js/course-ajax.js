// load campus list
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
    document.getElementById("campuses").innerHTML = campusesHTML;
    console.log("Campus list Ready");
  }
};
var APIcampusURL = "https://cs355map.herokuapp.com/api/campuses/?format=json";
xmlhttp.open("GET", APIcampusURL, true);
xmlhttp.send();

// load major list
$('#campuses').on('change', function() {
  document.getElementById("majors").innerHTML = "<option selected value disabled>Loading...</option>";
  document.getElementById("major").style.display = "block";
  document.getElementById("term").style.display = "none";
  var APImajorURL = "https://cs355map.herokuapp.com/api/degrees/";
  var campus = $("#campuses").val();
  APImajorURL += campus + "/?format=json";

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    console.log("Loading major list for " + campus + "...");
    if (this.readyState == 4 && this.status == 200) {
      var majorsObject = JSON.parse(this.responseText);
      var majorsHTML = "<option selected value disabled>Select</option>";
      for (var i = 0; i < majorsObject.length; i++) {
        var majorHTML = "<option value=\"" + majorsObject[i].degree + "\">" + majorsObject[i].degree_descr + ", " + majorsObject[i].level_descr + "</option>";
        majorsHTML += majorHTML;
        console.log("Loading major: " + majorsObject[i].degree);
      }
      document.getElementById("majors").innerHTML = majorsHTML;
      console.log("Major list Ready");
    }
  };
  xmlhttp.open("GET", APImajorURL, true);
  xmlhttp.send();
});

// load term list
$('#majors').on('change', function() {
  document.getElementById("result").style.display = "none";
  var APItermURL = "https://cs355map.herokuapp.com/api/map/?id=";
  var campus = $("#campuses").val();
  var camp = document.getElementById("campuses");
  var campResult = camp.options[camp.selectedIndex].text;
  var major = document.getElementById("majors");
  var majorResult = major.options[major.selectedIndex].text;
  var maj_arr = majorResult.split(" , ");
  var maj = maj_arr[0].split(" ");
  var majURL = maj[0];
  for (var x = 1; x < maj.length; x++) {
    majURL += "+" + maj[x];
  }
  APItermURL += campus + "&major=" +majURL;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    console.log("Loading major list for " + terms + "...");
    if (this.readyState == 4 && this.status == 404) {
      document.getElementById("prompt-content").innerHTML = "Maps are not available for " + campResult + ", " + majorResult + ". Contact your school advisor.";
    }
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("prompt-content").innerHTML = "Choose your start term to see result.";
      document.getElementById("terms").innerHTML = "<option selected value disabled>Loading...</option>";
      document.getElementById("term").style.display = "block";
      var termsObject = JSON.parse(this.responseText);
      var termsHTML = "<option selected value disabled>Select</option>";
      for (var i = 0; i < termsObject.length; i++) {
        var termHTML = "<option value=\"" + termsObject[i].map_id + "\">" + termsObject[i].start_year + "</option>";
        termsHTML += termHTML;
        console.log("Loading terms: " + termsObject[i].start_year);
      }
      document.getElementById("terms").innerHTML = termsHTML;
      console.log("Term list Ready");
    }
  };
  xmlhttp.open("GET", APItermURL, true);
  xmlhttp.send();
});

//load result
$('#terms').on('change', function() {
  document.getElementById("prompt-content").style.display = "none";
  
  var APImapURL = "https://cs355map.herokuapp.com/api/map/";
  var map_id = $("#terms").val();
  APImapURL += map_id + "/?format=json";
         
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 404){
      document.getElementById("result-display").innerHTML = "No matching maps are found. Contact your school advisor.";
    }
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("result-display").innerHTML = "The map is listed below:";
      document.getElementById("result").style.display = "block";
      var mapObject = JSON.parse(this.responseText);
      var term = document.getElementById("terms");
      var termResult = term.options[term.selectedIndex].text;
      var startTerm = termResult.split(" ");
      var sem = startTerm[0];
      var year = parseInt(startTerm[1]);
      if (sem == "Spring") {
        document.getElementById("semester_one").innerHTML += "Spring " + String(year);
        document.getElementById("semester_two").innerHTML += "Fall " + String(year);
        document.getElementById("semester_three").innerHTML += "Spring " + String(year + 1);
        document.getElementById("semester_four").innerHTML += "Fall " + String(year + 1);
        document.getElementById("semester_five").innerHTML += "Spring " + String(year + 2);
        document.getElementById("semester_six").innerHTML += "Fall " + String(year + 2);
        document.getElementById("semester_seven").innerHTML += "Spring " + String(year + 3);
        document.getElementById("semester_eight").innerHTML += "Fall " + String(year + 3);
      } 
      if (sem == "Fall") {
        document.getElementById("semester_one").innerHTML += "Fall " + String(year);
        document.getElementById("semester_two").innerHTML += "Spring " + String(year + 1);
        document.getElementById("semester_three").innerHTML += "Fall " + String(year + 1);
        document.getElementById("semester_four").innerHTML += "Spring " + String(year + 2);
        document.getElementById("semester_five").innerHTML += "Fall " + String(year + 2);
        document.getElementById("semester_six").innerHTML += "Spring " + String(year + 3);
        document.getElementById("semester_seven").innerHTML += "Fall " + String(year + 3);
        document.getElementById("semester_eight").innerHTML += "Spring " + String(year + 4);
      }
      var semester_one = "<tr><th></th><th></th></tr>";
      var semester_two = "<tr><th></th><th></th></tr>";
      var semester_three = "<tr><th></th><th></th></tr>";
      var semester_four = "<tr><th></th><th></th></tr>";
      var semester_five = "<tr><th></th><th></th></tr>";
      var semester_six = "<tr><th></th><th></th></tr>";
      var semester_seven = "<tr><th></th><th></th></tr>";
      var semester_eight = "<tr><th></th><th></th></tr>";
      for (var i = 0; i < mapObject.length; i++) {
        var map = "<tr><td>" + mapObject[i].descr + "</td><td>" + mapObject[i].max_units + " Credits</td></tr>";
        if (mapObject[i].semester_num  == "1") {
          semester_one += map;
        }
        if (mapObject[i].semester_num == "2") {
          semester_two += map;
        }
        if (mapObject[i].semester_num  == "3") {
          semester_three += map;
        }
        if (mapObject[i].semester_num  == "4") {
          semester_four += map;
        }
        if (mapObject[i].semester_num  == "5") {
          semester_five += map;
        }
        if (mapObject[i].semester_num  == "6") {
          semester_six += map;
        }
        if (mapObject[i].semester_num  == "7") {
          semester_seven += map;
        }
        if (mapObject[i].semester_num  == "8") {
          semester_eight += map;
        }
      }
      document.getElementById("map_one").innerHTML = semester_one;
      document.getElementById("map_two").innerHTML = semester_two;
      document.getElementById("map_three").innerHTML = semester_three;
      document.getElementById("map_four").innerHTML = semester_four;
      document.getElementById("map_five").innerHTML = semester_five;
      document.getElementById("map_six").innerHTML = semester_six;
      document.getElementById("map_seven").innerHTML = semester_seven;
      document.getElementById("map_eight").innerHTML = semester_eight;
    }
  };
  xmlhttp.open("GET", APImapURL, true);
  xmlhttp.send();
});


$(document).ready(function() {
  $("#prompt-content").text("Choose your campus to continue.");
});
