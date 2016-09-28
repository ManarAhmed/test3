$(function () {
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
            name,
            user_name,
            email,
            password,
            confirm_password,
            gender,
            position,
            allFields,
            tips;

    function getUserData() {
        name = $('#name').val();
        user_name = $('#user_name').val();
        email = $('#email').val();
        password = $("#password").val();
        confirm_password = $('#confirm_password').val();
        gender = $('#gender').val();
        position = $('#position').val();
        allFields = {
            name: name,
            user_name: user_name,
            email: email,
            password: password,
            gender : gender,
            position: position
        };
        tips = $(".validTips");
    }

    function updateTips(t) {
        tips.text(t);
        tips.show();
    }
    function checkMatched(o, n) {
        if (o.val() !== n.val()) {
            o.parent('div').parent('div').addClass('has-error');
            updateTips("Password doesn't matched");
            return false;
        } else {
            tips.hide();
            o.parent('div').parent('div').removeClass('has-error');
            return true;
        }
    }
    function checkList(o,n) {
        if (!o.val()) {
            o.parent('div').parent('div').addClass('has-error');
            updateTips("You must select your "+n);
            return false;
        } else {
            tips.hide();
            o.parent('div').parent('div').removeClass('has-error');
            return true;
        }
    }
    function checkLength(o, n, min, max) {
        if (o.val().length > max || o.val().length < min) {
            o.parent('div').parent('div').addClass('has-error');
            updateTips("Length of " + n + " must be between " +
                    min + " and " + max + ".");
            return false;
        } else {
            tips.hide();
            o.parent('div').parent('div').removeClass('has-error');
            return true;
        }
    }
    function checkRegexp(o, regexp, n) {
        if (!(regexp.test(o.val()))) {
            o.parent('div').parent('div').addClass('has-error');
            updateTips(n);
            return false;
        } else {
            tips.hide();
            o.parent('div').parent('div').removeClass('has-error');
            return true;
        }
    }

    function checkUser() {
        var valid = true;
        valid = valid && checkLength($('#name'), "name", 3, 16);
        valid = valid && checkRegexp($('#name'), /^[a-zA-Z]([a-z\s])+$/i, "Name may consist of a-z, A-Z, spaces.");

        valid = valid && checkLength($('#user_name'), "username", 3, 16);
        valid = valid && checkRegexp($('#user_name'), /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter.");

        valid = valid && checkLength($('#email'), "email", 6, 80);
        valid = valid && checkRegexp($('#email'), emailRegex, "email should be like manar.ahmed@yahoo.com");

        valid = valid && checkLength($('#password'), "password", 5, 16);
        valid = valid && checkRegexp($('#password'), /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9");

        valid = valid && checkLength($('#password'), "password", 5, 16);
        valid = valid && checkRegexp($('#password'), /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9");

        valid = valid && checkMatched($('#confirm_password'), $('#password'));

        valid = valid && checkList($('#position'),'position');
        valid = valid && checkList($('#gender'),'gender');

        return valid;
    }
    function addUser() {
        allFields['add_user'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/userTable.php',
            type: 'post',
            data: allFields,
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/user/login.php";
            },
            error: function (data) {
                console.log(data);
            }
        };
        $.ajax(setting);
    }
    function updateUser() {
        allFields['id'] = $('#user_id').val();
        allFields['update_user'] = 'ok';
        var setting = {
            url: 'http://localhost/EwestStore/db/userTable.php',
            type: 'post',
            data: allFields,
            success: function (data) {
                console.log(data);
                window.location.href = "http://localhost/EwestStore/user/profile.php";
            },
            error: function (data) {
                console.log(data);
            }
        };
        $.ajax(setting);
    }
//check validation then ADD new user
    $('#add_user').on('click', function () {
        getUserData();
        if (checkUser()) {
            addUser();
        }
    });

//check validation then UPDATE user
    $('#update_profile').on('click', function () {
        getUserData();
        if (checkUser()) {
            updateUser();
        }
    });

});