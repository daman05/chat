
/** chat */

// Scroll down

let chat_room = document.getElementById('chat_room');
if (chat_room)
    chat_room.scrollTop = chat_room.scrollHeight;

// Send to

document.querySelectorAll('.user').forEach(element => {
    element.onclick = send_to;
});

function send_to() {
    let username = this.innerText;
    let input = document.getElementById('message-text');
    input.value = username + ' > ';
    input.focus();
}

// comment-slash

let slash = document.querySelectorAll('.fa-comment-slash');

slash.forEach(element => {
    element.addEventListener('click', trash);
});

function trash() {
    console.log(this);
}

/** chat */