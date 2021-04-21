

function getMessages(){
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", '../bdd/messages.php');
    requeteAjax.onload = function (){
        let result = JSON.parse(requeteAjax.responseText);
        let html = result.reverse().map(function (message){
            return `
                <div>
                    <span> <strong>a :</strong>${message.date.substring(11, 16)}</span>
                    <span> user :${message.pseudo}</span>
                    <span> a ecrit :${message.message}</span>
                </div>
            `
        }).join('');

        let messages = document.getElementById('lastMessage');
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
    }
    requeteAjax.send();
}

function postMessage(event) {
    event.preventDefault();
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../bdd/messages.php?action=ecrire');

    requeteAjax.onload = function () {
        document.getElementById('usermessage').value = '';
        document.getElementById('usermessage').focus();
        getMessages();
    }
    requeteAjax.send();
}
document.querySelector('form').addEventListener('submit', postMessage);



