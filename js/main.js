$("document").ready(function(){
    $('#country').change(function(){
        var countryId = $(this).val().trim();
        console.log(countryId);
        $.ajax({
            url:"load_state.php",
            method: "POST",
            dataType: "text",
            data: {country_id:countryId},
            success: function(data){
                $('#state').html(data);
            }
        });
    });
});