var initializeModalButton = function(element, modal_target) {
    $(element).prop('href', modal_target);
};

var populateFormData = function(form_target, data) {
    for (var obj in data.input)
        $(form_target + " input[name='" + obj + "']").prop('value', data.input[obj]);

    for (var obj in data.select) {
        $(form_target + " select[name='" + obj + "']").val(data.select[obj]);
        //selection.find("option[value='" + data.select[obj] + "']").prop('selected', true);
    }
};

var initializeMaterialSelect = function() {
    $('select').material_select();
};

var initializeModal = function() {
    $('.modal').modal();
};

var initializeDatepicker = function() {
    $('.datepicker').pickadate({
        format: "dd-mm-yyyy"
    });
}