const DB = require('../core/database').connection;
const express = require('express');
const router = express.Router();
const { validationResult } = require('express-validator');
const { convertDate, getCurrentTimestamp, sendFormattedResult } = require('../core/helpers');
const { isValidDate, isValidOpID, isOperatorORStation } = require('../core/validators');

function statsQuery(param, date_from, date_to) {
    let query = `
	SELECT ${param}.id, COUNT(${param}.id) as Count FROM
		pass
		INNER JOIN station ON pass.stationRef = station.id
		INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
		INNER JOIN operator ON tag.providerId = operator.id
	WHERE
		pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
	GROUP BY
		${param}.id
	ORDER BY
		COUNT(${param}.id) DESC;
    `;
    return query;
}

function stats(req, res) {
    let requestTimestamp = getCurrentTimestamp();

    const errors = validationResult(req);
    if (!errors.isEmpty) {
        return res.status(400).send(errors);
    }

    let param = req.params.param;
    let date_from = convertDate(`${req.params.date_from}`);
    let date_to = convertDate(`${req.params.date_to}`);

    let query = statsQuery(param, date_from, date_to);
    DB.query(query, (err, resultPPOList) => {
        if (err) {
            console.error(err);
            return res.status(500).send("Internal error");
        }
        if (resultPPOList.length == 0)
            res.status(402).send("Data not found");
        else
            sendFormattedResult(req, res, resultPPOList);
    });
}

router.get('/stats/:param/:date_from/:date_to',
    isValidDate('date_from'),
    isValidDate('date_to'),
    // isOperatorORStation('param'),
    stats)
module.exports = router;
