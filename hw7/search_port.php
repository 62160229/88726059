<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>
  <style>
body  {
    background-image: url("");
}

</style>

<center><font color ="red"><h1>ค้นหาเพลง</h1>
<input type="text" id="kw">
<select id="typ">
<option value="1">รายเดือน</option>
    <option value="2">รายปี</option>
    <option value="3">ตลอดชีพ</option>
<?php
    // connect database 
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "123456";
    $db_name = "searchsong";

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    // check connection error 
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } else {
        // connect success, do nothing
        // echo "Connect success.";
      
    }
    $sql = "SELECT *
            FROM song
            WHERE NameSong LIKE '%$kw%' OR Artist_Name LIKE '%$kw%'OR Lyrics LIKE '%$kw%'";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_object()) {
        echo "<option value='$row->id'>$row->name</option>";
        
    }

?></center></font>
</select>
<button onclick="search()"class="btn btn-lg btn-warning">ค้นหา</button>
<h5><div id="disp"></div><h5>
<h3><center><form method="post" action="search.html">
        <input type="submit"class="btn btn-danger"  value="Search">
</form></center></h3>
<script>
    function search() {
        kw = document.getElementById('kw').value;
        typ = document.getElementById('typ').value;
        console.log("kw=" + kw);
        console.log("typ=" + typ);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById('disp').innerHTML = this.responseText;
                arr = JSON.parse(this.responseText);
                console.log(arr);
                if (arr.length == 0) {
                    document.getElementById('disp').innerHTML = "Not found";
                } else {
                    html = "";
                    for (i = 0; i < arr.length; i++) {
                        html += arr[i].NameSong +"<br>"+ arr[i].Artist_Name  +"<br>"+ arr[i].Lyrics+"<br>"+"<br>"+"<br>";
                    }
                    document.getElementById('disp').innerHTML = html;
                }
            }
        }
        parameters = "kw=" + kw + "&typ=" + typ;
        xmlhttp.open("post", "search.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(parameters);
    }
    
</script>
    
<div class="container">
        <img src="https://c.min.ms/t/d/member/c/101/101894/pagegallery/1611571013/16d72144.jpg" class="img-circle" alt="Cinque Terre" width="304" height="320">
</div>

</body>
</html>








<!-- <form method="post" action="search.php">
    <input type="text" name="kw" id="kw">
    <input type="submit" value="Search">
</form> -->