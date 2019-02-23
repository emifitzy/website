const express = require('express');
const app = express();

app.listen(3000, function () {
  console.log('Example app listening on port 3000!')
});

app.set('view engine','ejs');

//make change in testfeature here

app.use(require('./routers/index'));
app.use(require('./routers/about'));