var hostname = backendURL;
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
