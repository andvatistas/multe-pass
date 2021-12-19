const DB = require('../database').connection;
const express = require('express');
const router = express.Router();
const { convertDate, getCurrentTimestamp } = require('../helpers');

function chargesByQuery(op_ID, date_from, date_to) {
    let query = `
        SELECT 
            tag.providerId as VisitingOperator,
            COUNT(tag.providerId) as NumberOfPasses,
            SUM(charge) as PassesCost 
        FROM 
            pass 
            INNER JOIN station ON pass.stationRef = station.id
            INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
        WHERE 
            station.id = '${op_ID}'
            AND station.stationProvider != tag.providerId 
            AND pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
        GROUP BY tag.providerId;
    `;
    return query;
}

function chargesBy(req, res) {
    let requestTimestamp = getCurrentTimestamp();

    let op_ID = req.params.op_ID;
    let date_from = convertDate(`${req.params.date_from}`);
    let date_to = convertDate(`${req.params.date_to}`);

    let query = chargesByQuery(op_ID, date_from, date_to);
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