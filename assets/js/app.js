const $ = require('jquery');
window.$ = window.jQuery= $;
const materialize = require("materialize-css/dist/js/materialize");

require('materialize-css/dist/css/materialize.css');
require('../css/app.css');

require('material-icons/iconfont/material-icons.css');


$(document).ready(function(){
    M.AutoInit();
});