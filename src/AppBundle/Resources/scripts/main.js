$(document).ready(function () {

    $('.dropdown-item').on('click', function (e) {

        if ($(this).attr('id') === 'dropdown-brand-item') {
            let brand_id = $(this).data('value');
            let brand_name = $(this).data('name');

            let dropdown_model_ul = $('#dropdown-model-ul');
            dropdown_model_ul.empty();

            updateDropdownText('brand', brand_name);
            updateDropdownText('model', 'Pasirinkite');

            $.get("/api/models/" + brand_id, function () {
            })
                .done(function (models) {

                    let model = 0;
                    for (model; model < models.length; model++) {

                        let element = '<li class="dropdown-item" id="dropdown-model-item" data-id="' + models[model]['modelId'] + '" data-name="' + models[model]['title'] + '"><a href="#">' + models[model]['title'] + '</a></li>';
                        dropdown_model_ul.append(element);

                    }

                })
                .fail(function () {
                    alert('Klaida! Pabandykite vėliau.');
                });
        }

        e.preventDefault();
    });

    $('#dropdown-model-ul').on('click', '#dropdown-model-item', function (e) {
        let model_id = $(this).data('value');
        let model_name = $(this).data('name');

        updateDropdownText('model', model_name);

        e.preventDefault();
    });

    function updateDropdownText(id, text) {
        $('#dropdown-current-' + id + '-text').text(text);
    }
});
