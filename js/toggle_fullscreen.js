// JavaScript Document

/* Get the documentElement (<html>) to display the page in fullscreen */
var elem = document.documentElement;


//function toggleFullScreen() {
//  if (!document.fullscreenElement) {
//    openFullscreen();
//    // closeIcon()
//  } else {
//    closeFullscreen();
//    // openIcon()
//  }
//}


/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}

//function closeIcon() {
//  document.querySelector("#fullscreen i").innerHTML = "fullscreen_exit";
//}
//
//function openIcon() {
//  document.querySelector("#fullscreen i").innerHTML = "fullscreen";
//}
//
//
//document.onfullscreenchange = function ( event ) {
//  if (document.fullscreenElement) {
//    // openFullscreen();
//    closeIcon()
//  } else {
//    // closeFullscreen();
//    openIcon()
//  }
//};

