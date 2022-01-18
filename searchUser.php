<?php 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Search For A User</title>
        <link rel="stylesheet" href="css/searchUser.css" />
    </head>
    <body background= "images/old.jpg">
        <script>
                function searchUser(str) {
                    if (str == "") {
                        document.getElementById("userInfo").innerHTML = "";
                        return;
                    } else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("userInfo").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET","getUser.php?users="+str,true);
                        xmlhttp.send();
                    }
                }

                function showUser(str) {
                        var xmlhttp2 = new XMLHttpRequest();
                        xmlhttp2.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("infoDisplay").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp2.open("GET","displayUser.php?users="+str,true);
                        xmlhttp2.send();
                    }


            </script>
        <div class="infoDisplay" id = "infoDisplay">
            <form>
                <label>Search by name: </label><input type="text" id="users" name="users" onchange="searchUser(this.value)">
            </form>


                <h1 name = "userInfo" id = "userInfo"></h1>
                
        </div>
    </body>
</html>