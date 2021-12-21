const DB = require('../core/database').connection;
const fs = require("fs"); // get filesystem module

const errorResponse = {
    status: "failed"
};

const okResponse = {
    status: "ok"
}

/** 
 * filename: The file that contains the sql
 * table: The table that will be reseted
 */
function reset(res, filename, table) {
    let queryAdd;
    try {
        queryAdd = fs.readFileSync(filename).toString();
    } catch (error) {
        console.error(error);
        res.send(errorResponse);
        return;
    }
    const queryRemove = `DELETE FROM ${table};`
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

module.exports = reset;