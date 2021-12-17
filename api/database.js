//file not used now
var mysql = require('mysql');

function executeQuery(req, res, query) {
    var con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "multe-pass"
    });

    con.connect((err) => {
        if (err) throw err;
        con.query(query, (err, result, fields) => {
            if (err) throw err;
            console.log(result);
            res.send(result);
        });
    });
};

module.exports = { executeQuery };
