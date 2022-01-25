const moment = require('moment');
const { Parser } = require('json2csv');

function convertDate(urlDate) {
    let year = urlDate.substring(0, 4);
    let month = urlDate.substring(4, 6);
    let day = urlDate.substring(6, 8);
    return `${year}-${month}-${day}`
}

function getCurrentTimestamp() {
    return moment(new Date()).format("YYYY-MM-DD HH:MM:SS");
}

function formatIsCSV(req) {
    let format = req.query.format
    return format != null && format == "csv";
}

function formatIsJson(req) {
    let format = req.query.format
    return format == null || format == "json";
}

function sendFormattedResult(req, res, json) {
    if (json.length == 0) {
        res.status(402).send("402: No data found");
        return;
    }
    if (formatIsCSV(req))
        res.send(toCSV(json));
    else if (formatIsJson(req))
        res.send(json);
    else
        res.status(400).send("400: Bad request");
}


function toCSV(json) {
    function isArray(what) {
        return Object.prototype.toString.call(what) === '[object Array]';
    }
    let fieldsOuter = Object.keys(json);
    let valuesOuter = Object.values(json);

    let counter=0;
    let helpJson ={};
    for (var i in json) {
        if (!isArray(json[i])) {
            helpJson = Object.assign(helpJson, { [i] : json[i]})
        }
        // console.log(json[i]);
        if (isArray(json[i])) {
            fieldsOuter = fieldsOuter.slice(0,counter);
            valuesOuter = valuesOuter.slice(0,counter);
            // Get the fields of the first element of the array
            const fields = fieldsOuter.concat(Object.keys(json[i][0]));
            const opts = { fields };
            let length=json[i].length;
            let result={};
            for(let counter=0; counter<length;counter++){
                json[i][counter] = Object.assign({},helpJson,json[i][counter]);
            }
            try {
                const parser = new Parser(opts);
                return parser.parse(json[i]);
            } catch (err) {
                console.error(err);
                break;
            }
        }
        counter+=1;
    }
}

module.exports = { convertDate, getCurrentTimestamp, sendFormattedResult };
