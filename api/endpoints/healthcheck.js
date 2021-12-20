const mysql = require('mysql');
const express = require('express');
const router = express.Router();

function healthcheck(req,res) {
    const sqlConfig = {
        host: "localhost",
        user: "root",
        password: "",
        database: "multe-pass"
    };

    const connection = mysql.createConnection(sqlConfig);

    let sqlConfigList = {
        host: sqlConfig.host,
        user: sqlConfig.user,
        databaseName: sqlConfig.database
    }
    connection.connect((err) => {
        let resultJson = {
            status: "failed",
            dbconnection: sqlConfigList
        };
        if (err) {
            res.send(resultJson);
            throw err;
        }
        else {
            resultJson = {
                status: "OK",
                dbconnection: sqlConfigList
            };
            res.send(resultJson);
        }
    });
}

router.get('/admin/healthcheck', healthcheck)
module.exports = router;
