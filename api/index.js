// const { executeQuery } = require('./database');
const express = require('express');
const port = 8000;
const app = express();

app.listen(port, () => {
    console.log('App is running on port ${port}!');
});



app.get('/', (req, res) => {
    res.send("Hello world -- use API parameters in URL to access DATA");
});


// load all endpoints
const chargesBy=require("./endpoints/chargesBy.js");
const passesAnalysis=require("./endpoints/passesAnalysis.js");
const passesCost=require("./endpoints/passesCost.js");
const passesPerStation=require("./endpoints/passesPerStation.js");

//bind all endpoints to app router
//router -> when the URL is modified somehow, it will detect that change and render the view that is associated with the new URL
app.use('/',chargesBy);
app.use('/',passesAnalysis);
app.use('/',passesCost);
app.use('/',passesPerStation);
