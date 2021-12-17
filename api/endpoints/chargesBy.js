const express = require('express');
const router = express.Router();
var mysql = require('mysql');

function chargesBy(req,res){

  var con = mysql.createConnection({
      host: "localhost",
      user: "root",
      password: "",
      database: "multe-pass"
  });
	con.connect(function(err) {
		if (err) throw err;
		console.log("Connected!");
		let limiter=req.query.limit;
		let myQuery="SELECT * FROM pass WHERE pass.id="+"'"+req.params.op_ID+"'"; //
		if(limiter==undefined || Number.isInteger(Number(limiter))==false){}
			else{
				myQuery=myQuery +" LIMIT " +Number(limiter);
			}

			console.log(myQuery)
			con.query(myQuery, function (err, result, fields){
				if (err) throw err;
				res.send(result);
			});
		});


}

router.get('/ChargesBy/:op_ID/:date_from/:date_to',chargesBy)
module.exports = router;
