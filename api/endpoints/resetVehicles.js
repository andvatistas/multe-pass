const express = require('express');
const router = express.Router();
const reset = require('../core/reset');

router.post('/admin/resetvehicles', (req, res) => {
    reset(res, "../database/sql_data/default_vehicles.sql", "vehicle");
});

module.exports = router;