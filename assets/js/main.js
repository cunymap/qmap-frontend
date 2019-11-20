/*function for enabling other selects when the required one is selected'*/
function myFunction() {
  document.getElementById("majors").disabled = false;
  document.getElementById("terms").disabled = false;
}
/*function to show the result according to the selection*/
function showResult() {
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
