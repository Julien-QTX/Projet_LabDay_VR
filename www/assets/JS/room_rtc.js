const APP_ID = "19b9e938c3354722bde30d9b4bd1be65"

let uid = sessionStorage.getItem('uid')

if(!uid){
    uid = String(Math.floor(Math.random() * 10000))
    sessionStorage.setItem('uid', uid)
}

let token = null
let client

let rtmClient
let channel


const queryString = window.location.search
const urlParams = new URLSearchParams(queryString)
let roomId = urlParams.get('room')

if (!roomId) {
    roomId = 'main'
}

let displayName = document.getElementById("user_pseudo").innerText

if (!displayName) {
    window.location = '/?page=lobby'
}

let localTracks = []
let remoteUsers = {}

let localScreenTracks

let sharingScreen = false

let joinRoomInit = async () => {

    rtmClient = await AgoraRTM.createInstance(APP_ID)
    await rtmClient.login({uid, token})

    await rtmClient.addOrUpdateLocalUserAttributes({'name': displayName})

    channel = await rtmClient.createChannel(roomId)
    await channel.join()

    channel.on('MemberJoined', handleMemberJoined)
    channel.on('MemberLeft', handleMemberLeft)
    channel.on('ChannelMessage', handleChannelMessage)

    getMembers()
    addBotMessageToDom(`Welcome to the room, ${displayName}`)

    client = AgoraRTC.createClient({ mode: 'rtc', codec: 'vp8' })
    await client.join(APP_ID, roomId, token, uid)

    client.on('user-published', handleUserPublished)
    client.on('user-left', handleUserLeft)

    joinStream()
}

let joinStream = async () => {

    localTracks = await AgoraRTC.createMicrophoneAndCameraTracks({}, {encoderConfig:{
        width: {min: 640, ideal:1920, max:1920},
        height: {min: 480, ideal:1080, max:1080},
    }})

    let player = `<div class="video__container" id="user-container-${uid}" >
                    <div class="video-player" id="user-${uid}"></div>
                </div>`

    document.getElementById('streams__container').insertAdjacentHTML('beforeend', player)
    document.getElementById(`user-container-${uid}`).addEventListener('click', expandVideoFrame)

    localTracks[1].play(`user-${uid}`)

    await client.publish([localTracks[0], localTracks[1]])
}

let handleUserPublished = async (user, mediaType) => {

    remoteUsers[user.uid] = user

    await client.subscribe(user, mediaType)

    let player = document.getElementById(`user-container-${user.uid}`)

    if(player === null){

        player = `<div class="video__container" id="user-container-${user.uid}" >
                        <div class="video-player" id="user-${user.uid}"></div>
                    </div>`

        document.getElementById('streams__container').insertAdjacentHTML('beforeend', player)
        document.getElementById(`user-container-${user.uid}`).addEventListener('click', expandVideoFrame)

    }

    if(displayFrame.style.display) {
        let videoFrame = document.getElementById(`user-container-${user.uid}`)
        videoFrame.style.height = '100px'
        videoFrame.style.width = '100px'
    }

    if(mediaType === 'video'){
        user.videoTrack.play(`user-${user.uid}`)
    }

    if(mediaType === 'audio'){
        user.audioTrack.play()
    }
}

let handleUserLeft = async (user) => {
    delete remoteUsers[user.uid]
    let item = document.getElementById(`user-container-${user.uid}`)

    if (item){
        item.remove()
    }

    if(userIdInDisplayFrame === `user-container-${user.uid}`) {
        displayFrame.style.display = null
        let videoFrames = document.getElementsByClassName('video__container')

        for(let i = 0; videoFrames.length > i; i++){
            videoFrames[i].style.height = '300px'
            videoFrames[i].style.width = '300px'
        }
    }
}

let toggleMic = async (e) => {
    let button = e.currentTarget
    if(localTracks[0].muted) {
        await localTracks[0].setMuted(false)
        button.classList.add('active')
        document.getElementById('mic-btn').style.backgroundColor = 'rgb(12, 16, 23)';
        document.getElementById('mic-btn').style.border = '1px solid #03e9f4';
    }
    else {
        await localTracks[0].setMuted(true)
        button.classList.remove('active')
        document.getElementById('mic-btn').style.backgroundColor = 'rgb(255, 80, 80)';
        document.getElementById('mic-btn').style.border = '1px solid rgb(255, 80, 80)';
    }
}

let toggleCamera = async (e) => {
    let button = e.currentTarget
    if(localTracks[1].muted) {
        await localTracks[1].setMuted(false)
        button.classList.add('active')
        document.getElementById('camera-btn').style.backgroundColor = 'rgb(12, 16, 23)';
        document.getElementById('camera-btn').style.border = '1px solid #03e9f4';
    }
    else {
        await localTracks[1].setMuted(true)
        button.classList.remove('active')
        document.getElementById('camera-btn').style.backgroundColor = 'rgb(255, 80, 80)';
        document.getElementById('camera-btn').style.border = '1px solid rgb(255, 80, 80)';
    }
}

let leaveStream = async (e) => {
    e.preventDefault()

    for(let i = 0; localTracks.length > i; i++){
        await localTracks[i].stop()
        await localTracks[i].close()
    }

    await client.unpublish([localTracks[0], localTracks[1]])

    if(localScreenTracks){
        await client.unpublish([localScreenTracks])
    }

    document.getElementById(`user-container-${uid}`).remove()

    if(userIdInDisplayFrame === 'user-container-${uid}'){
        displayFrame.style.display = null

        for(let i = 0; videoFrames.length > i; i++){
            if(videoFrames[i].id != userIdInDisplayFrame){
              videoFrames[i].style.height = '300px'
              videoFrames[i].style.width = '300px'
            }
          }
    }

    channel.sendMessage({text:JSON.stringify({type: 'user_left', 'uid': uid})})

    leaveChannel()
    window.location.href = '/?page=lobby'
}

document.getElementById('camera-btn').addEventListener('click', toggleCamera)
document.getElementById('mic-btn').addEventListener('click', toggleMic)
document.getElementById('leave-btn').addEventListener('click', leaveStream)

joinRoomInit()