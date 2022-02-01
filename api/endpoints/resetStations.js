const express = require('express');
const router = express.Router();
const {reset,resetDouble} = require('../core/reset');

router.post('/admin/resetstations', (req, res) => {
    reset(res, "../database/sql_data/default_stations.sql", "station");
});

module.exports = router;
