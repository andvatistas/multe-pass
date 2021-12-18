const DB = require('../database').connection;
const express = require('express');
const moment = require('moment');
const router = express.Router();
const convertDate = require('../helpers');

function chargesByQuery(op_ID, date_from, date_to, limiter) {
    let query = `
        SELECT tag.providerId as VisitingOperator, COUNT(tag.providerId) as NumberOfPasses, SUM(charge) as PassesCost FROM pass 
        INNER JOIN station ON pass.stationRef = station.id
        INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
        WHERE station.id = '${op_ID}'
        AND station.stationProvider != tag.providerId 
        AND pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
        GROUP BY tag.providerId;
    `;
    if (limiter != undefined && Number.isInteger(Number(limiter))) {
        query += " LIMIT " + Number(limiter);
    }
    return query;
}

function chargesBy(req, res) {
    let requestTimestamp = moment(new Date()).format("YYYY-MM-DD HH:MM:SS");

    let op_ID = req.params.op_ID;
    let date_from = convertDate(`${req.params.date_from}`);
    let date_to = convertDate(`${req.params.date_to}`);
    let limiter = req.query.limit;

    let query = chargesByQuery(op_ID, date_from, date_to, limiter);
    DB.query(query, (err, resultPPOList) => {
        if (err) throw err;
        let resultJson = {
            "op_ID": op_ID,
            "RequestTimestamp": requestTimestamp,
            "PeriodFrom": date_from,
            "PeriodTo": date_to,
            "PPOList": resultPPOList
        }
        res.send(resultJson);
    });
}

router.get('/ChargesBy/:op_ID/:date_from/:date_to', chargesBy)
module.exports = router;