const DB = require('../core/database').connection;
const express = require('express');
const router = express.Router();

router.post('/admin/resetpasses', (req, res) => {
    const queryRemove = `DELETE FROM pass;`
    DB.query(queryRemove, (err, _) => {
        if (err) {
            console.error(err);
            res.send({ status: "failed" })
        } else {
            res.send({ status: "ok" })
        }
    })
});

module.exports = router;