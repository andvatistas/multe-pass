const DB = require('../database').connection;
const express = require('express');
const router = express.Router();
const fs = require("fs"); // get filesystem module

const errorResponse = {
    status: "failed"
};

const okResponse = {
    status: "ok"
}

function resetPasses(req, res) {
    let queryAdd;
    try {
        queryAdd = fs.readFileSync("../database/sql_data/default_passes.sql").toString();
    } catch (error) {
        console.error(error);
        res.send(errorResponse);
        return;
    }
    const queryRemove = `DELETE FROM pass;`
    DB.query(queryRemove, (err, _) => {
        if (err) {
            console.error(err);
            return;
        }
        DB.query(queryAdd, (err, _) => {
            if (err)
                res.send(errorResponse);
            else
                res.send(okResponse);
        });
    })
}

router.post('/admin/resetpasses', resetPasses)

module.exports = router;