$(document).ready(function(){
   

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $(".updateSectionstatus").click(function(){
       var status = $(this).text();
       var section_id = $(this).attr("section_id");
    //    alert(status);
    //    alert(section_id);
       $.ajax({
           type : 'post',
           url : '/categoryupdatestatus',
           data : {status:status, section_id:section_id},
           success:function(resp){
            if(resp['status'] == 0){
                $("#category-"+section_id).html("<a href='javascript:void(0)' class=' updateSectionstatus'>Deactive</a>");
            }else if(resp['status'] == 1){
                $("#category-"+section_id).html("<a href='javascript:void(0)' class=' updateSectionstatus'>Active</a>"); 
            }
           },error:function(resp){
            alert("error");
           }
       })

   });

    $(".updateProductstatus").click(function(){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
    //    alert(status);
    //    alert(section_id);
        $.ajax({
            type : 'post',
            url : '/productupdatestatus',
            data : {status:status, section_id:section_id},
            success:function(resp){
            if(resp['status'] == 0){
                $("#product-"+section_id).html("<a href='javascript:void(0)' class=' updateSectionstatus'>Deactive</a>");
            }else if(resp['status'] == 1){
                $("#product-"+section_id).html("<a href='javascript:void(0)' class=' updateSectionstatus'>Active</a>"); 
            }
            },error:function(resp){
            alert("error");
            }
        })



    });

    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.addcolor_button'); //Add button selector
        var wrapper = $('.field_wrappercolor'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="color[]" style="margin-right: 5px; margin-top: 5px;" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fas fa-trash-alt"></i></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper');
        var colors = $('#stockcolor').html();
        //Input field wrapper
        var fieldHTML = '<div><input type="text" name="size[]" style="margin-right: 5px; margin-top: 5px;" value=""/><select style="width: 200px; height: 27px; " name="colorid[]">'+colors+'</select> <input type="text" name="price[]" style="margin-right: 5px; margin-top: 5px;" required value=""/> <input type="text" name="stock[]" style="margin-right: 5px; margin-top: 5px;" required value=""/> <input type="text" name="sku[]" required style="margin-right: 5px; margin-top: 5px;" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fas fa-trash-alt"></i></a></div>'; 
        $('#color').append(fieldHTML);
        //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $('#input-qty').on("change", function() {
        calculatePrice();
    });
    $('#input-price').on("keyup", function() {
        var rate = $(this).val();
        alert(rate);
        calculatePrice();
    });
    

    function calculatePrice(){
        var quantity = $('#input-qty').val();
        var rate = $('#input-price').val();
        if(quantity != "" && rate != ""){
            var price = quantity * rate;
        }
        $('#input-total').val(price.toFixed());
    }


    $("#colorid").change(function(){
        var colorid = $(this).val();
        var product_id = $(this).attr("product-id")
        $.ajax({
            type : 'post',
            url : '/productgetpricolorupdate',
            data : {colorid:colorid, product_id:product_id},
            success:function(resp){
                $(".getAtrPrice").val(resp);
                calculatePrice();
               },error:function(resp){
                alert("Please Select Your color");
               }
        })
    })

    $("#sizecolor").change(function(){
        var colorid = $("#colorid").val();
        var size = $(this).val();
        var product_id = $(this).attr("product-id");

        $.ajax({
            type : 'post',
            url : '/productgetpriceupdate',
            data : {size:size, product_id:product_id,colorid:colorid},
            success:function(resp){
                $(".getAtrPrice").val(resp);
                calculatePrice();
               },error:function(resp){
                alert(" Your attribute Not Set ");
               }
        })
    });


    $("#purchasesubmit").submit(function(event){
        event.preventDefault(); /* prevent form submiting here */
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var supplier_id = $('#supplier_id').val();
        
        $.ajax({
            type : 'post',
            url : '/purchasereoprt',
            data : {fromdate:fromdate, todate:todate,supplier_id:supplier_id},
            success:function(resp){
                $(".tbody").html(resp);
               },error:function(resp){
                alert(" Your attribute Not Set ");
               }
        })
    });



    $("#purchasereturnsubmit").submit(function(event){
        event.preventDefault(); /* prevent form submiting here */
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var supplier_id = $('#supplier_id').val();
        
        $.ajax({
            type : 'post',
            url : '/purchasereturnreoprt',
            data : {fromdate:fromdate, todate:todate,supplier_id:supplier_id},
            success:function(resp){
                $(".tbody").html(resp);
               },error:function(resp){
                alert(" Your attribute Not Set ");
               }
        })
    });


    
    $("#salessubmit").submit(function(event){
        event.preventDefault(); /* prevent form submiting here */
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var customer_id = $('#customer_id').val();
        
        $.ajax({
            type : 'post',
            url : '/salesreoprt',
            data : {fromdate:fromdate, todate:todate,customer_id:customer_id},
            success:function(resp){
                $(".tbody").html(resp);
               },error:function(resp){
                alert(" Your attribute Not Set ");
               }
        })
    });

    $("#salesrtnsubmit").submit(function(event){
        event.preventDefault(); /* prevent form submiting here */
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var customer_id = $('#customer_id').val();
        
        $.ajax({
            type : 'post',
            url : '/salesreturnreoprt',
            data : {fromdate:fromdate, todate:todate,customer_id:customer_id},
            success:function(resp){
                $(".tbody").html(resp);
               },error:function(resp){
                alert(" Your attribute Not Set ");
               }
        })
    });
    

   
$(function() {
    // jQuery methods go here...
    
});
  
// $("#input-qty").on('keyup',function(){
//     total = $("#input-qty").val()* $("#input-price").val();
//     $("#input-total").val(total);
//  });



// $('#colorid').on('change',function(){
//     var colorid = $(this).val(); 
//     alert(colorid);
//     if(colorid){ 
//         $.ajax({
//            type:"GET",
//            url:"  getcolorlist/colorid/"+colorid,
//            success:function(res){               
//             if(res){
//                 $("#sizecolor").empty();
//                 $.each(res,function(key,value){
//                        $("#sizecolor").append('<option value="'+value.size+'" selected>'+value.sizee+'</option>');
                
//                 });
//             }else{
//                $("#city").empty();
//             }
//            }
//         });
//     }else{
//         $("#city").empty();
//     }    
//    });



});

