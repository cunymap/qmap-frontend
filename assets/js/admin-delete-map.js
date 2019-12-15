function askAgain()
{
  var btn = document.getElementById("delete_btn");
  btn.value = "Confirm Deletion";
}
function validate()
{
    if (document.getElementById("map_id").value == "");
    {
        document.getElementById("output").innerHTML="Empty Input";
        return false;
    }
    return true;
}

document.getElementById("searchButton").addEventListener("click", loadMap);
$("#searchButton").click(function(event){
  event.preventDefault();
});

function loadMap()
{
  document.getElementById("delete_btn").hidden = true;
  var idField = document.getElementById("map_id");
  var APIIdURL = backendURL;
  APIIdURL += "/api/map/";
  var id = idField.value;
  APIIdURL += id + "/?format=json";

  refreshTable();
  var xmlhttp = new XMLHttpRequest();
  console.log(xmlhttp);
  xmlhttp.onreadystatechange = function() {
    console.log("Loading degree list for " + id + "...");

    if (this.readyState == 4 && this.status == 200) {
      var idsObject = JSON.parse(this.responseText);
      document.getElementById("output").innerHTML = "";

      for (var i = 0; i < idsObject.length; i++) {
        var tile = "sem" + idsObject[i].semester_num;
        var text = document.createTextNode(idsObject[i].subject + " " + idsObject[i].catalog + " -- " + idsObject[i].descr);
        var br = document.createElement("br");
        console.log(tile);
        document.getElementById(tile).appendChild(text);
        document.getElementById(tile).appendChild(br);
        document.getElementById("delete_btn").hidden = false;
      }

    }
    else {
      document.getElementById("output").innerHTML = "Path ID does not exist";
    }

};
xmlhttp.open("GET", APIIdURL, true);
xmlhttp.send();
}

function refreshTable()
{
  for(var i = 1; i<=8; i++)
  {
      document.getElementById("output").innerHTML = "";
      document.getElementById("sem" + i).innerHTML = "";
  }
}
