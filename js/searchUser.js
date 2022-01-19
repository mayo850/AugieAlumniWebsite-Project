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