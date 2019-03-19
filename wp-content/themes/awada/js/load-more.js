jQuery(document).ready(function ($) {
   /*----------------------------------------------------*/
    /*  Ajax Load More Posts
     /*----------------------------------------------------*/
    var $content = $('.ajax_posts');
    var $loader = $('#more_posts');
    var ppp = screenReaderText.ppp;
    $content.imagesLoaded(function(){
        $content.masonry({
            itemSelector: '.grid-item', 
        });
    });
    $loader.on( 'click', load_ajax_posts );
    function load_ajax_posts() {
        if (!($loader.hasClass('loading') || $loader.hasClass('post_no_more_posts'))) {
            var offset = $('.blog-masonry').find('.blog-carousel').length;
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: screenReaderText.ajaxurl,
                data: {
                    'ppp': ppp,
                    'offset': offset,
                    'action': 'awada_more_post_ajax'
                },
                beforeSend : function () {
                    $loader.button('loading');
                },
                success: function (data) {
                    var $data = $(data);
                    if ($data.length) {
                        var $newElements = $data.addClass('animated zoomIn').css('opacity',0);
                        $content.append($newElements).each(function(){
                            $content.imagesLoaded(function(){
                            $content.masonry({
                                itemSelector: '.grid-item',
                            });
                            
                        });
                            $content.masonry('reloadItems');
                        });
                        $newElements.animate({ opacity: 1 });
                        $content.masonry();
                        $loader.button('reset');
                    } else {
                        $loader.removeClass('loading').addClass('post_no_more_posts').html(screenReaderText.noposts);
                    }
                },
                error : function (jqXHR, textStatus, errorThrown) {
                    $loader.html($.parseJSON(jqXHR.responseText) + ' :: ' + textStatus + ' :: ' + errorThrown);
                    console.log(jqXHR);
                },
            });
        }

        offset += ppp;
        return false;
    }
});