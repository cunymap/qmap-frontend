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
    <div class="container" id="main-content">
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
                    <br><em>JavaScrpt is required to use this application. This <a href="https://www.enable-javascript.com/" rel="noreferrer" target="_blank" style="text-decoration: underline;">article</a> may help you to enable JavaScript.</em>
                    </noscript>
                  </p>
                </section>
                <div id = "campus">
                  <select class = "search-bar" id = "campuses">
                      <option selected value disabled>Loading...</option>
                  </select>
                </div>
                <br>
                <div id = "major" style = "display: none;">
                  <div>
                    <select class = "search-bar" id = "majors">
                      <option selected value disabled>Loading...</option>
                    </select>
                  </div>
                </div>
                <br>
                <div id = "term" style = "display: none;">
                  <div>
                    <select class = "search-bar" id = "terms">
                      <option selected value disabled>Loading...</option>
                    </select>
                  </div>
                </div>
              </div>
              <br></br>
            </section>

            <br>
            <p id = "result-display" style = "color: #007bff; font-size: 1.4em;"></p>
            <div id = "result" style = "display: none;">
              <h3 id = "semester_one"></h3>
              <table id = "map_one"></table>
              <br>
              <h3 id = "semester_two"></h3>
              <table id = "map_two"></table>
              <br>
              <h3 id = "semester_three"></h3>
              <table id = "map_three"></table>
              <br>
              <h3 id = "semester_four"></h3>
              <table id = "map_four"></table>
              <br>
              <h3 id = "semester_five"></h3>
              <table id = "map_five"></table>
              <br>
              <h3 id = "semester_six"></h3>
              <table id = "map_six"></table>
              <br>
              <h3 id = "semester_seven"></h3>
              <table id = "map_seven"></table>
              <br>
              <h3 id = "semester_eight"></h3>
              <table id = "map_eight"></table>
            </div>
          </div>

        </div>
        <div class="col-12 col-md-3">
        </div>
      </div>
    </div>
    <br><br>
    <hr>

<?php
include(ABSPATH . 'dmap-includes/foot.php');
?>
<script src="assets/js/course-ajax.js"></script>
