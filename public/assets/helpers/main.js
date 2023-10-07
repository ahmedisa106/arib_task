//  global function when submit any form
$.ajaxSubmit = function (url, data, callback) {
    $.ajax({
        type: "post", url, data, contentType: false, cache: false, processData: false, beforeSend: function () {
            $('.error').remove();
            $('.errors_container').empty().addClass('d-none')
        }, complete: function (response) {
            if (response.status === 422) {
                let errors = response.responseJSON.errors;
                $.each(errors, function (key, value) {
                    let input = $(`input[name=${key}], textarea[name=${key}], select[name=${key}]`)
                    $(input).parent().append(`<span class="text-danger error">${value}</span>`)
                })
            } else if (response.status === 400) {
                $('.errors_container').text(response.responseJSON).addClass('alert alert-danger').removeClass('d-none');
            }
            callback(response);
        }

    })
}

// render data into table by ajax call
const getTableData = function (url = table_data_url, search = table_search, pagination = true, perPage = 10, columns = [], relations = []) {

    $.ajax({
        type: "get", url: url, data: {
            search: search, pagination, perPage, columns, relations
        }, beforeSend: function () {
            $('.pagination_component').remove();
        }, success: function (response) {
            $('table tbody').html(response.view);
            $('table').parent().append(response.pagination);
        }, error: function (response) {

        }
    })
}

//  event when click  on pagination button
$('body').on('click', '.page-link', function (e) {
    e.preventDefault();
    getTableData($(this).attr('href'), table_search, pagination, perPage, columns, relations)
});

/*search input*/
$('body').on('input change', '.table_search', function () {
    table_search = $(this).val();
    url = new URL(window.location.href);
    url.searchParams.set('search', table_search);
    window.history.replaceState('', '', url.href);
    getTableData(table_data_url, table_search, pagination, perPage, columns, relations);
})

// Delete Row from table
$.ajaxDeleteRow = function (url, target, callback) {
    $.ajax({
        type: "DELETE", url, data: {
            '_token': csrf_token
        }, beforeSend: function () {

        }, success: function () {
            target.parents('tr').remove();
            getTableData(table_data_url, table_search, pagination, perPage, columns, relations);
        }, error: function (response) {
            callback(response)
        }
    })
}
$('body').on('change', '.image', function (e) {
    $('.image_preview').attr('src', URL.createObjectURL(e.target.files[0]))
})
