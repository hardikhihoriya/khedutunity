$(document).ready(function () {
    $('#birthday-form').on('submit', function (e) {
        e.preventDefault();
        var BirthdayData = new FormData($(this)[0]);
        $.ajax({
            url: "{{ url('/savebirthday') }}",
            type: "POST",
            data: BirthdayData,
            cache: false,
            processData: false, // Don't process the files
            contentType: false,
            headers: {
                'X_CSRF_TOKEN': '{{ csrf_field() }}',
            },
            success: function (data) {
                var obj = jQuery.parseJSON(JSON.stringify(data));
                if (obj.success) {
                    $('#birthday-form')[0].reset();
                    $('#birthdaymsg').html(obj.success);
                    setTimeout(function () {
                        $("#birthdaymsg").hide();
                    }, 5000);
                } else if (obj.error) {
                    $('#birthdaymsg').html(obj.error);
                }
            }
        });
    });
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "{{ url('/savecontact') }}",
            type: "POST",
            data: formData,
            cache: false,
            processData: false, // Don't process the files
            contentType: false,
            headers: {
                'X_CSRF_TOKEN': '{{ csrf_field() }}',
            },
            success: function (data) {
                console.log(data);
                var obj = jQuery.parseJSON(JSON.stringify(data));
                if (obj.firstname) {
                    $('.first-name-error').css('display', 'block');
                    $('.first-name-error').html(obj.firstname);
                    setTimeout(function () {
                        $(".first-name-error").hide();
                    }, 10000);
                }
                if (obj.lastname) {
                    $('.last-name-error').css('display', 'block');
                    $('.last-name-error').html(obj.lastname);
                    setTimeout(function () {
                        $(".last-name-error").hide();
                    }, 10000);
                }
                if (obj.contactemail) {
                    $('.contact-email-error').css('display', 'block');
                    $('.contact-email-error').html(obj.contactemail);
                    setTimeout(function () {
                        $(".contact-email-error").hide();
                    }, 10000);
                }
                if (obj.contactsubject) {
                    $('.contact-subject-error').css('display', 'block');
                    $('.contact-subject-error').html(obj.contactsubject);
                    setTimeout(function () {
                        $(".contact-subject-error").hide();
                    }, 10000);
                }
                if (obj.messages) {
                    $('.contact-message-error').css('display', 'block');
                    $('.contact-message-error').html(obj.messages);
                    setTimeout(function () {
                        $(".contact-message-error").hide();
                    }, 10000);
                }
                if (obj.success) {
                    $('#contact-form')[0].reset();
                    $('#successmsg').html(obj.success);
                    setTimeout(function () {
                        $("#successmsg").hide();
                    }, 5000);
                } else if (obj.error) {
                    $('#successmsg').html(obj.error);
                }
            }
        });
    });
});
function toggleIcon(e) {
    $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

$(function () {
    $('input[name="birthdate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        yearRange: '1950:' + new Date().getFullYear().toString()
    },
            function (start, end, label) {
                var years = moment().diff(start, 'years');
            });
});