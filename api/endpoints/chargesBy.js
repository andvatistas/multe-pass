const express = require('express');
const moment = require('moment');
const router = express.Router();
var mysql = require('mysql');
const convertDate = require('../helpers');

function chargesBy(req, res) {

    var con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "multe-pass"
    });

    con.connect(function(err) {
        if (err) throw err;
        let limiter = req.query.limit;

        let op_ID = req.params.op_ID;
        let requestTimestamp = moment(new Date()).format("YYYY-MM-DD HH:MM:SS");

        let date_from = convertDate(`${req.params.date_from}`);
        let date_to = convertDate(`${req.params.date_to}`);

        let myQuery = `
			SELECT tag.providerId as VisitingOperator, COUNT(tag.providerId) as NumberOfPasses, SUM(charge) as PassesCost FROM pass 
			INNER JOIN station ON pass.stationRef = station.id
			INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
			WHERE station.id = '${op_ID}'
			AND station.stationProvider != tag.providerId 
			AND pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
			GROUP BY tag.providerId;
		`;
        if (limiter == undefined || Number.isInteger(Number(limiter)) == false) {} else {
            myQuery = myQuery + " LIMIT " + Number(limiter);
        }

        console.log(myQuery)
        con.query(myQuery, function(err, result, fields) {
            if (err) throw err;
            let resultJson = {
                "op_ID": op_ID,
                "RequestTimestamp": requestTimestamp,
                "PeriodFrom": date_from,
                "PeriodTo": date_to,
                "PPOList": result
            }
            res.send(resultJson);
        });
    });
}

router.get('/ChargesBy/:op_ID/:date_from/:date_to', chargesBy)
module.exports = router;