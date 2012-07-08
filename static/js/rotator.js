(function($){
window.Rotator = function($rotator, options){
    var self = this, timer = false, tick = 0;

    self.total_slides = 0;
    self.index = 0;
    self.options = {
        speed: 5000
    };


    self.init = function(options) {

        self.options = $.extend( self.options, options );
        self.total_slides = $rotator.find('li').length;
        self.index = 0;
        self.setListeners();
        self.startTimer();
        $rotator.find('li:eq(0)').addClass('active');
    };

    self.startTimer = function() {
        if( timer )
        {
            return false;
        }

        timer = setInterval(function(){ 
            tick += self.options.speed / (self.options.speed / 10);
            var percent = parseInt(tick / self.options.speed * 100);
            $rotator.find('.progress').css( 'width', percent + '%' );
            if( tick == self.options.speed + parseInt( self.options.speed / (self.options.speed / 10 )) )
            {
                self.nextSlide();
                tick = 0;
            }
        }, 10);

    };

    self.stopTimer = function() {
        timer = clearInterval( timer );
        timer = false;
    };

    self.setListeners = function() {
        $rotator.find('.title a').click(function(e){ 
            if( ! $(this).parents('li').hasClass('active') )
            {
                e.preventDefault();
                self.stopTimer();
                tick = 0;
                $rotator.find('.active').removeClass('active');
                $(this).parents('li').addClass('active');
                self.index = $rotator.find('li.active').index();
                self.startTimer();
            }
        });

        $rotator.find('li').mouseenter(function(e){
            self.stopTimer();
        });
        $rotator.find('li').mouseleave(function(e){
            self.startTimer();
        });
    };

    self.nextSlide = function(){
        self.stopTimer();
        self.index++;

        if( self.index == self.total_slides )
        {
            self.index = 0;
        }

        $rotator.find('.active').removeClass('active');
        $rotator.find('li:eq(' + self.index + ')').addClass('active');
        self.startTimer();
    };

    // Call our Constructor
    self.init(options);

};
})(jQuery);
