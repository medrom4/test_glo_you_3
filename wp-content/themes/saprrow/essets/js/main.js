jQuery(document).ready(function($) {
    var form = $('#contactForm');
    var action = form.attr('action');

    form.on('submit', function(event) {
        var formData = {
            contactName: $('#contactName').val(),
            contactEmail: $('#contactEmail').val(),
            contactSubject: $('#contactSubject').val(),
            contactMessage: $('#contactMessage').val()
        }

        $.ajax({
            type: "POST",
            url: action,
            data: formData
        }).done(function() {
            alert("Супер! Cообщение отправлено!");
        }).fail(function() {
            alert("Плёхо! Cообщение не отправлено!");
        });
        
        event.preventDefault();
        
    });
});
