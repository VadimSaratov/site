/**
 * Created by Vadim on 19.10.2017.
 */
$(document).ready(function () {
    $("#menu ul ").hide();
    $("#menu li a").click(function () {
        $(this).next().slideToggle("normal");
    });
    // $("a").click(function (e) {
    //     e.preventDefault();
    //     $("a").removeClass('active');
    //     $(this).addClass('active');
    // });
});
// $(document).ready(function () {
//     $("li").click(function (e) {
//         e.preventDefault();
//         $("li").removeClass('active');
//         $(this).addClass('active');
//     });
// });
