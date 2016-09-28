$(function () {
//function to get form data
    var mydistdata;
    var getDistData = function () {
        var distributer = $('#distributer').val();
        var dist_website = $('#dist_website').val();
        mydistdata = {
            distributer: distributer,
            dist_website: dist_website,
        };
    }

//check validation then INSERT new distributer data
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


//INSERT new distributer data function
    var addDistData = function () {
        getDistData();
        mydistdata['submit_dist'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/distributerTable.php',
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
//EDIT OR DELETE distributer data function
    var updateDistData = function (id) {
        getDistData();
        mydistdata['update_dist'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/distributerTable.php?id=' + id,
            type: 'get',
            data: mydistdata,
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/distributer.php";
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
        if ($("#distributer").val() == '') {
            $("#distributer").parent('div').parent('div').addClass('has-error has-feedback');
            $("#distributer").after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>')
            valid = 0;
        } else {
            $("#distributer").next('.form-control-feedback').hide();
            $("#distributer").parent('div').parent('div').removeClass('has-error has-feedback');
            $("#distributer").parent('div').children('span').remove();

        }
        return valid;
    };

//function to clear form data
    var emptyDistFields = function () {
        $('#distributer').val('');
        $('#dist_website').val('');
    };
});
                