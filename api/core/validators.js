const { param } = require('express-validator');
const moment = require('moment');

function isValidDate(value) {
    return param(value, 'Date must be formatted as YYYYMMDD').isLength({ min: 8, max: 8 }).custom(value => moment(value, "YYYYMMDD").isValid())
}

function isValidOpID(value) {
    return param(value, 'OpId has a max length of 20 characters. Example: AO01').isLength({ min: 1, max: 20 })
}

function isValidStation(value) {
    return param(value, 'StationId has a max length of 10 characters. Example: aodos').isLength({ min: 1, max: 10 })
}

//not working - just logic
function isOperatorORStation(value){
    return value == "operator" || value =="station";
}

module.exports = {
    isValidOpID,
    isValidDate,
    isValidStation,
    isOperatorORStation
}
