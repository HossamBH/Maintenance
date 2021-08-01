
 var url=config._url+'/';
 var Model = function () {
    
 
     var init = function () {
 
 
        handleChangeBrand();
 
     };
 
     var handleChangeBrand  = function () {
         $('#brand').on('change', function () {
             var brand= $(this).val();
             console.log(brand);
             $('#model').html("");
             $('#model').html('<option selected value="0">' +'none' + '</option>');
             models = "";
             if (brand) {
                 $.get(url+ brand, function (data) {
                    console.log(data);
                     if (data.length != 0) {
                         for (var x = 0; x < data.length; x++) {
                             var item = data[x];
                             models  += '<option value="' + item.id + '">' + item.name + '</option>';
                         }
                         $('#model').append(models);
                     }
                 }, "json");
                 console.log(models);
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
     Model.init();
 });
 