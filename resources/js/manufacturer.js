$(function () {
//function to get form data
    var mymanudata;
    var getManuData = function () {
        var manufacturer = $('#manufacturer').val();
        var manu_website = $('#manu_website').val();
        mymanudata = {
            manufacturer: manufacturer,
            manu_website: manu_website,
            
        };
    }

//check validation then INSERT new manufacturer data
    $('#submit_manu').on('click', function () {
        if (checkManuValid()) {
            addManuData();
        }
    });  
// check validation then EDIT manu component data
    $('#update_manu').on('click', function () {
        var id = $('#manu_id').val();
        if (checkManuValid()) {
            updateManuData(id);
        }
    });
    
    
//INSERT new manufacturer data function
    var addManuData = function () {
        getManuData();
        mymanudata['submit_manu']='ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/manufacturerTable.php',
            type: 'post',
            data: mymanudata,
            success: function (data) {
                console.log(data);
                emptyManuFields();
            },
            error: function (data) {
                console.log(data);
            }
        };
        $.ajax(setting);
    };
//EDIT OR DELETE manufacturer data function
    var updateManuData = function (id) {
        getManuData();
        mymanudata['update_manu']='ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/manufacturerTable.php?id=' + id,
            type: 'get',
            data: mymanudata,
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/manufacturer.php";
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };

//check form validation function
    var checkManuValid = function () {
        var valid = 1;
        if ($("#manufacturer").val() == '') {
            $("#manufacturer").parent('div').parent('div').addClass('has-error has-feedback');
            $("#manufacturer").after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>')
            valid = 0;
        } else {
            $("#manufacturer").next('.form-control-feedback').hide();
            $("#manufacturer").parent('div').parent('div').removeClass('has-error has-feedback');
            $("#manufacturer").parent('div').children('span').remove();

        }
        return valid;
    };
    
//function to clear form data
    var emptyManuFields = function () {
        $('#manufacturer').val('');
        $('#manu_website').val('');
    };
});
                