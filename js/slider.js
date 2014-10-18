Slider = function() {
    this.initialize();
}

$.extend(Slider.prototype, {
    initialize: function() {
        this.timer = null;
        $('#imageSlider ul.sliderContainer').children().hide().removeClass('active');
        $('#imageSlider ul.sliderContainer li:first').show().addClass('active');
        this.setScrollTimer();
        this.setupClickScrollTo();
    },

    setScrollTimer: function(){
        if(this.timer == null){
            this.timer = setInterval("slider.imageSliderPhotoNext()", 5000);
        }
    },

    setupClickScrollTo: function(){
        self = this;
        // left right
        $('#imageSlider ul.numbers li').click(function(event){
                var liId = $(event.target).text();
                var liToScroll = $('li#image'+liId);
                $(event.target).parent().children().removeClass('active');
                $(event.target).addClass('active');
                self.imageSliderPhotoScrollTo('li#image'+liId);
            });

        //direct click
        $('#imageSlider ul.arrows li').click(function(event){
                if($(event.target).text() == '<'){
                    self.imageSliderPhotoPrevious();
                } else if($(event.target).text() == '>'){
                    self.imageSliderPhotoNext();
                }
            });
    },

    setupImageSliderKeyListeners: function() {
        $(window).keypress(function(event) {
            if(event.keyCode == 39) {
                slider.imageSliderPhotoNext();
            }
            else if(event.keyCode == 37) {
                slider.imageSliderPhotoPrevious();
            }
        });
    },

    imageSliderPhotoScrollTo: function(li) {
        $(li).parent().children(':visible').fadeOut(250);
        $(li).fadeIn(250);
        if(this.timer != null){
            clearInterval(this.timer);
            this.timer = null;
            this.setScrollTimer();
        }
    },

    imageSliderPhotoPrevious: function() {
        if($('#imageSlider ul.numbers li:first').is('.active')) {
            $('#imageSlider ul.numbers li:last').click();
        }
        else {
            $('#imageSlider ul.numbers li.active').prev().click();
        }
    },

    imageSliderPhotoNext: function() {
        if($('#imageSlider ul.numbers li:last').is('.active')) {
            $('#imageSlider ul.numbers li:first').click();
        }
        else {
            $('#imageSlider ul.numbers li.active').next().click();
        }
    }
    
});

