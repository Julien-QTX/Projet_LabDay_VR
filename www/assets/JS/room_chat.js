const queryString2 = window.location.search
const urlParams2 = new URLSearchParams(queryString2)
let roomId2 = urlParams2.get('room')

let handleMemberJoined = async (MemberId) => {
    console.error('A new member joined the channel')
    console.log('A new member joined the channel: ' + MemberId)
    //addMemberToDom(MemberId)

    let members = await channel.getMembers()
    //updateMemberTotal(members)

    let {name} = await client.getUserAttributesByKeys(MemberId, ['name'])
    
    addBotMessageToDom(`Welcome to the room, ${name} !`)
}

/*let addMemberToDom = async (MemberId) => {
    let {name} = await client.getUserAttributesByKeys(MemberId, ['name'])

    let membersWrapper = document.getElementById('member__list')
    let memberItem = `<div class="member__wrapper" id="member__${MemberId}__wrapper">
                        <span class="green__icon"></span>
                        <p class="member_name">${name}</p>
                    </div>`

    membersWrapper.insertAdjacentHTML('beforeend', memberItem)
}*/

/*let updateMemberTotal = async (members) => {
    let total = document.getElementById('members__count')
    total.innerText = members.length
}*/

let handleMemberLeft = async (MemberId) => {
    //removeMemberFromDom(MemberId)
    let members = await channel.getMembers()
    //updateMemberTotal(members)
}

let removeMemberFromDom = async (MemberId) => {
    //let memberWrapper = document.getElementById(`member__${MemberId}__wrapper`)
    //memberWrapper.remove()
    //let name = memberWrapper.getElementsByClassName('member_name')[0].textContent
    addBotMessageToDom(`${otherUsername} has left the room!`)
}

let getMembers = async () => {
    let members = await channel.getMembers() 
    updateMemberTotal(members)
    members.forEach(member => {
        addMemberToDom(member)
    })
}

let handleChannelMessage = async (messageData, MemberId) => {
    console.error('A new message has been received: ' + messageData.text)
    let data = JSON.parse(messageData.text)
    if(data.type === 'chat') {
        addMessageToDom(data.displayName, data.message)
    }
    if (data.type === 'user_left'){
        console.error(`User ${data.uid} has left the room`)
        document.getElementById(`a-frame-user-${data.uid}`).remove()
    } 
}

let sendMessage =  async (e) => {
    e.preventDefault()
    let message = e.target.message.value
    if(message != "") {
        channel.sendMessage({text: JSON.stringify({'type':'chat', 'message': message, 'displayName': username})})
        addMessageToDom(username, message)
        e.target.reset()
    }
}

let addMessageToDom = (name, message) => {
    let messagesWrapper = document.getElementById('messages')
    let newMessage = `<div class="message__wrapper">
                        <div class="message__body">
                            <strong class="message__author">${name}</strong>
                            <p class="message__text">${message}</p>
                        </div>
                    </div>`

    messagesWrapper.insertAdjacentHTML('beforeend', newMessage)

    let lastMessage = document.querySelector('#messages .message__wrapper:last-child')
    if(lastMessage) {
        lastMessage.scrollIntoView()
    }
}

let addBotMessageToDom = (botMessage) => {
    let messagesWrapper = document.getElementById('messages')
    let newMessage = `<div class="message__wrapper">
                        <div class="message__body__bot">
                            <strong class="message__author__bot">🤖 VRC Bot</strong>
                            <p class="message__text__bot">${botMessage}</p>
                        </div>
                    </div>`

    messagesWrapper.insertAdjacentHTML('beforeend', newMessage)

    let lastMessage = document.querySelector('#messages .message__wrapper:last-child')
    if(lastMessage) {
        lastMessage.scrollIntoView()
    }
}

/*let leaveChannel = async () => {
    await channel.leave()
    await rtmClient.logout()
    if (document.getElementById('members__count').innerText == "1") {
        const xhr = new XMLHttpRequest();
        xhr.open('DELETE', '/actions/rooms.php?action=delete&room='+roomId2);
        xhr.onload = () => {
            console.log(`${xhr.responseText}`)
        };
        xhr.send();
    }
}*/

//window.addEventListener('beforeunload', leaveChannel)
//document.getElementById('leave-btn').addEventListener('click', leaveChannel)

let messageForm = document.getElementById('message__form')
messageForm.addEventListener('submit', sendMessage)

let chat = document.getElementById('messages__container')
let display = document.getElementById('chat-displayer')
let hide = document.getElementById('chat-hider')

display.addEventListener('click', function() {
    chat.style.display = 'block'
    display.style.display = 'none'
})

hide.addEventListener('click', function() {
    chat.style.display = 'none'
    display.style.display = 'block'
})