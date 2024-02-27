/**
  * Template Name: Daily Shop
  * Version: 1.0
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS


  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER
  13. RELATED ITEM SLIDER (SLICK SLIDER)


**/

jQuery(function ($) {
    /* ----------------------------------------------------------- */
    /*  1. CARTBOX
  /* ----------------------------------------------------------- */

    jQuery(".aa-cartbox").hover(
        function () {
            jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
        },
        function () {
            jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
        }
    );

    /* ----------------------------------------------------------- */
    /*  2. TOOLTIP
  /* ----------------------------------------------------------- */
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

    /* ----------------------------------------------------------- */
    /*  3. PRODUCT VIEW SLIDER
  /* ----------------------------------------------------------- */

    jQuery("#demo-1 .simpleLens-thumbnails-container img").simpleGallery({
        loading_image: "demo/images/loading.gif",
    });

    jQuery("#demo-1 .simpleLens-big-image").simpleLens({
        loading_image: "demo/images/loading.gif",
    });

    /* ----------------------------------------------------------- */
    /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-popular-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-featured-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */
    jQuery(".aa-latest-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-testimonial-slider").slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
    });

    /* ----------------------------------------------------------- */
    /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-client-brand-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });

    /* ----------------------------------------------------------- */
    /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(function () {
        if ($("body").is(".productPage")) {
            var skipSlider = document.getElementById("skipstep");
            noUiSlider.create(skipSlider, {
                range: {
                    min: 0,
                    "10%": 10,
                    "20%": 20,
                    "30%": 30,
                    "40%": 40,
                    "50%": 50,
                    "60%": 60,
                    "70%": 70,
                    "80%": 80,
                    "90%": 90,
                    max: 100,
                },
                snap: true,
                connect: true,
                start: [20, 70],
            });
            // for value print
            var skipValues = [
                document.getElementById("skip-value-lower"),
                document.getElementById("skip-value-upper"),
            ];

            skipSlider.noUiSlider.on("update", function (values, handle) {
                skipValues[handle].innerHTML = values[handle];
            });
        }
    });

    /* ----------------------------------------------------------- */
    /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

    //Check to see if the window is top if not then display button

    jQuery(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".scrollToTop").fadeIn();
        } else {
            $(".scrollToTop").fadeOut();
        }
    });

    //Click event to scroll to top

    jQuery(".scrollToTop").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 800);
        return false;
    });

    /* ----------------------------------------------------------- */
    /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function () {
        // makes sure the whole site is loaded
        jQuery("#wpf-loader-two").delay(200).fadeOut("slow"); // will fade out
    });

    /* ----------------------------------------------------------- */
    /*  12. GRID AND LIST LAYOUT CHANGER
  /* ----------------------------------------------------------- */

    jQuery("#list-catg").click(function (e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").addClass("list");
    });
    jQuery("#grid-catg").click(function (e) {
        e.preventDefault(e);
        jQuery(".aa-product-catg").removeClass("list");
    });

    /* ----------------------------------------------------------- */
    /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(".aa-related-item-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });
});
function change_product_color_image(img, color) {
    jQuery("#color_id").val(color);

    jQuery(".simpleLens-big-image-container").html(
        '<a data-lens-image="' +
            img +
            '" class="simpleLens-lens-image"><img src="' +
            img +
            '" class="simpleLens-big-image"></a>'
    );
}
function showColor(size) {
    jQuery("#size_id").val(size);
    jQuery(".product_color").hide();
    jQuery(".size_" + size).show();
    jQuery(".size_link").css("border", "1px solid #ddd");
    jQuery("#size_" + size).css("border", "1px solid black");
}
function home_add_to_cart(id, size_str_id, color_str_id) {
    jQuery("#color_id").val(color_str_id);
    jQuery("#size_id").val(size_str_id);
    add_to_cart(id, size_str_id, color_str_id);
}
function add_to_cart(id, color_str_id, size_str_id) {
    jQuery("#add_to_cart_msg").html("");
    var size_id = jQuery("#size_id").val();
    var color_id = jQuery("#color_id").val();
    if (color_str_id == 0 && size_str_id == 0) {
        color_id = "no";
        size_id = "no";
    }
    if (size_id == "" && size_id != "no") {
        jQuery("#add_to_cart_msg").html(
            '<div width="15px" class="alert alert-warning alert-dismissible mt-4  show" role="alert"><strong>Please Select size</strong></div>'
        );
    } else if (color_id == "" && color_id != "no") {
        jQuery("#add_to_cart_msg").html(
            '<div class="alert alert-warning alert-dismissible mt-4 show" role="alert"><strong>Please Select Color</strong></div>'
        );
    } else {
        jQuery("#product_id").val(id);
        jQuery("#pqty").val(jQuery("#qty").val());
        jQuery.ajax({
            url: "/add_to_cart",
            data: jQuery("#frmAddToCart").serialize(),
            type: "post",
            success: function (result) {
                var totalPrice = 0;
                if(result.msg == "Not_Available"){
                    alert(result.data);
                }else{
                    alert("Product " + result.msg);

                    if (result.totalItem == 0) {
                        jQuery(".aa-cart-notify").html("0");
                        jQuery(".aa-cartbox-summary").remove();
                    } else {
                        jQuery(".aa-cart-notify").html(result.totalItem);
                        var html = "<ul>";
                        jQuery.each(result.data, function (arrKey, arrVal) {
                            totalPrice =
                                parseInt(totalPrice) +
                                parseInt(arrVal.qty) * parseInt(arrVal.price);
                            html +=
                                '<li><a class="aa-cartbox-img" href="#"><img src="' +
                                PRODUCT_IMAGE +
                                "/" +
                                arrVal.image +
                                '" alt="img"></a><div class="aa-cartbox-info"><h4><a href="#">' +
                                arrVal.name +
                                "</a></h4><p> " +
                                arrVal.qty +
                                " * Rs  " +
                                arrVal.price +
                                "</p></div></li>";
                        });
                    }
                    html +=
                        '<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">Rs ' +
                        totalPrice +
                        "</span></li>";
                    html +=
                        '</ul><a class="aa-cartbox-checkout aa-primary-btn" <a href="cart">Cart</a>';
                    console.log(html);
                    jQuery(".aa-cartbox-summary").html(html);
                }
            },
        });
    }
}
function deleteCartProduct(pid, color, size, attr_id, qty, price) {
    // Update hidden inputs
    $("#color_id").val(color);
    $("#size_id").val(size);
    $("#qty").val(qty);

    // Remove from UI
    $("#cart_box" + attr_id).hide();

    // Get CSRF token from the page
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    // Send AJAX request to update the server-side cart
    $.ajax({
        url: "/add_to_cart", // Adjust this URL to match your Laravel route for deletion
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        data: {
            pid: pid,
            color_id: color,
            size_id: size,
            pqty: 0, // Assuming you want to remove the item, set quantity to 0
            product_id: pid,
        },
        success: function (response) {
            // Handle success
            alert("Product " + response.msg);
        },
        error: function (error) {
            // Handle error (if needed)
            console.error(error);
        },
    });
}
function updateQty(pid, color, size, attr_id, price) {
    jQuery("#color_id").val(color);
    jQuery("#size_id").val(size);
    var qty = jQuery("#qty" + attr_id).val();
    jQuery("#qty").val(qty);
    add_to_cart(pid, size, color);
    jQuery("#total_price_" + attr_id).html("Rs " + qty * price);
}
function sort_by() {
    var sort_by_value = jQuery("#sort_by_value").val();
    jQuery("#sort").val(sort_by_value);
    jQuery("#categoryFilter").submit();
}
function funSearch() {
    var search = jQuery("#search").val();
    if (search != "" && search.length > 3) {
        window.location.href = "/search/" + search;
    }
}
function sort_price_filter() {
    jQuery("#filter_price_start").val(jQuery("#skip-value-lower").html());
    jQuery("#filter_price_end").val(jQuery("#skip-value-upper").html());
    jQuery("#categoryFilter").submit();
}

