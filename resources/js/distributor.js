$(function () {
//function to get form data
    var mydistdata;
    var getDistData = function () {
        var distributor = $('#distributor').val();
        var dist_website = $('#dist_website').val();
        mydistdata = {
            distributor: distributor,
            dist_website: dist_website
        };
    };

//check validation then INSERT new distributor data
    $('#submit_dist').on('click', function () {
        if (checkDistValid()) {
            addDistData();
        }
    });
// check validation then EDIT dist component data
    $('#update_dist').on('click', function () {
        var id = $('#dist_id').val();
        if (checkDistValid()) {
            updateDistData(id);
        }
    });


//INSERT new distributor data function
    var addDistData = function () {
        getDistData();
        mydistdata['submit_dist'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/distributorTable.php',
            type: 'post',
            data: mydistdata,
            success: function (data) {
                console.log(data);
                emptyDistFields();
            },
            error: function (data) {
                console.log(data);
            }
        };
        $.ajax(setting);
    };
//EDIT OR DELETE distributor data function
    var updateDistData = function (id) {
        getDistData();
        mydistdata['update_dist'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/distributorTable.php?id=' + id,
            type: 'get',
            data: mydistdata,
            success: function (data) {
                console.log(data);
                history.go(-1);
            },
            error: function (data) {
                console.log('server error');
            }
        };
        $.ajax(setting);
    };

//check form validation function
    var checkDistValid = function () {
        var valid = 1;
        if ($("#distributor").val() == '') {
            $("#distributor").parent('div').parent('div').addClass('has-error has-feedback');
            $("#distributor").after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            valid = 0;
        } else {
            $("#distributor").next('.form-control-feedback').hide();
            $("#distributor").parent('div').parent('div').removeClass('has-error has-feedback');
            $("#distributor").parent('div').children('span').remove();

        }
        return valid;
    };

//function to clear form data
    var emptyDistFields = function () {
        $('#distributor').val('');
        $('#dist_website').val('');
    };
});
                