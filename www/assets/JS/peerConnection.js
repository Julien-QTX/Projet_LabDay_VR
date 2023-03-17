let APP_ID  = "3de2def185854a95bc99de2294eb2522";

let token = null;
let uid = String(Math.floor(Math.random() * 10000));

let client;
let channel;

let queryString = window.location.search;
let urlParams = new URLSearchParams(queryString)
let roomId = urlParams.get('room')

if (!roomId) {
    window.location = '/?page=lobby'
}

let localStream;
let remoteStream;
let peerConnection;

const servers = {
    iceServers:[
        {
            urls:['stun:stun1.1.google.com.19302', 'stun:stun2.1.google.com.19302']
        }
    ]
}

let constraints = {
    video: {
        width:{min:640, ideal:1920, max:1920},
        height:{min:480, ideal:1080, max:1080}
    },
    audio: true
}

let background = urlParams.get('background')

let validBackgrounds = ["default", "contact", "egypt", "checkerboard", "forest", "goaland", "yavapai", "goldmine", "threetowers", "poison", "arches", "tron", "japan", "dream", "volcano", "starry", "osiris", "moon"]

if (!validBackgrounds.includes(background)) {
    console.error("background not in list")
    environment.setAttribute('environment', 'preset:default')
}
else {
    environment.setAttribute('environment', 'preset:'+background)
}

let init = async () => {

    client = await AgoraRTM.createInstance(APP_ID)
    await client.login({uid, token})

    //index.html?room=23423
    channel = client.createChannel(roomId)
    await channel.join()

    channel.on('MemberJoined', handleUserJoined)
    channel.on('MemberLeft', handleUserLeft)

    client.on('MessageFromPeer', handleMessageFromPeer)

    localStream = await navigator.mediaDevices.getUserMedia(constraints);
    document.getElementById('user-1').srcObject = localStream

}

let interval
let username = document.getElementById("user_pseudo").innerText
let userNameDisplay = document.getElementById("username")
let textEntity = document.getElementById("text_entity")

let handleUserLeft = (MemberId) => {
    document.getElementById('user-2').style.display = 'none'
    document.getElementById('user-1').classList.remove('smallFrame')
    userNameDisplay.setAttribute("value", "Deconnecte")
    clearInterval(interval)
}

let handleMessageFromPeer = async (message, MemberId) => {
    message = JSON.parse(message.text)
    //console.log('Message:', message)

    if (message.type === 'offer') {
        createAnswer(MemberId, message.offer)
    }

    if (message.type === 'answer') {
        addAnswer(message.answer)
    }

    if (message.type === 'candidate') {
        if(peerConnection) {
            peerConnection.addIceCandidate(message.candidate)
        }
    }

    if (message.type === 'pseudo') {
        userNameDisplay.setAttribute('value', message.pseudo)
    }

}

let handleUserJoined = async (MemberId) => {
    //alert("zaerhjdsv")
    //console.log("ça marche ou pas ?")
    console.log('A new user has joined the channel:',  MemberId)
    createOffer(MemberId)
    
    var otherPerson = MemberId
    console.log("this is the other person : ")
    console.log(otherPerson)
}

let aFrameVideo = document.getElementById("a-frame-user-2")
let yourself = document.getElementById("camera").object3D
//userNameDisplay.setAttribute('value', username)

//console.log(aFrameVideo)

let createPeerConnection = async (MemberId) => {
    peerConnection = new RTCPeerConnection(servers)

    remoteStream = new MediaStream()
    document.getElementById('user-2').srcObject = remoteStream
    document.getElementById('user-2').style.display = 'block'

    document.getElementById('user-1').classList.add('smallFrame')

    if (!localStream) {
        localStream = await navigator.mediaDevices.getUserMedia({video:true, audio:false});
        document.getElementById('user-1').srcObject = localStream
    }

    localStream.getTracks().forEach((track) => {
        peerConnection.addTrack(track, localStream)
    })

    //SEND DATA
    dataChannel = peerConnection.createDataChannel("position");

    dataChannel.onopen = () => {
        console.log('Data channel opened')
        //const pseudo = {pseudo : username}
        //dataChannel.send(JSON.stringify(pseudo))
        interval = setInterval(() => {
            const position = yourself.position //{x: Math.random() * 100, y: Math.random() * 100}
            let cam = document.getElementById('camera')
            const rotation = cam.getAttribute("rotation")
            const coordinates = {
                position : position,
                rotation : rotation
            }
            dataChannel.send(JSON.stringify(coordinates))

            if (yourself.position.y >= 5) {
                yourself.position.y -= 0.1
            }
            else if (yourself.position.y < 4.9) {
                yourself.position.y = 4.9
            }
            
            
        }, 10)
    }

    // RECEIVE DATA
    peerConnection.ondatachannel = (event) => {
        const dataChannel = event.channel;
      
        dataChannel.onmessage = event => {
          const coordinates = JSON.parse(event.data);
          //console.log(coordinates)
          if (coordinates.hasOwnProperty('pseudo')) {
            userNameDisplay.setAttribute('value', coordinates.pseudo)
          }
          const position = coordinates.position
          const rotation = coordinates.rotation
          if (aFrameVideo.hasLoaded) {
            //console.log(aFrameVideo.getAttribute('position'))
            aFrameVideo.setAttribute('position', position)
            aFrameVideo.setAttribute('rotation', rotation)
            textEntity.setAttribute('position', {"x" : position.x, "y" : position.y + 5, "z" : position.z})
            textEntity.setAttribute('rotation', {"x" : rotation.x, "y" : rotation.y, "z" : rotation.z})
          } else {
            aFrameVideo.addEventListener('loaded', function () {
              //console.log(aFrameVideo.getAttribute('position'))
              aFrameVideo.setAttribute('position', position)
              aFrameVideo.setAttribute('rotation', rotation)
            });
          }  
          
        };
    };

    peerConnection.ontrack = (event) => {
        event.streams[0].getTracks().forEach((track) => {
            remoteStream.addTrack(track)
        })
    }

    peerConnection.onicecandidate = async (event) => {
        if (event.candidate) {
            console.log('New ICE candidate:', event.candidate)
            client.sendMessageToPeer({text:JSON.stringify({'type':'candidate', 'candidate':event.candidate})}, MemberId)
        }
    }

}

