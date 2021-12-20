const express = require('express');
const port = 9103;
const app = express();
var path = require('path');

app.listen(port, () => {
    console.log(`App is running on port ${port}!`);
});

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname + '/index.html'));
});

// load all endpoints
const healthcheck = require("./endpoints/healthcheck.js");
const chargesBy = require("./endpoints/chargesBy.js");
const passesAnalysis = require("./endpoints/passesAnalysis.js");
const passesCost = require("./endpoints/passesCost.js");
const passesPerStation = require("./endpoints/passesPerStation.js");


//bind all endpoints to app router with base url
//router -> when the URL is modified somehow, it will detect that change and render the view that is associated with the new URL
const baseUrl = '/interoperability/api';
app.use(baseUrl, healthcheck);
app.use(baseUrl, chargesBy);
app.use(baseUrl, passesAnalysis);
app.use(baseUrl, passesCost);
app.use(baseUrl, passesPerStation);
app.use((err, req, res, next) => {
    console.log("Internal error");
    res.status(500).send("500: Internal server error");
    next();
})