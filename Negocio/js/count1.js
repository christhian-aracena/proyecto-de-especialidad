function animateCounter(selector, finalValue) {
    var counter = { var: 0 };
    TweenMax.to(counter, 3, {
        var: finalValue,
        onUpdate: function () {
            var number = Math.ceil(counter.var);
            $(selector).html(number);
            if (number === finalValue) { 
                TweenMax.killTweensOf(counter); // Detener la animación cuando se alcanza el valor final
            }
        },
        ease: Circ.easeOut
    });
}

animateCounter('.count1', 180-5);
animateCounter('.count2', 300-5);
animateCounter('.count3', 56-5);
animateCounter('.count4', 85-5);



