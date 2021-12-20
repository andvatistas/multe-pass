const DB = require('../database').connection;
const express = require('express');
const router = express.Router();
const { convertDate, getCurrentTimestamp, sendFormattedResult } = require('../helpers');

function passesPerStationQuery(stationID, date_from, date_to) {
    let query = `
        SELECT 
            ROW_NUMBER() OVER(ORDER BY pass.timestamp) as PassIndex,
            pass.id AS PassID,
            pass.timestamp AS PassTimeStamp,
            tag.vehicleId AS VehicleID,
            operator.name AS TagProvider,
            pass.charge AS PassCharge,
            case when station.stationProvider = tag.providerId THEN 'home' ELSE 'visitor' END PassType
        FROM 
            pass
            INNER JOIN station ON pass.stationRef = station.id
            INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
            INNER JOIN operator ON tag.providerId = operator.id
        WHERE 
            pass.stationRef = '${stationID}'
            AND pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
        ORDER BY pass.timestamp ASC
    `;
    return query;
}


function passesPerStation(req, res) {
    let requestTimestamp = getCurrentTimestamp();

    let stationID = req.params.stationID;
    let date_from = convertDate(`${req.params.date_from}`);
    let date_to = convertDate(`${req.params.date_to}`);

    let queryProvider = `
        SELECT station.stationProvider
        FROM station
        WHERE station.id ='${stationID}'
        LIMIT 1
    `;
    DB.query(queryProvider, (err, resultStationOperator) => {
        if (err) throw err;

        let query = passesPerStationQuery(stationID, date_from, date_to);
        DB.query(query, (err, resultPassesList) => {
            if (err) throw err;
            let resultJson = {
                "Station": stationID,
                "StationOperator": resultStationOperator[0].stationProvider,
                "RequestTimestamp": requestTimestamp,
                "PeriodFrom": date_from,
                "PeriodTo": date_to,
                "NumberOfPasses": resultPassesList.length,
                "PassesList": resultPassesList
            }
            sendFormattedResult(req, res, resultJson);
        });
    });
}

router.get('/PassesPerStation/:stationID/:date_from/:date_to', passesPerStation)
module.exports = router;