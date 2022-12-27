$(function() {
    "use strict";

    $(".preloader").fadeOut();
    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").on('click', function() {
        $("#main-wrapper").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
    });
    $(".search-box a, .search-box .app-search .srh-btn").on('click', function() {
        $(".app-search").toggle(200);
        $(".app-search input").focus();
    });

    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body, .page-wrapper").trigger("resize");
    $(".page-wrapper").delay(20).show();
    
    //****************************
    /* This is for the mini-sidebar if width is less then 1170*/
    //**************************** 
    var setsidebartype = function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        if (width < 1170) {
            $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
        } else {
            $("#main-wrapper").attr("data-sidebartype", "full");
        }
    };
    $(window).ready(setsidebartype);
    $(window).on("resize", setsidebartype);

    $(document).on("keyup", "#numberFormat", function() {
        this.value = accounting.formatMoney(this.value, "Rp ", ".");
    })

    $(document).on("keyup", "#numeric-data", function() {
        this.value = this.value.replace(/[^0-9]/, "");
    })

});

var notifSukses = function(msg) {
    $.notify.defaults({className : "success"})
    return $.notify(msg, {position : "bottom"});
}

var notifError = function(msg) {
    $.notify.defaults({className : "danger"})
    return $.notify(msg, {position : "bottom"});
}