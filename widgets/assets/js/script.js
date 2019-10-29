const reviews = {
    init:function() {
        this.bindEvents();
    },
    bindEvents:function() {
        $(document).on('click', '.btn-review-like', function() {
            var el = $(this);
            $.ajax({
                url:el.attr('href'),
                success:function(data) {
                    if(data.status) {
                        el.find('.rating-like-dislike-likes').text(data.likes);
                        el.hasClass('liked') ? el.removeClass('liked') : el.addClass('liked');
                        el.parents('.rating-like-dislike').find('.btn-review-dislike').removeClass('liked');
                        el.parents('.rating-like-dislike').find('.rating-like-dislike-dislikes').text(data.dislikes)
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.btn-review-dislike', function() {
            var el = $(this);
            $.ajax({
                url:el.attr('href'),
                success:function(data) {
                    if(data.status) {
                        el.find('.rating-like-dislike-dislikes').text(data.dislikes);
                        el.hasClass('liked') ? el.removeClass('liked') : el.addClass('liked');
                        el.parents('.rating-like-dislike').find('.btn-review-like').removeClass('liked');
                        el.parents('.rating-like-dislike').find('.rating-like-dislike-likes').text(data.likes)
                    }
                }

            });
            return false;
        });
    }
};

reviews.init();

$(document).on('click','.review-sorter__link', function(e){
    e.preventDefault();
    var location = $(this).data('href');
    $('.review-block').css('opacity','0.5');
    history.pushState(null, '', location);
    $('.reviews-list-widget').load(location + ' .review-list-wrapper', function(){
        $('.review-block').css('opacity',1);
    });
    return false;
});