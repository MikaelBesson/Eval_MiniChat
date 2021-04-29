/**
 * function getMessage
 */
function getMessages(){
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", '../bdd/messages.php');
    requeteAjax.onload = function (){
        let result = JSON.parse(requeteAjax.responseText);
        let html = result.reverse().map(function (message){
            return `
                <div>
                    <span><strong>a : </strong>${message.date.substring(11, 16)}</span>
                    <span><strong> user : </strong> ${message.pseudo}</span>
                    <span><strong> a ecrit : </strong><br> ${message.message}</span><br>
                </div>
            `
        }).join('');

        let messages = document.getElementById('lastMessage');
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
    }
    requeteAjax.send();
}

/**
 * function postMessage
 * @param event
 */
function postMessage(event) {
    event.preventDefault();


    let message = document.querySelector('#usermessage');
    if(message.value !== ''){
        let data = new FormData();
        data.append('usermessage', message.value);

        const requeteAjax = new XMLHttpRequest();
        requeteAjax.open('POST', '../bdd/messages.php?action=ecrire');

        requeteAjax.onload = function () {
            message.value = '';
            message.focus();
            getMessages();
        }
        requeteAjax.send(data);
    }
}
document.querySelector('form').addEventListener('submit', postMessage);
getMessages();

window.setInterval(getMessages, 3000);




