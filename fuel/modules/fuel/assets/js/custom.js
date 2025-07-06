$(document).ready(function () {
    var typeValue = $('[name="type"]').val();

    function toggleAffiliatedCourses(value) {
        if (value == '2') {
            $('[name="affiliated_course"]').closest('.field').show();
        } else {
            $('[name="affiliated_course"]').closest('.field').hide();
        }
    }

    $('[name="type"]').on('change', function() {
        toggleAffiliatedCourses($(this).val());
    });

    toggleAffiliatedCourses(typeValue);
});
