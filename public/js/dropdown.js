function getStateByCountry() {
    var countryId = $("#country").val();
    $.post("index.php?action=checkout",{countryId:countryId},function (response) {
        var data = response;
        $("#state").html(data);
    });
}