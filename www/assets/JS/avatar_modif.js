let skinParts = document.getElementsByClassName('skin')
let shirt = document.getElementsByClassName('shirt')[0]
let pants = document.getElementsByClassName('pants')
let hair = document.getElementsByClassName('hair')

let skinColor = skinParts[0].getAttribute('color')
let shirtColor = shirt.getAttribute('color')
let pantsColor = pants[0].getAttribute('color')
let hairColor = hair[0].getAttribute('material').substring(7, 14)
//console.log(hairColor.substring(7, 14))

let skinColorPicker = document.getElementsByTagName('input')[0]
let shirtColorPicker = document.getElementsByTagName('input')[1]
let pantsColorPicker = document.getElementsByTagName('input')[2]
let hairColorPicker = document.getElementsByTagName('input')[3]

skinColorPicker.value = skinColor
shirtColorPicker.value = shirtColor
pantsColorPicker.value = pantsColor
hairColorPicker.value = hairColor

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

hairColorPicker.addEventListener('input', function() {
    for (let i = 0; i < hair.length; i++) {
        hair[i].setAttribute('material', `color: ${hairColorPicker.value}; side: double`)  
    }
})

window.addEventListener('beforeunload', function() {
    skinColor = skinParts[0].getAttribute('color').slice(1, 7)
    shirtColor = shirt.getAttribute('color').slice(1, 7)
    pantsColor = pants[0].getAttribute('color').slice(1, 7)
    hairColor = hair[0].getAttribute('material').substring(7, 14)
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/www/actions/avatar.php?action=update&skin='+skinColor+'&shirt='+shirtColor+'&pants='+pantsColor+'&hair='+hairColor);
    xhr.send();
})