$(".read_button").click(function() {

    $(".matter").css("display", "block");
    //$(".matter").css("position", "fixed");
    $(".matter").css("transition", "all ease-in-out 1s");
    $(".projects_grid").css("filter", "blur(8px)")


})

$(".matter-back-icon").click(function() {

    $(".matter").css("display", "none");
    $(".matter").css("position", "none");
    $(".matter").css("transition", "all ease-in-out 1s");
    $(".projects_grid").css("filter", "blur(0px)")
})