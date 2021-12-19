const moment = require('moment');

function convertDate(urlDate) {
    let year = urlDate.substring(0, 4);
    let month = urlDate.substring(4, 6);
    let day = urlDate.substring(6, 8);
    return `${year}-${month}-${day}`
}

function getCurrentTimestamp() {
    return moment(new Date()).format("YYYY-MM-DD HH:MM:SS");
}

module.exports = { convertDate, getCurrentTimestamp };