const DB = require('../database').connection;
const express = require('express');
const router = express.Router();
const { convertDate, getCurrentTimestamp, sendFormattedResult } = require('../helpers');
const fs = require("fs"); // get filesystem module
const request = require('request');

function resetPassesQuery(buffer) {
    let query = `REMOVE * FROM pass;` + buffer;
    return query;
}

function resetPasses(req, res) {
    const buffer = fs.readFileSync("../database/sql_data/default_passes.sql", (err,buffer) => {
        if(err){
            console.error(err);
            return res.status(500).send("Internal error in reading the file");
        }
        buffer.toString();
        return buffer;
    });

    let query = resetPasses(buffer);
    DB.query(query, (err, resultJson) => {
        if (err) {
            let resultJson = {
            status: "failed"
            }
        }
        else {
            let resultJson = {
            status: "OK"
            }
        }
        // request.write();
        sendFormattedResult(req, res, resultJson);
        // request.end();
    });
}

router.get('/admin/resetpasses', resetPasses)

module.exports = router;
