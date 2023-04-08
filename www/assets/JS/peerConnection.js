let APP_ID  = "3de2def185854a95bc99de2294eb2522";

let token = null;
let uid = String(Math.floor(Math.random() * 10000));

let client;
let channel;

let queryString = window.location.search;
let urlParams = new URLSearchParams(queryString)
let roomId = urlParams.get('room')
let bg = urlParams.get('background')

if (!roomId) {
    window.location = '/?page=lobby'
}

let roomIdDisplay = document.getElementById('room-id')

roomIdDisplay.innerText = "Id du salon : " + roomId

let numberOfUsers = 1;

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

// if the background is not in the list, set it to default
if (!validBackgrounds.includes(background)) {
    console.error("background not in list")
    environment.setAttribute('environment', 'preset:default')
}
else {
    environment.setAttribute('environment', 'preset:'+background)
}

let username = document.getElementById("user_pseudo").innerText

let init = async () => {

    client = await AgoraRTM.createInstance(APP_ID)
    await client.login({uid, token})

    channel = client.createChannel(roomId)
    await channel.join()

    await client.addOrUpdateLocalUserAttributes({'name': username})

    channel.on('MemberJoined', handleMemberJoined)
    channel.on('MemberLeft', handleMemberLeft)
    channel.on('ChannelMessage', handleChannelMessage)

    channel.on('MemberJoined', handleUserJoined)
    channel.on('MemberLeft', handleUserLeft)

    client.on('MessageFromPeer', handleMessageFromPeer)

    addBotMessageToDom(`Welcome to the room, ${username}`)

    localStream = await navigator.mediaDevices.getUserMedia(constraints);
    document.getElementById('user-1').srcObject = localStream

    const xhr = new XMLHttpRequest();
    console.log('www//actions/rooms.php?action=add&room='+roomId+'&background='+background)
    xhr.open('POST', 'www//actions/rooms.php?action=add&room='+roomId+'&background='+background);
    xhr.send();

}

let interval

let userNameDisplay = document.getElementById("username")
let textEntity = document.getElementById("text_entity")

let handleUserLeft = (MemberId) => {
    document.getElementById('user-2').style.display = 'none'
    document.getElementById('user-1').classList.remove('smallFrame')
    userNameDisplay.setAttribute("value", "Deconnecte")
    numberOfUsers--
    clearInterval(interval)
}

let otherUsername;

// what to do when a message is received
let handleMessageFromPeer = async (message, MemberId) => {
    message = JSON.parse(message.text)

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
        otherUsername = message.pseudo

        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/www/actions/avatar.php?action=get&name='+message.pseudo);
        xhr.onload = () => {
            const jsonData = JSON.parse(xhr.responseText);
            console.error(jsonData)
            let avatarColors = {
                'skin': jsonData[2],
                'shirt': jsonData[3],
                'pants': jsonData[4]
            }
            let skinParts = document.getElementsByClassName('skin')
            let shirt = document.getElementsByClassName('shirt')[0]
            let pants = document.getElementsByClassName('pants')

            for (let i = 0; i < skinParts.length; i++) {
                skinParts[i].setAttribute('color', jsonData[2])  
            }

            shirt.setAttribute('color', jsonData[3])  

            for (let i = 0; i < pants.length; i++) {
                pants[i].setAttribute('color', jsonData[4])  
            }
            //client.sendMessageToPeer({text:JSON.stringify({'type':'avatar', 'avatar':avatarColors})}, MemberId)
        }
        xhr.send();

    }

    /*if (message.type === 'avatar') {

        console.log(message.avatar)

        let skinParts = document.getElementsByClassName('skin')
        let shirt = document.getElementsByClassName('shirt')[0]
        let pants = document.getElementsByClassName('pants')

        for (let i = 0; i < skinParts.length; i++) {
            skinParts[i].setAttribute('color', message.avatar.skin)  
        }

        shirt.setAttribute('color', message.avatar.shirt)  

        for (let i = 0; i < pants.length; i++) {
            pants[i].setAttribute('color', message.avatar.pants)  
        }

    }*/

}

