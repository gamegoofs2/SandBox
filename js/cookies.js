function setcookie(usrName, value, expire) {
    //If an expiration date is provided.
    if(expire) {
        var date = new Date();
        date.setTime(date.getTime()+(expire*24*60*60*1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else {
        //No expiration supplied cookie deletes uppon leaving.
        var expires = "";
    }
    //Build cookie string
    document.cookie = usrName + "=" + escape(value) + expires + "; path=/";
}

function getCookie(name) {
    //If the any cookies have been set
    if(document.cookie.length>0) {
        c_start = document.cookie.indexOf(name + "=");
        if(c_start != -1) {
            c_start = c_start + name.length+1;
            c_end = document.cookie.indexOf(";", c_start);
            if(c_end==-1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

