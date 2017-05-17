$(document).ready(function () {
    // Search
    let buttonPressed = false;
    let carsAds = '#cars-ads';
    let body = 'body';

    let brandId, brandName;
    let modelId, modelName;

    $('.dropdown-item').on('click', function (e) {

        if ($(this).attr('id') === 'dropdown-brand-item') {
            brandId = $(this).data('value');
            brandName = $(this).data('name');

            let dropdownModelUl = $('#dropdown-model-ul');
            dropdownModelUl.empty();

            updateDropdownText('brand', brandName);
            updateDropdownText('model', 'Pasirinkite');

            updateDropdownValue('brand', brandId);
            updateDropdownValue('model', 0);

            $.get("/api/models/" + brandId, function () {
            })
                .done(function (models) {

                    let model = 0;
                    for (model; model < models.length; model++) {

                        let element = '<li class="dropdown-item" id="dropdown-model-item" data-id="' + models[model]['modelId'] + '" data-name="' + models[model]['title'] + '"><a href="#">' + models[model]['title'] + '</a></li>';
                        dropdownModelUl.append(element);

                    }

                })
                .fail(function () {
                    alert('Klaida! Pabandykite vėliau.');
                });
        }

        e.preventDefault();
    });

    $('#dropdown-model-ul').on('click', '#dropdown-model-item', function (e) {
        modelId = $(this).data('id');
        modelName = $(this).data('name');

        updateDropdownText('model', modelName);
        updateDropdownValue('model', modelId);

        e.preventDefault();
    });

    $('#search-submit').on('click', function (e) {

        let brandId = parseInt(getDropdownValue('brand'));
        let modelId = parseInt(getDropdownValue('model'));

        if (brandId <= 0 || modelId <= 0 || isNaN(brandId) || isNaN(modelId)) {
            alert('Pasirinkite markę ir modelį!');

            return false;
        }

        if (buttonPressed) {
            let carsDiv = $(carsAds);
            carsDiv.slideUp('fast');
            setTimeout(function () {
                carsDiv.remove();
            }, 300);
        }

        buttonPressed = true;

        $(body).addClass('loading');

        $.get("/api/cars/" + brandId + "/" + modelId, function () {
        })
            .done(function (cars) {

                $(body).removeClass('loading');

                $(carsAds).remove();
                $('#content').prepend(cars);

                $(carsAds).slideDown('fast');

                $('html, body').animate({
                    scrollTop: $(carsAds).offset().top
                }, 1000);

            })
            .fail(function () {
                alert('Klaida! Pabandykite vėliau.');
                $(body).removeClass('loading');
            });

        e.preventDefault();
    });

    function updateDropdownText(id, text) {
        $('#dropdown-current-' + id + '-text').text(text);
    }

    function updateDropdownValue(id, value) {
        $('#dropdown-current-' + id + '-text').attr('data-value', value);
    }

    function getDropdownValue(id) {
        return $('#dropdown-current-' + id + '-text').attr('data-value');
    }

    // Subscription
    $('#content').on('click', '#subscribe', function (e) {
        let email = $('#email').val();

        let postData = {
            email: email,
            brandId: brandId,
            modelId: modelId,
        };

        $.post("/api/subscribe", postData, function () {
        })
            .done(function (response) {
                //update subscription box


            })
            .fail(function () {
                alert('Klaida! Pabandykite vėliau.');
            });

        e.preventDefault();
    });
});
