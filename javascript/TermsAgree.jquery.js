/**
 * Created by Josh Kosmala on 24/11/2014.
 */
(function($) {
    $(document).ready(function(){

        $("#Form_Form").submit(function() {
            var selectBox = $("#Form_Form_TermsAndConditions").val();
            if(selectBox == 1) {
                // Nothing
            } else {
                alert("Please agree to the Terms and Conditions before proceeding.");
                return false;
            }
        });
    })
})(jQuery);
