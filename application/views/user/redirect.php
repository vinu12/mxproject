<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
<script>
function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

      // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }

    if (/android/i.test(userAgent)) {
        return "Android";
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }

    return "unknown";
}</script>

<script>
function DetectAndServe(){

if (getMobileOperatingSystem() == "Android") {
    window.location.href = "https://play.google.com/store/apps/details?id=com.asts.aina"; 
    }
if (getMobileOperatingSystem() == "iOS") {
    window.location.href = "https://itunes.apple.com/in/app/aina/id1403243007?ls=1&mt=8";
    }
if (getMobileOperatingSystem() == "Windows Phone") {
    window.location.href = "https://play.google.com/store/apps/details?id=com.asts.aina";
    }
if (getMobileOperatingSystem() == "unknown") {
  window.location.href = "https://play.google.com/store/apps/details?id=com.asts.aina";}
};
</script>
</head>
<body onload="DetectAndServe()">
</body>