let createOffer = async (MemberId) => {

    await createPeerConnection(MemberId)

    let offer = await peerConnection.createOffer()
    await peerConnection.setLocalDescription(offer)

    client.sendMessageToPeer({text:JSON.stringify({'type':'offer', 'offer':offer})}, MemberId)
    client.sendMessageToPeer({text:JSON.stringify({'type':'pseudo', 'pseudo':username})}, MemberId)

}

let createAnswer = async (MemberId, offer) => {

    await createPeerConnection(MemberId)

    await peerConnection.setRemoteDescription(offer)

    let answer = await peerConnection.createAnswer()

    await peerConnection.setLocalDescription(answer)

    client.sendMessageToPeer({text:JSON.stringify({'type':'answer', 'answer':answer})}, MemberId)
    client.sendMessageToPeer({text:JSON.stringify({'type':'pseudo', 'pseudo':username})}, MemberId)

}

let addAnswer = async (answer) => {
    if(!peerConnection.currentRemoteDescription) {
        peerConnection.setRemoteDescription(answer)
    }
}

let leaveChannel = async () => {
    await channel.leave()
    await client.logout()
}

let toggleCamera = async () => {
    let videoTrack = localStream.getTracks().find(track => track.kind === 'video')

    if (videoTrack.enabled) {
        videoTrack.enabled = false;
        document.getElementById('camera-btn').style.backgroundColor = 'rgb(255, 80, 80)';
        document.getElementById('camera-btn').style.border = '1px solid rgb(255, 80, 80)';
    }
    else {
        videoTrack.enabled = true;
        document.getElementById('camera-btn').style.backgroundColor = 'rgb(12, 16, 23)';
        document.getElementById('camera-btn').style.border = '1px solid #03e9f4';
    }
}

let toggleMic = async () => {
    let audioTrack = localStream.getTracks().find(track => track.kind === 'audio')

    if (audioTrack.enabled) {
        audioTrack.enabled = false;
        document.getElementById('mic-btn').style.backgroundColor = 'rgb(255, 80, 80)';
        document.getElementById('mic-btn').style.border = '1px solid rgb(255, 80, 80)';
    }
    else {
        audioTrack.enabled = true;
        document.getElementById('mic-btn').style.backgroundColor = 'rgb(12, 16, 23)';
        document.getElementById('mic-btn').style.border = '1px solid #03e9f4';
    }
}

window.addEventListener('beforeunload', leaveChannel)

document.getElementById('camera-btn').addEventListener('click', toggleCamera)
document.getElementById('mic-btn').addEventListener('click', toggleMic)

let wtf = document.getElementById('camera')
let wtaf = wtf.getAttribute("position")
var up = false
var down = false

document.onkeydown = function (e) {
    if (e.key == 'c') {
        toggleCamera();
    }
    if (e.key == 'm') {
        toggleMic();
    }
    if (e.key == 'Escape') {
        //console.log(channel)
        //console.log(e.key);
        //console.log(leaveChannel())
        //mmalert(e.key)
        leaveChannel();
        window.location = '/?page=lobby'
    }

    if (e.key == 'e') {
        up = true
        //yourself.position.y += 0.1
    }

    if (e.key == 'a') {
        down = true
        //yourself.position.y -= 0.1
    }

    if (e.code == 'Space' && yourself.position.y <= 5) {
        up = true
        setTimeout(function() {
            up = false
        }, 500)
    }

    /*[].forEach.call(hiddenElements, function (el) {
      el.classList.remove('hidden');
    });
    info.classList.add('hidden');
    key.innerHTML = e.key;
    code.innerHTML = e.code;
    keyCode.innerHTML = e.keyCode;
    keyCodeLarge.innerHTML = e.keyCode;*/
  };

  document.onkeyup = function(e) {

    if (e.key == 'e') {
        up = false
        //yourself.position.y += 0.1
    }

    if (e.key == 'a') {
        down = false
        //yourself.position.y -= 0.1
    }

  }

  setInterval(function () {
    if (up) {
      wtaf.y += 0.5;
    } else if (down) {
      wtaf.y -= 0.5;
    }
    wtf.setAttribute('position', wtaf);
  }, 16);

init();

