var express = require('express');
var router = express.Router();

router.get('/', function (req, res) {
    res.render('index', {page:'Home', menuId:'home'});
});

module.exports = router;