const queryString2 = window.location.search
const urlParams2 = new URLSearchParams(queryString2)
let roomId2 = urlParams2.get('room')

// what to do when a new user joins the room
let handleMemberJoined = async (MemberId) => {
    console.log('A new member joined the channel: ' + MemberId)

    let {name} = await client.getUserAttributesByKeys(MemberId, ['name'])
    
    addBotMessageToDom(`Welcome to the room, ${name} !`)
}

// what to do when a user leaves the room
let handleMemberLeft = async (MemberId) => {
    addBotMessageToDom(`${otherUsername} has left the room!`)
}

// what to do when a new message is received
let handleChannelMessage = async (messageData, MemberId) => {
    console.error('A new message has been received: ' + messageData.text)
    let data = JSON.parse(messageData.text)
    if(data.type === 'chat') {
        addMessageToDom(data.displayName, data.message)
    }
}

// send a message to the room
let sendMessage =  async (e) => {
    e.preventDefault()
    let message = e.target.message.value
    if(message != "") {
        channel.sendMessage({text: JSON.stringify({'type':'chat', 'message': message, 'displayName': username})})
        addMessageToDom(username, message)
        e.target.reset()
    }
}

// add the message to the ui
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

// add a bot message to the ui
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

let messageForm = document.getElementById('message__form')
messageForm.addEventListener('submit', sendMessage)

// hide or display the chat
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