const express = require('express');
const router = express.Router();
const { resetDouble } = require('../core/reset');

router.post('/admin/resetvehicles', (req, res) => {
    resetDouble(res,"../database/sql_data/default_vehicles.sql", "vehicle", "../database/sql_data/default_tag.sql", "tag");
});

module.exports = router;
