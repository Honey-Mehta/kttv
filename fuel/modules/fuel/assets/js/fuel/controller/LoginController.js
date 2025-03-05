jqx.load('plugin', 'jquery.placeholder');
jqx.load('plugin', 'sha256.min');

fuel.controller.LoginController = jqx.lib.BaseController.extend({

    init: function(initObj) {
        fuel.controller.BaseFuelController.prototype.notifications.call(this);
        $('#user_name').focus();
        $('input').placeholder();
        this.add_edit();
        this._submit();
        this._super(initObj);
    },
    _submit: function() {
        $('#submit').click(function(e) {
            e.preventDefault();
            $('#form').submit();
            return false;
        });
    },
    add_edit: function(initSpecFields) {
        if (initSpecFields == null) initSpecFields = true;
        var _this = this;
        $(document).on('click', '#Login, #form input[type="submit"]', function(e) {

            var saltKey = $("#ci_csrf_token_CMS").val();
            $this = $(this);

            if ($this.hasClass('disabled') || _this.ajaxing || $('#form').data('disabled')) {
                return false;
            }

            let oldPass = $('#password').val() || '';
            let confirmPass = $('#password_confirm').val() || '';

            if (oldPass == '') {
                alert('Please enter password.');
                return false;
            }

            if (confirmPass != '' && confirmPass != oldPass) {
                alert('Confirm password must be same.');
                return false;
            }

            if (confirmPass != '') {
                if (!_this.checkPassword(confirmPass)) {
                    let msg = "Your new password must be at least 8 characters.\nYour new password must contain at least one upper letter, one lower letter and one digit.";
                    alert(msg);
                    return false;
                }
            }

            if (oldPass != '' && confirmPass != '') {
                $('#password').val(sha256(oldPass));
                $('#password_confirm').val(sha256(confirmPass));
            } else {
                $('#password').val(sha256(sha256(oldPass) + saltKey));
            }

            // $('#password').val(saltKey + _this.preparePassword(sha256(oldPass)));
            // $('#password_confirm').val(saltKey + _this.preparePassword(sha256(confirmPass)));

            $('#form').submit();
            $this.attr('disabled', true);
            $this.addClass('disabled');
            return false;
        });
    },
    checkPassword: function(str) {
        var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return re.test(str);
    },
    preparePassword: function(str) {
        var preStr = str.toString().substring(4).toUpperCase();
        return preStr + '$#' + str;
    },
});