function setColor(color, type) {
    var color_str = jQuery("#color_filter").val();
    if (type == 1) {
        var new_color_str = color_str.replace(color + ":", "");
        jQuery("#color_filter").val(new_color_str);
    } else {
        jQuery("#color_filter").val(color + ":" + color_str);
        jQuery("#categoryFilter").submit();
    }

    jQuery("#categoryFilter").submit();
}

jQuery("#frmRegistration").submit(function (e) {
    e.preventDefault();
    $(".btn-submit").append('<i class="fa fa-spinner fa-spin" style="margin-left: 10px;"></i>');
    $(".btn-submit").attr("disabled", 'disabled');
    jQuery(".field_error").html("");
    jQuery.ajax({
        url: "registration_process",
        data: jQuery("#frmRegistration").serialize(),
        type: "post",
        success: function (result) {
            if (result.status == "error") {
                jQuery.each(result.error, function (Key, Val) {
                    jQuery("#" + Key + "_error").html(Val[0]);
                });
                $(".btn-submit").find(".fa-spinner").remove();
                $(".btn-submit").removeAttr("disabled");
            }
            if (result.status == "success") {
                // alert(result.status.msg);
                jQuery("#frmRegistration")[0].reset();
                jQuery("#success_msg").html(result.msg);
                jQuery("#success_msg").html(result.msg);
                $(".btn-submit").find(".fa-spinner").remove();
                $(".btn-submit").removeAttr("disabled");


            }
        },
    });
});

