const $ = require('jquery');
window.$ = $;
const materialize = require("materialize-css/dist/js/materialize");
// const dt = require( 'datatables.net' );
// window.DataTable = dt;

require('materialize-css/dist/css/materialize.css');
require('../css/app.css');


$(document).ready(function(){

    M.AutoInit();

    $('select').material_select();
    // $('select').material_select();



    // global.table = $('#dataTableAdmin').DataTable({
    //     responsive: true,
    //     "ordering": true,
    //     "info": false,
    //     "lengthChange": false,
    //
    // });
    //
    // $('.responsive-table').DataTable();

});