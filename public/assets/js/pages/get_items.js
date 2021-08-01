
 var url=config._url+'/';
 var Item = function () {
    
 
     var init = function () {
 
 
        handleChangeCounrty();
 
     };
 
     var handleChangeCounrty  = function () {
         $('#category').on('change', function () {
             var category= $(this).val();
             console.log(category);
             $('#item').html("");
             $('#item').html('<option  value="0">' +'none' + '</option>');
             items = "";
             if (category) {
                 $.get(url+ category, function (data) {
                     if (data.length != 0) {
                         for (var x = 0; x < data.length; x++) {
                             var item = data[x];
                             items  += '<option value="' + item.id + '">' + item.name + '</option>';
                         }
                         $('#item').append(items);
                     }
                 }, "json");
                 console.log(items);
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
     Item.init();
 });
 