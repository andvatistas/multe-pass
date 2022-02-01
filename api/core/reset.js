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
            if (err){
                console.error(err);
                res.send(errorResponse);
                return;
            }
            else
                res.send(okResponse);
        });
    })
};

function resetDouble(res, filename, table, filename2, table2) {
    let queryAdd;
    try {
        queryAdd = fs.readFileSync(filename).toString();
    } catch (error) {
        console.error(error);
        res.send(errorResponse);
        return;
    }
    let queryAdd2;
    try {
        queryAdd2 = fs.readFileSync(filename2).toString();
    } catch (error) {
        console.error(error);
        res.send(errorResponse);
        return;
    }
    const queryRemove = `DELETE FROM ${table};`
    const queryRemove2 = `DELETE FROM ${table2};`
    DB.query(queryRemove, (err, _) => {
        if (err) {
            console.error(err);
            res.send(errorResponse);
            return;
        }
        DB.query(queryRemove2, (err, _) => {
            if (err) {
                console.error(err);
                res.send(errorResponse);
                return;
            }
            DB.query(queryAdd, (err, _) => {
                if (err) {
                    console.error(err);
                    res.send(errorResponse);
                    return;
                }
                DB.query(queryAdd2, (err, _) => {
                    if (err){
                        console.error(err);
                        res.send(errorResponse);
                        return
                    }
                    else
                        res.send(okResponse);
                });
            });
        });
    })
};

module.exports = {reset, resetDouble};
