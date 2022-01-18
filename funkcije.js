$('#addMovieForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Movie is added :)'); 
            location.reload(true);
        } else {
            alert('Movie is not added :(');
            location.reload(true);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});

$('#btnDeleteMovie').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    request = $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: {'id': checked.val()}
    
    });


    request.done(function (data, textStatus, qXHR) {
        if(textStatus === 'success'){
            checked.closest('tr').remove();
            alert("Movie is deleted");
        } else {
            alert("Movie is not deleted");
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});

$('#btnEditMovie').click(function () {
    const checked = $('input[name=checked-donut]:checked');

    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        $('#movieNameId').val(response[0]['name']);
        $('#movieGenreId').val(response[0]['genre'].trim());
        $('#movieYearId').val(response[0]['year'].trim()); // mozda greska trim
        $('#id').val(checked.val());
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
        
    });

});

$('#editMovieForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();

    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Movie is edited!'); 
            location.reload(true);
        } else {
            alert('Movie is not edited!');
            location.reload(true);
        }
    });
    
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });
});