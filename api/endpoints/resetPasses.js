const express = require('express');
const router = express.Router();
const reset = require('../core/reset');

router.post('/admin/resetpasses', (req, res) => {
    reset(res, "../database/sql_data/default_passes.sql", "pass");
});

module.exports = router;