$("#frmLogin").submit(function (e) {
    e.preventDefault();
    $("#login_error").html("");
    $.ajax({
        url: "login_process",
        data: $("#frmLogin").serialize(),
        type: "post",
        success: function (result) {
            if (result.status === "error") {
                $("#login_error").html(result.msg);
            }
            if (result.status === "success") {
                window.location.href=window.location.href;

                // Redirect or perform additional actions for successful login
            }
        },
    });
});
function forget_password() {
    jQuery("#popup_forget").show();
    jQuery("#popup_login").hide();
}
$("#frmForget").submit(function (e) {
    e.preventDefault();
    $(".btn-submit").append(
        '<i class="fa fa-spinner fa-spin" style="margin-left: 10px;"></i>'
    );
    $(".btn-submit").attr("disabled", "disabled");
    $("#forget_error").html("");
    $.ajax({
        url: "/forget_password",
        data: $("#frmForget").serialize(),
        type: "post",
        success: function (result) {
            $("#forget_error").html(result.msg);
            $(".btn-submit").find(".fa-spinner").remove();
            $(".btn-submit").removeAttr("disabled");
        },
    });
});
$("#frmUpdatePassword").submit(function (e) {
    e.preventDefault();
    $("#password_msg").html("");
    $.ajax({
        url: "/forget_password_change_process",
        data: $("#frmUpdatePassword").serialize(),
        type: "post",
        success: function (result) {
            $("#password_msg").html(result.msg);
        },
    });
});
function show_login_popup() {
    jQuery("#popup_login").show();
    jQuery("#popup_forget").hide();
}
function ApplyCoupon(){
    jQuery("#coupon_msg").html("");
    var coupon_code = jQuery("#coupon_code").val();
    if(coupon_code != ""){
        jQuery.ajax({
            url: "/apply_coupon",
            data: 'coupon_code='+coupon_code+'&_token='+jQuery("[name='_token']").val(),
            type: "post",
            success: function (result) {

                if(result.status == "success"){
                    jQuery('.show_coupon_box').removeClass('hide');
                    jQuery('#coupon_code_str').html(coupon_code);
                    jQuery('#total_Price').html('Rs '+result.totalPrice);
                    jQuery('.apply_coupon_code_box').hide();
                }else{

                }
                jQuery("#coupon_msg").html(result.msg);


            },
        });
    }else{
        jQuery("#coupon_msg").html("Please enter coupon code");
    }
}
function remove_coupon_code(){
    jQuery("#coupon_msg").html("");
    var coupon_code = jQuery("#coupon_code").val();
    if(coupon_code != ""){
        jQuery.ajax({
            url: "/remove_coupon_code",
            data: 'coupon_code='+coupon_code+'&_token='+jQuery("[name='_token']").val(),
            type: "post",
            success: function (result) {

                if(result.status == "success"){
                    jQuery('.show_coupon_box').addClass('hide');
                    jQuery('#coupon_code_str').html('');
                    jQuery('#total_Price').html('Rs '+result.totalPrice);
                    jQuery('.apply_coupon_code_box').show();
                }else{

                }
                jQuery("#coupon_msg").html(result.msg);


            },
        });
    }
}
$("#frmPlaceOrder").submit(function (e) {
    e.preventDefault();
    $(".palceOrder").append('<h5>Loading...</h5>');
    $(".palceOrder").attr("disabled", "disabled");
    $("#order_placed_error_msg").html("");
    $.ajax({
        url: "/place_order",
        data: $("#frmPlaceOrder").serialize(),
        type: "post",
        success: function (result) {
            if(result.payment_url != ""){
                window.localStorage.setItem('stripeData', result.stripe);

                // Redirect to the payment URL
                window.location.href = result.payment_url;
            }else{
                $(".palceOrder").find(".fa-spinner").remove();
                $(".palceOrder").removeAttr("disabled");
                window.location.href="/thanks";
            }
            // (result.status == "success")
            // else{
            //     $("#order_placed_error_msg").html(result.msg);
            //     $(".palceOrder").find(".fa-spinner").remove();
            //     $(".palceOrder").removeAttr("disabled");


            // }

        },
    });
});

$("#frmProductReview").submit(function (e) {
    $("#faSpinner").append(
        '<i class="fa fa-spinner fa-spin" style="margin-left: 10px;"></i>'
    );
    $("#faSpinner").attr("disabled", "disabled");
    e.preventDefault();
    $("#password_msg").html("");

    // Get the selected star rating (as a string)
    var selectedRating = $("#selectedRating").val();

    // Append the selected rating to the form data
    $("#frmProductReview").append('<input type="hidden" name="rating" value="' + selectedRating + '">');

    $.ajax({
        url: "/product_review_process",
        data: $("#frmProductReview").serialize(),
        type: "post",
        success: function (result) {
            if (result.status == "success") {
                $("#faSpinner").find(".fa-spinner").remove();
                $("#faSpinner").removeAttr("disabled");
                $("#review_msg").html(result.msg);
                $("#frmProductReview")[0].reset();

                setInterval(function () {
                    window.location.href = window.location.href;

                }, 1000);
            }
            if (result.status == "error") {
                $("#faSpinner").find(".fa-spinner").remove();
                $("#faSpinner").removeAttr("disabled");
                // $("#frmProductReview")[0].reset();
                $("#review_msg").html(result.msg);
            }
        },
    });
});