// what to do when a new user joins the channel
let handleUserJoined = async (MemberId) => {
    console.log('A new user has joined the channel:',  MemberId)
    createOffer(MemberId)
    
    var otherPerson = MemberId
    console.log("this is the other person : ")
    console.log(otherPerson)
    numberOfUsers++
}

let aFrameVideo = document.getElementById("a-frame-user-2")
let yourself = document.getElementById("camera").object3D
let head = document.getElementById('head')

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

    // send your position to the other user every 10ms
    dataChannel.onopen = () => {
        console.log('Data channel opened')
        interval = setInterval(() => {
            const position = yourself.position
            let cam = document.getElementById('camera')
            const rotation = cam.getAttribute("rotation")
            const coordinates = {
                position : position,
                rotation : rotation
            }
            dataChannel.send(JSON.stringify(coordinates))

            if (yourself.position.y >= 2.5) {
                yourself.position.y -= 0.1
            }
            else if (yourself.position.y < 2.4) {
                yourself.position.y = 2.4
            }
            
            
        }, 10)
    }

    // RECEIVE DATA
    peerConnection.ondatachannel = (event) => {
        const dataChannel = event.channel;
      
        //receive the other user's position
        dataChannel.onmessage = event => {
          const coordinates = JSON.parse(event.data);
          if (coordinates.hasOwnProperty('pseudo')) {
            userNameDisplay.setAttribute('value', coordinates.pseudo)
          }
          const position = coordinates.position
          const rotation = coordinates.rotation
          if (aFrameVideo.hasLoaded) {

            aFrameVideo.setAttribute('position', {"x" : position.x, "y" : position.y - 1.5, "z" : position.z})
            head.setAttribute('rotation', rotation)
            textEntity.setAttribute('position', {"x" : position.x, "y" : position.y + 1.5, "z" : position.z})
            textEntity.setAttribute('rotation', rotation)

          } 
          else {
            aFrameVideo.addEventListener('loaded', function () {
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

    if (numberOfUsers == 1 || numberOfUsers == 0) {
        const xhr = new XMLHttpRequest();
        xhr.open('DELETE', '/www/actions/rooms.php?action=delete&room='+roomId);
        xhr.onload = () => {
            console.log(`${xhr.responseText}`)
        };
        xhr.send();
    }

    await channel.leave()
    await client.logout()
    
}

// turn the camera on and off
let toggleCamera = async () => {

    console.log(numberOfUsers)

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

// turn the microphone on and off
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
document.getElementById('leave-btn').addEventListener('click', leaveChannel)

let cam = document.getElementById('camera')
let camPos = cam.getAttribute("position")
var up = false
var down = false

let keydownEvents = true

let messageInput = document.getElementById('message-input')

// blocks keydown events when the user is typing in the message input
messageInput.addEventListener('focusin', function() {
    
    keydownEvents = false
    console.log(keydownEvents)
})

messageInput.addEventListener('focusout', function() {
    keydownEvents = true
    console.log(keydownEvents)
})

// keydown shortcuts and events
document.onkeydown = function (e) {
    if (keydownEvents) {

        if (e.key == 'c') {
            toggleCamera();
        }
        if (e.key == 'm') {
            toggleMic();
        }
        if (e.key == 'Escape') {
            leaveChannel();
            window.location = '/?page=lobby'
        }

        if (e.key == 'e') {
            up = true
        }

        if (e.key == 'a') {
            down = true
        }

        if (e.code == 'Space' && yourself.position.y <= 5) {
            up = true
            setTimeout(function() {
                up = false
            }, 500)
        }
    }
};

document.onkeyup = function(e) {

    if (e.key == 'e') {
        up = false
    }

    if (e.key == 'a') {
        down = false
    }

}

setInterval(function () {
if (up) {
    camPos.y += 0.5;
} else if (down) {
    camPos.y -= 0.5;
}
cam.setAttribute('position', camPos);
}, 16);

init();
