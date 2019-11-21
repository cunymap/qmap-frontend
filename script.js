//function called immediately to popuate term dropdown
populateTerm();

//Should run when the document is ready
//attempted Ajax; currently no success
$(document).ready(function() {
  $.ajax({
    type: "GET",
    url: "http://qmap-backend.herokuapp.com/api/degrees/qns01/",
    success: function(data) {
      helpers.buildDropdown(
        jQuery.parseJSON(data),
        $('#major-dropdown'),
        'Choose A Major'
      );
    }
  });
});

//function will populate #term-dropdown
function populateTerm() {
  var dt = new Date();
  var year = dt.getYear() + 1900;
  var month = dt.getMonth();
  var start = 2;

  if (month < 7) start = 1;

  for (i = 0; i < 8; i++) {
    if (start == 1) {
      addOption("Spring " + year);
      start = 2;
    } else {

      addOption("Fall " + year);
      start = 1;
      year += 1;
    }
  }
}

//This function adds a whatever is in the parameters into term-dropdown
function addOption(choice) {

  var x = document.getElementById("term-dropdown");
  var option = document.createElement("option");
  option.text = choice;
  x.add(option);
}

//This function shows the home page for admin
function returnHome() {
  document.getElementById('add-section').hidden = true;
  document.getElementById('options').hidden = false;
  document.getElementById('back-button').hidden = true;
  document.getElementById('delete-section').hidden = true;
}
//This function shows the add path
function showAddSection() {
  document.getElementById('options').hidden = true;
  document.getElementById('back-button').hidden = false;
  document.getElementById('add-section').hidden = false;
}

//This function shows the delete Path
function showDeletePath() {
  document.getElementById('options').hidden = true;
  document.getElementById('back-button').hidden = false;
  document.getElementById('delete-section').hidden = false;
}



//Ajax attempt #6974. Found online. works with other ajax func. No sucess yet
var helpers = {
  buildDropdown: function(result, dropdown, emptyMessage) {

    dropdown.html('');
    // Add the empty option with the empty message
    dropdown.append('<option value="">' + emptyMessage + '</option>');
    // Check result isnt empty
    if (result != '') {
      // Loop through each of the results and append the option to the dropdown

      $.each(result, function(k, v) {
        dropdown.append('<option value="' + v.degree_long_descr + '">' + v.degree_long_descr + '</option>');
      });
    }
  }
}
