$(document).ready(function () {

    $('.dropdown-item').on('click', function (e) {
        console.log('wot');
        if ($(this).attr('id') === 'dropdown-brand-item') {
            let brand_id = $(this).data('value');
            let brand_name = $(this).data('name');

            let dropdown_model_ul = $('#dropdown-model-ul');
            dropdown_model_ul.empty();

            updateDropdownText('brand', brand_name);
            updateDropdownText('model', 'Pasirinkite');

            $.get("/api/models/" + brand_id, function () {
                console.log('Fetching');
            })
                .done(function (models) {

                    let model = 0;
                    for (model; model < models.length; model++) {
                        console.log(models[model]);
                        let element = '<li class="dropdown-item" id="dropdown-model-item" data-id="'+models[model]['model_id']+'" data-name="'+models[model]['model_name']+'"><a href="#">'+models[model]['model_name']+'</a></li>';
                        dropdown_model_ul.append(element);

                    }

                })
                .fail(function () {
                    alert('Klaida! Bandykite dar kartą.');
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
