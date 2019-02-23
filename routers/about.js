var express = require('express');
var router = express.Router();

router.get('/about', function (req, res) {
    res.render('about', {page:'About', menuId:'about'});
});

//made change to develop branch before merge

module.exports = router;