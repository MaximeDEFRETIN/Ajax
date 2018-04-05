function checkLoginUnique() {
    $.post(
            '../../controllers/indexController.php',
            {
                checkLogin: $('#login').val()
            },
            function (checkLoginResult) {
                if (checkLoginResult == 1) {
                    $('#errorCheckLoginUnique').css('display', 'block');
                }else{
                    $('#errorCheckLoginUnique').css('display', 'none');
                }
            },
            'JSON'
            )
}

function checkMailUnique() {
    $.post(
            '../../controllers/indexController.php',
            {
                checkMail: $('#mail').val()
            },
            function (checkMailResult) {
                if (checkMailResult == 1) {
                    $('#errorCheckMailUnique').css('display', 'block');
                }else{
                    $('#errorCheckMailUnique').css('display', 'none');
                }
            },
            'JSON'
            )
}
