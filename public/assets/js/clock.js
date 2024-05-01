function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    hours = padZero(hours);
    minutes = padZero(minutes);
    seconds = padZero(seconds);
    document.getElementById('clock').innerHTML = hours + ':' + minutes + ':' + seconds;
}

function padZero(num) {
    return (num < 10 ? '0' : '') + num;
}

setInterval(updateClock, 1000);
