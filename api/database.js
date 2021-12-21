const mysql = require('mysql');

const sqlConfig = {
    host: "localhost",
    user: "root",
    password: "",
    database: "multe-pass"
};

const connection = mysql.createConnection(sqlConfig);

connection.connect((err) => {
    if (err) {
        console.error(err);
        return;
    }
    console.log("Sql connection successful");
});

module.exports = { connection };