function setCookie(cname, cvalue, exdays) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function getqteById(id) {
    let prds_and_qtes = getCookie("cart").split(", ");
    for(let i=0;i<prds_and_qtes.length;i++) {
        let pid = prds_and_qtes[i].substr(1, prds_and_qtes[i].length-2).split(",")[0];
        if(pid == id) {
            return prds_and_qtes[i].substr(1, prds_and_qtes[i].length-2).split(",")[1];
        }
    }

    return -1;
}