function logIn() {
    console.log('wtf');
    localStorage.setItem('loggedIn', true);
}

function logOut() {
    console.log('wtf2');
    localStorage.removeItem('loggedIn');
}

function isLoggedIn() {
    let status = localStorage.getItem('loggedIn');
    return status;
}

$(document).ready(function () {

    if (isLoggedIn()) {
        $('#login').hide();
        $('#logout').show();
    } else {
        $('#login').show();
        $('#logout').hide();
    }

    let manufacturerInput = $('#manufacturer');
    let modelInput = $('#model');
    let priceToInput = $('#priceTo');
    let priceFromInput = $('#priceFrom');

    let manufacturer = manufacturerInput.val();
    let model = modelInput.val();
    let priceTo = priceToInput.val();
    let priceFrom = priceFromInput.val();

    $('.shortcut').on('click', function () {

        $(manufacturerInput).val($(this).data('manufacturer'));
        onManufacturerChange($(this).data('manufacturer'));
        $('#info').fadeOut();

        setTimeout(function () {
            $('#results').fadeIn();
        }, 500);

    });

    manufacturerInput.on('change', function () {
        let value = $(this).val();

        onManufacturerChange(value);
    });

    modelInput.on('change', function () {

        model = $(this).val();

        updateResults();

    });

    $('#searchButton').on('click', function (e) {
        let results = $('#results');
        if (results.css('display') === "block") {

            updateResults(true);
        } else {
            $('#info').fadeOut();

            setTimeout(function () {
                $('#results').fadeIn();
            }, 500);
        }

        return false;
    });

    $('#results').on('click', '.classified', function () {
        window.open($(this).data('link'));
    });

    function onManufacturerChange(value) {
        model = "Modelis";

        manufacturer = value;

        let models;
        if (manufacturer == 'Audi') {
            models = ["A3", "A4", "A8", "A6", "TT", "A2", "Q5", "80", "100"];
        } else if (manufacturer == 'Ford') {
            models = ["Fiesta", "Mondeo", "C-MAX", "S-MAX", "B-MAX", "Taurus", "Mustang", "GT", "Focus"];
        } else if (manufacturer == 'BMW') {
            models = ["E36", "E38", "E39", "E46", "E52", "E70", "325i", "X3", "X5"];
        } else if (manufacturer == 'Volkswagen') {
            models = ["Amarok", "Caddy", "Jetta", "Passat", "Polo", "Routan", "Touareg", "Golf", "Beetle"];
        }

        $(modelInput).find('option').remove().end();

        $(modelInput).append("<option hidden>Modelis</option>");
        for (let i = 0; i < models.length; i++) {
            if ($(".classified[data-model*=" + models[i] + "]").length > 0) {
                $(modelInput).append("<option>" + models[i] + "</option>");
            }
        }

        updateResults();
    }

    function updateResults(clicked) {

        if (model === "Modelis") {

            if (manufacturer !== "Markė") {
                $(".classified[data-manufacturer*=" + manufacturer + "]").show();
                $(".classified:not([data-manufacturer*=" + manufacturer + "])").hide();
            }
        } else {
            $(".classified[data-manufacturer*=" + manufacturer + "][data-model*=" + model + "]").show();
            $(".classified:not([data-manufacturer*=" + manufacturer + "][data-model*=" + model + "])").hide();
        }

        if (typeof clicked !== "undefined") {
            $('#results').fadeOut();

            setTimeout(function () {
                //$('.classified').shuffle();
                $('#results').fadeIn("fast", function () {
                    recalculateGrid();
                });
            }, 500);
        } else {
            recalculateGrid();
        }

        return true;
    }

    function recalculateGrid() {

        if (manufacturer !== "Markė") {
            let visibleAds, nonVisible;

            if (model === "Modelis") {
                visibleAds = $(".classified[data-manufacturer*=" + manufacturer + "]");
                nonVisible = $(".classified:not([data-manufacturer*=" + manufacturer + "])");
            } else {
                visibleAds = $(".classified[data-manufacturer*=" + manufacturer + "][data-model*=" + model + "]");
                nonVisible = $(".classified:not([data-manufacturer*=" + manufacturer + "][data-model*=" + model + "])");
            }

            $('.classified').parent().remove();
            visibleAds.each(function (index) {

                $('#results').append($(this).parent());

            });

            nonVisible.each(function (index) {

                $('#results').append($(this).parent());

            });
        }
    }
});

(function ($) {

    $.fn.shuffle = function () {

        let allElems = this.get(),
            getRandom = function (max) {
                return Math.floor(Math.random() * max);
            },
            shuffled = $.map(allElems, function () {
                let random = getRandom(allElems.length),
                    randEl = $(allElems[random]).clone(true)[0];
                allElems.splice(random, 1);
                return randEl;
            });

        this.each(function (i) {
            $(this).replaceWith($(shuffled[i]));
        });

        return $(shuffled);

    };

})(jQuery);
