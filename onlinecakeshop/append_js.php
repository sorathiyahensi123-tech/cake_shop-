<?php
$js = "
// Live Message Preview global function
function updateCakeMessage(msg) {
    document.querySelectorAll('.cake-msg-preview').forEach(el => {
        el.innerText = msg;
    });
}

// Wishlist Micro-interaction
$(document).ready(function() {
    $('.wishlist-icon').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(this).find('i').removeClass('far').addClass('fas');
        } else {
            $(this).find('i').removeClass('fas').addClass('far');
        }
    });

    // Add to cart bounce
    $('.btn-add-cart-bounce').on('click', function() {
        var btn = $(this);
        btn.addClass('btn-bounce-active');
        setTimeout(function() {
            btn.removeClass('btn-bounce-active');
        }, 400);
    });
});
";
file_put_contents('js/interactive.js', $js, FILE_APPEND);
echo "JS Appended!";
?>
