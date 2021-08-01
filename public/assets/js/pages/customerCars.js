
 var url=config._url+'/';
 var Car = function () {
    
 
     var init = function () {
 
 
        handleChangeCustomer();
 
     };
 
     var handleChangeCustomer  = function () {
         $('#customer').on('change', function () {
             var customer= $(this).val();
             console.log(customer);
             $('#car').html("");
             $('#car').html('<option selected value="0">' +'none' + '</option>');
             cars = "";
             if (customer) {
                 $.get(url+ customer, function (data) {
                    console.log(data);
                     if (data.length != 0) {
                         for (var x = 0; x < data.length; x++) {
                             var item = data[x];
                             cars  += '<option value="' + item.id + '">' + item.name + ' '+ item.color+ '</option>';
                         }
                         $('#car').append(cars);
                     }
                 }, "json");
                 console.log(cars);
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
     Car.init();
 });
 