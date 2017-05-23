$(document).ready(function () {
    // Search
    let buttonPressed = false;
    let carsAds = '#cars-ads';
    let body = 'body';

    let brandId, brandName;
    let modelId, modelName;
    let yearFrom = 0;
    let yearTo = 0;

    $('.dropdown-item').on('click', function (e) {
        let id = $(this).attr('id');

        if (id === 'dropdown-brand-item') {
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
        } else if (id === 'dropdown-year-from-item') {
            yearFrom = $(this).data('value');

            updateDropdownText('year-from', yearFrom);
            updateDropdownValue('year-from', yearFrom);
        } else if (id === 'dropdown-year-to-item') {
            yearTo = $(this).data('value');

            updateDropdownText('year-to', yearTo);
            updateDropdownValue('year-to', yearTo);
        }

        e.preventDefault();
        return true;
    });

    $('#dropdown-model-ul').on('click', '#dropdown-model-item', function (e) {
        modelId = $(this).data('id');
        modelName = $(this).data('name');

        updateDropdownText('model', modelName);
        updateDropdownValue('model', modelId);

        e.preventDefault();
        return true;
    });

    $('#search-submit').on('click', function (e) {

        let brandId = parseInt(getDropdownValue('brand'));
        let modelId = parseInt(getDropdownValue('model'));
        let yearFrom = parseInt(getDropdownValue('year-from'));
        let yearTo = parseInt(getDropdownValue('year-to'));

        if (!validateBrandModel(brandId, modelId) || !validateYearRange(yearFrom, yearTo)) {
            return false;
        }

        let yearQuery = '';
        if (yearFrom > 0 || yearTo > 0) {
            yearQuery = '?yearFrom=' + yearFrom + '&yearTo=' + yearTo;
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

        $.get("/api/cars/" + brandId + "/" + modelId + yearQuery, function () {
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
        return true;
    });

    function updateDropdownText(id, text) {
        $('#dropdown-current-' + id + '-text').text(text);
        return false;
    }

    function updateDropdownValue(id, value) {
        $('#dropdown-current-' + id + '-text').attr('data-value', value);
        return false;
    }

    function getDropdownValue(id) {
        return $('#dropdown-current-' + id + '-text').attr('data-value');
    }

    function validateBrandModel(brandId, modelId) {

        if (isNaN(brandId) || isNaN(modelId) || brandId <= 0 || modelId <= 0) {
            alert('Pasirinkite markę ir modelį!');

            return false;
        }

        return true;
    }

    function validateYearRange(yearFrom, yearTo) {
        let currentYear = new Date().getFullYear();

        if (isNaN(yearFrom) || isNaN(yearTo) || (yearFrom < 0 || yearFrom > currentYear) || (yearTo < 0 || yearTo > currentYear)) {
            alert('Pasirinkite automobilio pagaminimo metus!');

            return false;
        }

        if (yearFrom > yearTo) {
            alert('Neteisingai pasirinkti automobilio pagaminimo metai!');

            return false;
        }

        return true;
    }

    // Subscription
    $('#content').on('click', '#subscribe', function (e) {
        let email = $('#email').val();

        let postData = {
            email: email,
            brandId: brandId,
            modelId: modelId,
            yearFrom: yearFrom,
            yearTo: yearTo,
        };

        $.post("/api/subscribe", postData, function () {
        })
            .done(function () {
                //update subscription box
                alert('Atlikta!');

            })
            .fail(function () {
                alert('Klaida! Pabandykite vėliau.');
            });

        e.preventDefault();
        return false;
    });
});
