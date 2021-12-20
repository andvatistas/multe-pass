const DB = require('../database').connection;
const express = require('express');
const router = express.Router();
const { validationResult } = require('express-validator');
const { convertDate, getCurrentTimestamp, sendFormattedResult } = require('../helpers');
const { isValidOpID, isValidDate } = require('../validators');

function passesAnalysisQuery(op1_ID, op2_ID, date_from, date_to) {
    let query = `
		SELECT
			ROW_NUMBER() OVER(ORDER BY pass.timestamp) AS PassIndex,
			pass.id AS PassID,
			station.id AS StationID,
			pass.timestamp AS TimeStamp,
			tag.vehicleId AS VehicleID,
			pass.charge AS Charge
		FROM
			pass
			INNER JOIN station ON pass.stationRef = station.id
			INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
			INNER JOIN operator ON tag.providerId = operator.id
		WHERE
			tag.providerId = '${op2_ID}' 
			AND station.stationProvider = '${op1_ID}'
			AND pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
		ORDER BY pass.timestamp ASC;
    `;
    return query;
}


function passesAnalysis(req, res) {
    let requestTimestamp = getCurrentTimestamp();

    const errors = validationResult(req);
    if (!errors.isEmpty()) {
        return result.status(400).send(errors);
    }

    let op1_ID = req.params.op1_ID;
    let op2_ID = req.params.op2_ID;
    let date_from = convertDate(`${req.params.date_from}`);
    let date_to = convertDate(`${req.params.date_to}`);

    let query = passesAnalysisQuery(op1_ID, op2_ID, date_from, date_to);
    DB.query(query, (err, resultPassesList) => {
        if (err) throw err;
        let resultJson = {
            "op1_ID": op1_ID,
            "op2_ID": op2_ID,
            "RequestTimestamp": requestTimestamp,
            "PeriodFrom": date_from,
            "PeriodTo": date_to,
            "NumberOfPasses": resultPassesList.length,
            "PassesList": resultPassesList
        }
        if (resultPassesList.length == 0)
            res.status(402).send("Data not found");
        else
            sendFormattedResult(req, res, resultJson);
    });
}

router.get('/PassesAnalysis/:op1_ID/:op2_ID/:date_from/:date_to',
    isValidOpID('op1_ID'),
    isValidOpID('op2_ID'),
    isValidDate('date_from'),
    isValidDate('date_to'),
    passesAnalysis)
module.exports = router;