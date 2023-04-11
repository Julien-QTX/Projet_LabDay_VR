let skinParts = document.getElementsByClassName('skin')
let shirt = document.getElementsByClassName('shirt')[0]
let pants = document.getElementsByClassName('pants')

let skinColor = skinParts[0].getAttribute('color')
let shirtColor = shirt.getAttribute('color')
let pantsColor = pants[0].getAttribute('color')

let skinColorPicker = document.getElementsByTagName('input')[0]
let shirtColorPicker = document.getElementsByTagName('input')[1]
let pantsColorPicker = document.getElementsByTagName('input')[2]

skinColorPicker.value = skinColor
shirtColorPicker.value = shirtColor
pantsColorPicker.value = pantsColor

skinColorPicker.addEventListener('input', function() {
    for (let i = 0; i < skinParts.length; i++) {
        skinParts[i].setAttribute('color', skinColorPicker.value)  
    }
})

shirtColorPicker.addEventListener('input', function() {
        shirt.setAttribute('color', shirtColorPicker.value)  
})

pantsColorPicker.addEventListener('input', function() {
    for (let i = 0; i < pants.length; i++) {
        pants[i].setAttribute('color', pantsColorPicker.value)  
    }
})

window.addEventListener('beforeunload', function() {
    skinColor = skinParts[0].getAttribute('color').slice(1, 7)
    shirtColor = shirt.getAttribute('color').slice(1, 7)
    pantsColor = pants[0].getAttribute('color').slice(1, 7)
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/www/actions/avatar.php?action=update&skin='+skinColor+'&shirt='+shirtColor+'&pants='+pantsColor);
    xhr.send();
})