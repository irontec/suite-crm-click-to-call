
var phones = $('[type=phone]');
var baseUrl = window.siteUrl;

for (i = 0; i < phones.length; i++) {

    var phone = $(phones[i]);
    var callerButton = $(phone).attr('caller-button');

    if (callerButton === undefined) {

        var number = phone.text().trim();

        phone.append('<img src="' + baseUrl + '/themes/SuiteP/images/Calls.svg" alt="to call" class="click-to-call" data-number="' + number + '" />');
        $(phone).attr('caller-button', true);

    }

}

$('img.click-to-call:not(.binded)').addClass('binded').on('click', function() {

    var number = $(this).attr('data-number');

    $.ajax({
        type: "POST",
        url: baseUrl + '/index.php?entryPoint=clickToCall',
        data: {
            ext: window.extension,
            num: number
        },
        success: function (e) {
            console.warn(e);
        }
    });

});

