
 var url=config._url+'/';
 var Area = function () {
    
 
     var init = function () {
 
 
        handleChangeCity();
 
     };
 
     var handleChangeCity  = function () {
         $('#city').on('change', function () {
             var city= $(this).val();
             console.log(city);
             $('#area').html("");
             $('#area').html('<option selected value="0">' +'none' + '</option>');
             areas = "";
             if (city) {
                 $.get(url+ city, function (data) {
                     if (data.length != 0) {
                         for (var x = 0; x < data.length; x++) {
                             var item = data[x];
                             areas  += '<option value="' + item.id + '">' + item.name_en + '</option>';
                         }
                         $('#area').append(areas);
                     }
                 }, "json");
                 console.log(areas);
             }
         })
    }
 
 
 
     return {
         init: function () {
             init();
         }
     };
 
 }();
 jQuery(document).ready(function () {
     Area.init();
 });
 