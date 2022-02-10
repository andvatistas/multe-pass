const mysql = require('mysql');
const host_name = process.env.HOST_NAME || 'localhost';
const sqlConfig = {
    host: host_name,
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
