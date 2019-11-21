
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
