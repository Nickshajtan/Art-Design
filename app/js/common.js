jQuery(function($) {
    width = $(window).width();
    height = $(window).height();
    //Home page
    $(document).on('click', '.grid__block', function(){
       var link = $(this).find('a.btn').attr('href');
       window.location.href = link;
    });
    //Fancybox
    $('.fancybox').fancybox();
    //Slick arrows
    $('.slick').each(function(){
            var list = $(this).find('.slick-dots');
            var next = $(this).find('.slick-next');
            var prev = $(this).find('.slick-prev');
            list.prepend(next);
            list.prepend(prev);
    });
    //Taxonomy
    $('.brands .check').on('click', function(){
        $(this).addClass('active');
        window.location.href = $(this).parent('a').attr('href');
    });
    
    $('a .ask').on('click', function(e){
       e.preventDefault();
       window.location.href = home_url + '/calc'; 
    });
    //Accordeon
    if (width <= 1200) {
        $('.accordeon-header').on('click', function(){
            $(this).toggleClass('active');
            var bodyName = $(this).attr('data-for');
            $('.accordeon-text').each(function(){
                var body = $(this).attr('data-body');
                if( body == bodyName ){
                    $(this).toggleClass('active');
                }
            });
        });
    }
    //Header Menu
    $('.menu').find('ul').addClass('submenu');
    if(width <= 1200) {
         $('.menu-item-has-children').on('click', function(){
             $(this).find('.submenu').toggleClass('show');
         });
         $('.burger').on('click', function(){
             $('header').toggleClass('active');
         });
         $('.closer').on('click', function(){
             $('header').removeClass('active');
         });
    }
});