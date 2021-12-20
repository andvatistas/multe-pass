const DB = require('../database').connection;
const express = require('express');
const router = express.Router();
const { convertDate, getCurrentTimestamp, sendFormattedResult } = require('../helpers');

function passesCostQuery(op1_ID, op2_ID, date_from, date_to) {
    let query = `
        SELECT 
            COUNT(pass.id) AS NumberOfPasses,
            SUM(pass.charge) AS PassesCost
        FROM 
            pass
            INNER JOIN station ON pass.stationRef = station.id
            INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
        WHERE 
            station.stationProvider = '${op1_ID}'
            AND tag.providerId = '${op2_ID}'
            AND pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
    `;
    return query;
}

function passesCost(req, res) {
    let requestTimestamp = getCurrentTimestamp();

    let op1_ID = req.params.op1_ID;
    let op2_ID = req.params.op2_ID;
    let date_from = convertDate(`${req.params.date_from}`);
    let date_to = convertDate(`${req.params.date_to}`);

    let query = passesCostQuery(op1_ID, op2_ID, date_from, date_to);
    DB.query(query, (err, resultList) => {
        if (err) throw err;
        let resultJson = {
            "op1_ID": op1_ID,
            "op2_ID": op2_ID,
            "RequestTimestamp": requestTimestamp,
            "PeriodFrom": date_from,
            "PeriodTo": date_to,
            "NumberOfPasses": resultList[0].NumberOfPasses,
            "PassesCost": resultList[0].PassesCost
        }
        sendFormattedResult(req, res, resultJson);
    });
}

router.get('/PassesCost/:op1_ID/:op2_ID/:date_from/:date_to', passesCost)
module.exports = router;