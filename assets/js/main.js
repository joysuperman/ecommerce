/*
* @Author: SUPERMAN
* @Date:   2022-09-26 04:01:19
* @Last Modified by:   SUPERMAN
* @Last Modified time: 2022-10-28 15:20:12
*/
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('form_validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
})();


// User Login
function user_login(){
    var email = jQuery("#login-email").val();
    var password = jQuery("#login-password").val();

    if (email !="" && password !="") {
        jQuery.ajax({
            url:'./partial/user-modiul/user_login.php',
            type: 'POST',
            data: 'email='+email+'&password='+password,
            success:function(result){
                if (result == 'wrong') {
                    jQuery(".error").html("Email OR Password Wrong");
                }

                if (result == 'sucess') {
                    window.location.href= "index.php";
                }
            }
        });
    }else{
        jQuery(".error").html("Empty Input");
    }
}


// User Register
function user_register(id="",type = ""){
    var f_name = jQuery("#register-fname").val();
    var l_name = jQuery("#register-lname").val();
    var email = jQuery("#register-email").val();
    var password = jQuery("#register-password").val();
    var new_pass = "";

    if (type == "edit_pass" && password != "") {
        if (jQuery("#n_password").val() == jQuery("#c_password").val()) {
            new_pass = jQuery("#c_password").val();
        }else{
            alert("New and confirm password Doesn't match");
        }
    }

    if (f_name!="" && l_name !="" && email !="" && password !="") {
        jQuery.ajax({
            url:'./partial/user-modiul/user_reg.php',
            type: 'POST',
            data: 'id='+id+'&type='+type+'&f_name='+f_name+'&l_name='+l_name+'&email='+email+'&password='+password+'&new_pass='+new_pass,
            success:function(result){
                if (result == 'present') {
                    jQuery(".error").html("Email Already Exist");
                }

                if (result == 'insert') {
                    jQuery(".error").html("Thank You For Register");
                    jQuery(".error").removeClass('text-danger');
                    jQuery(".error").addClass('text-success');
                }

                if (result == 'edit') {
                    jQuery(".error").html("User Edit Successfully!");
                    jQuery(".error").removeClass('text-danger');
                    jQuery(".error").addClass('text-success');
                }

                if (result == 'old_in') {
                    jQuery(".error").html("Old Pasword Didn't Match!");
                }

            }
        });
    }else{
        jQuery(".error").html("Empty Input");
    }
}

// Order Info
function order_info_reg(id){
    var s_firstName = jQuery("#firstName").val();
    var s_lastName = jQuery("#lastName").val();
    var s_address = jQuery("#address").val();
    var s_country = jQuery("#country").val();
    var s_state = jQuery("#state").val();
    var s_zip = jQuery("#zip").val();

    var b_firstName = jQuery("#firstNameAddress").val();
    var b_lastName = jQuery("#lastNameAddress").val();
    var b_address = jQuery("#addressAddress").val();
    var b_country = jQuery("#countryAddress").val();
    var b_state = jQuery("#stateAddress").val();
    var b_zip = jQuery("#zipAddress").val();

    var isChecked = $('#same-address').is(':checked');
    
    if(isChecked) {
        b_firstName = s_firstName;
        b_lastName = s_lastName;
        b_address = s_address;
        b_country = s_country;
        b_state = s_state;
        b_zip = s_zip;
    }

    if (s_firstName!="" && s_lastName !="" && s_address !="" && s_country !="" && s_state!="" && s_zip !="") {
        jQuery.ajax({
            url:'./partial/user-modiul/user_info.php',
            type: 'POST',
            data: 'id='+id+'&s_firstName='+s_firstName+'&s_lastName='+s_lastName+'&s_address='+s_address+'&s_country='+s_country+'&s_state='+s_state+'&s_zip='+s_zip+'&b_firstName='+b_firstName+'&b_lastName='+b_lastName+'&b_address='+b_address+'&b_country='+b_country+'&b_state='+b_state+'&b_zip='+b_zip,
            success:function(result){
                if (result == 'present') {
                    jQuery(".error").html("Please Login!");
                }

                if (result == 'insert') {
                    window.location.href ="checkout-shipping.php";
                }
            }
        });
    }else{
        jQuery(".error").html("Empty Input");
    }
}


// Order Process
function order_process(type = "",id){
    var total_amount = jQuery("#grand-total").text();
    var shipping_method  = jQuery("input[name='checkoutShippingMethod']:checked").val();

    if ( id!="" && total_amount !="" && shipping_method !="") {
        jQuery.ajax({
            url:'./partial/user-modiul/user_shipping.php',
            type: 'POST',
            data: 'id='+id+'&type='+type+'&total_amount='+total_amount+'&shipping_method='+shipping_method,
            success:function(result){
                if (result == 'present') {
                    jQuery(".error").html("Please Login!");
                }   
                if (result == 'insert') {
                    window.location.href = "checkout-payment.php";
                }


                console.log(result);
            }
        });
    }else{
        jQuery(".error").html("Empty Input");
    }
}



// Add To Cart
var count = 0;
function manage_cart(id, type, quntity=""){
    var qnt = "";
    var size = jQuery("#size").text();
    if (type == 'remove') {
        qnt = quntity - 1;
    }else{
        qnt = ++count;
    }

    jQuery.ajax({
        url:'./partial/add-to-cart/manage_cart.php',
        type: 'POST',
        data: 'id='+id+'&qnt='+qnt+'&size='+size+'&type='+type,
        success:function(result){
            if (type == 'remove') {
                window.location.href = window.location.href;
            }
            
            jQuery("#cart_total").html(result);
        }
    });
}

// User Account Pasword Change
function acc_change_pass(){
    if(jQuery("#change_user_pass").hasClass('d-none')){
        jQuery("#change_user_pass").removeClass('d-none');
        jQuery("#change_user_info").addClass('d-none');
    }else{
        jQuery("#change_user_pass").removeClass('d-none');
        jQuery("#change_user_info").addClass('d-block');
    }
}



// Short Product
function short_product_drop(position, id, site_path){
    var short_product_id = jQuery ("#short_product_id").val();

    if (position == "category") {
        window.location.href = site_path+"category.php?id="+id+"&short_by="+short_product_id;
    }

    if (position == "product") {
        window.location.href = site_path+"product.php?id="+id+"&short_by="+short_product_id;
    }
    
}


// Shipping Cost
function add_shipping_cost(){
    var method = jQuery("input[name='checkoutShippingMethod']:checked").val();
    var subtotal = jQuery("#sub_total").text();
    jQuery("#shipping_price").html(method);
    jQuery("#grand-total").html((parseFloat(method) + parseFloat(subtotal)));
}