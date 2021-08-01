
 
 var url=config._url+'/';
 var Item = function () {
    
 
     var init = function () {
 
 
        handleChangeItem();
        handleChangeQuantity();
 
     };
 
     var handleChangeItem = function () {

         $('#item2').on('click', function () {
            
             var item= $(this).val();
             var quantity= $('#quantity').val();
             console.log(item);
             if (item) {
                 $.get(url+ item+'/'+quantity, function (data) {
                     if (data.length != 0) {
                        console.log(data);
                        $('#price').val(data.item.price);
                        $('#subtotal').text(data.subtotal);
                       
                     }
                     console.log(data);
                 }, "json");

             }
         })
    }
    var handleChangeQuantity  = function () {
        $('#quantity').on('change', function (){
            var quantity= $(this).val();
            var item= $('#item2').val();

            console.log(item);

            console.log(quantity);
            if (quantity) {
                $.get(url+ item+'/'+quantity, function (data) {
                    if (data.length != 0) {
                       console.log(data);
                       $('#subtotal').text(data.subtotal);
                      
                    }
                    console.log(data);
                }, "json");

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
 