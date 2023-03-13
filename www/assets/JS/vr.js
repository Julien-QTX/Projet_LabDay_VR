/*let vrTests = navigator.xr

console.log(vrTests.isSessionSupported("immersive-vr").then())

vrTests.requestSession("immersive-vr")*/

/*userButton = document.getElementsByTagName('button')[0]

if (navigator.xr) {
    navigator.xr.isSessionSupported('immersive-vr')
    .then((isSupported) => {
      if (isSupported) {
        userButton.addEventListener('click', onButtonClicked);
        userButton.textContent = 'Enter XR';
        userButton.disabled = false;
      }
    });
  }
  
  function onButtonClicked() {
    if (!xrSession) {
      navigator.xr.requestSession('immersive-vr')
      .then((session) => {
        xrSession = session;
        // onSessionStarted() not shown for reasons of brevity and clarity.
        onSessionStarted(xrSession);
      });
    } else {
      // Button is a toggle button.
      xrSession.end();
    }
  }*/


  navigator.xr
  .requestSession("immersive-vr")
  .then((xrSession) => {
    xrSession.addEventListener("end", onXRSessionEnded);
    // Do necessary session setup here.
    // Begin the session's animation loop.
    xrSession.requestAnimationFrame(onXRAnimationFrame);
  })
  .catch((error) => {
    // "immersive-vr" sessions are not supported
    console.error(
      "'immersive-vr' isn't supported, or an error occurred activating VR!"
    );
  });