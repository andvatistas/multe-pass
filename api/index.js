const express = require('express');
const port = process.env.PORT || 9103;
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
const resetPasses = require("./endpoints/resetPasses.js");
const resetStations = require("./endpoints/resetStations.js");
const resetVehicles = require("./endpoints/resetVehicles.js");
const chargesBy = require("./endpoints/chargesBy.js");
const passesAnalysis = require("./endpoints/passesAnalysis.js");
const passesCost = require("./endpoints/passesCost.js");
const passesPerStation = require("./endpoints/passesPerStation.js");
const stats = require("./endpoints/stats.js");

//bind all endpoints to app router with base url
//router -> when the URL is modified somehow, it will detect that change and render the view that is associated with the new URL
const baseUrl = '/interoperability/api';
app.use(baseUrl, healthcheck);
app.use(baseUrl, resetPasses);
app.use(baseUrl, resetStations);
app.use(baseUrl, resetVehicles);
app.use(baseUrl, chargesBy);
app.use(baseUrl, passesAnalysis);
app.use(baseUrl, passesCost);
app.use(baseUrl, passesPerStation);
app.use(baseUrl, stats);
app.use((err, req, res, next) => {
    console.error(err);
    res.status(500).send("500: Internal server error");
})
