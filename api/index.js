const { executeQuery } = require('./database');
const express = require('express');
const port = 8000;
const app = express();

app.listen(port, () => {
    console.log('App is running on port ${port}!');
});

app.get('/', (req, res) => {
    executeQuery(req, res, "SELECT * FROM pass LIMIT 100");
    // res.send("Hello world");
    // res.send(passes);
});