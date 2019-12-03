<?php
// Initialize the session
session_start();

// Include config file
require_once( dirname(__FILE__) . '/dmap-config.php' );

// Render Home page
$page_title = "Home";
include(ABSPATH . 'dmap-includes/head.php');
?>
    <!-- Home Form -->
    <div class="container" style="padding-top: 5vh;">
      <div class="row">
        <div class="col-12 col-md-3">
        </div>
        <div class="col-12 col-md-6">

          <div>
            <section class = "search-section">
              <div>
                <section id="prompt">
                  <p id="prompt-content">
                    Please wait while the application is loading.
                    <noscript>
                    <br><em>JavaScrpt is required to use this application. This <a href="https://www.enable-javascript.com/" rel="noreferrer" target="_blank">article</a> may help you to enable JavaScript.</em>
                    </noscript>
                  </p>
                </section>
                <div id = "campus">
                  <select class = "search-bar" id = "campuses" onchange = "showMajor()">
                    <option selected value disabled>Loading...</option>
                    <option value = "qc">Queens College</option>
                  </select>
                </div>
                <br>
                <div id = "major" style = "display: none;">
                  <div>
                    <select class = "search-bar" id = "majors" onchange = "showTerm()">
                      <option selected value disabled>Loading...</option>
                      <option value = "cs">Computer Science</option>
                      <option value = "math">Math</option>
                    </select>
                  </div>
                </div>
                <br>
                <div id = "term" style = "display: none;">
                  <div>
                    <select class = "search-bar" id = "terms" onchange = "showResult()">
                      <option selected value disabled>Select</option>
                      <option value = "201901">Spring 2019</option>
                      <option value = "201902">Fall 2019</option>
                    </select>
                  </div>
                </div>
              </div>
              <br></br>
            </section>

            <div id = "result" style = "display: none">
              <table class = "resultTable">
                <tr>
                  <th>Freshman</th>
                </tr>
                <tr id = "majorFreshman"></tr>
              </table>
              <br></br>
              <table class = "resultTable">
                <tr>
                  <th>Sophomore</th>
                </tr>
                <tr id = "majorSophomore"></tr>
              </table>
              <br></br>
              <table class = "resultTable">
                <tr>
                  <th>Junior</th>
                </tr>
                <tr id = "majorJunior"></tr>
              </table>
              <br></br>
              <table class = "resultTable">
                <tr>
                  <th>Senior</th>
                </tr>
                <tr id = "majorSenior"></tr>
              </table>
            </div>
          </div>

        </div>
        <div class="col-12 col-md-3">
        </div>
      </div>
    </div>
    <br><br>
    <hr>

    <!-- Footer -->
    <footer>
      <div class="container-fluid text-center">
        <div class="row">
          <div class="col-12 col-md-2">
          </div>
          <div class="col-12 col-md-8">
            <span class="text-center">
              &copy; 2019 The Degree Maps Authors.
              <a href="https://github.com/cunymap" target="_blank">GitHub</a>
            </span>
          </div>
          <div class="col-12 col-md-2">
          </div>
        </div>
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Custom JavsScript-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/dark-theme.js"></script>
    <script src="assets/js/course-ajax.js"></script>
    <script>
      function showMajor() {
         document.getElementById("major").style.display = "block";
         document.getElementById("term").style.display = "block";
         document.getElementById("result").style.display = "none";
         document.getElementById("prompt-content").innerHTML = "Choose your major.";
      }
      function showTerm() {
         document.getElementById("term").style.display = "block";
         document.getElementById("result").style.display = "none";
         document.getElementById("prompt-content").innerHTML = "Choose your start term to see result.";
      }
      function showResult() {
        document.getElementById("prompt-content").innerHTML = "The map is listed below:";
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
    </script>
  </body>
</html>
