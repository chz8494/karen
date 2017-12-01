jQuery(document).ready(function()
{
'use strict';
    jQuery(".hoverText").focus(function(srcc)
    {
        if (jQuery(this).val() == jQuery(this)[0].title)
        {
            jQuery(this).removeClass("hoverTextActive");
            jQuery(this).val("");
        }
    });
    
    jQuery(".hoverText").blur(function()
    {
        if (jQuery(this).val() == "")
        {
            jQuery(this).addClass("hoverTextActive");
            jQuery(this).val(jQuery(this)[0].title);
        }
    });
    
    jQuery(".hoverText").blur();        
});




(function(jQuery){
'use strict';
 jQuery.fn.extend({
 
 	customStyle : function(options) {
	  if(!jQuery.browser.msie || (jQuery.browser.msie&&jQuery.browser.version>6)){
	  return this.each(function() {
	  
			var currentSelected = jQuery(this).find(':selected');
			jQuery(this).after('<span class="customStyleSelectBox"><span class="customStyleSelectBoxInner">'+currentSelected.text()+'</span></span>').css({position:'absolute', opacity:0,fontSize:jQuery(this).next().css('font-size')});
			var selectBoxSpan = jQuery(this).next();
			var selectBoxWidth = parseInt(jQuery(this).width()) - parseInt(selectBoxSpan.css('padding-left')) -parseInt(selectBoxSpan.css('padding-right'));			
			var selectBoxSpanInner = selectBoxSpan.find(':first-child');
			selectBoxSpan.css({display:'inline-block'});
			selectBoxSpanInner.css({width:selectBoxWidth, display:'inline-block'});
			var selectBoxHeight = parseInt(selectBoxSpan.height()) + parseInt(selectBoxSpan.css('padding-top')) + parseInt(selectBoxSpan.css('padding-bottom'));
			jQuery(this).height(selectBoxHeight).change(function(){
				// selectBoxSpanInner.text(jQuery(this).val()).parent().addClass('changed');   This was not ideal
			selectBoxSpanInner.text(jQuery(this).find(':selected').text()).parent().addClass('changed');
				// Thanks to Juarez Filho & PaddyMurphy
			});
			
	  });
	  }
	}
 });
})(jQuery);

jQuery(function(){
'use strict';
jQuery('select#activity-filter-by, select#forums-order-by, select#members-order-by, #top-bar select#search-which, select#members-friends, select#blogs-order-by, select#notifications-sort-order-list, #group_members-order-by').customStyle();
});




(function(jQuery) {
'use strict';

    jQuery.organicTabs = function(el, options) {
    
        var base = this;
        base.jQueryel = jQuery(el);
        base.jQuerynav = base.jQueryel.find(".tabs-nav");
                
        base.init = function() {
        
            base.options = jQuery.extend({},jQuery.organicTabs.defaultOptions, options);
            
            // Accessible hiding fix
            jQuery(".hidden-tab").css({
                "position": "relative",
                "top": 0,
                "left": 0,
                "display": "none"
            }); 
            
            base.jQuerynav.delegate("li > a", "click", function() {
            
                // Figure out current list via CSS class
                var curList = base.jQueryel.find("a.current").attr("href").substring(1),
                
                // List moving to
                    jQuerynewList = jQuery(this),
                    
                // Figure out ID of new list
                    listID = jQuerynewList.attr("href").substring(1),
                
                // Set outer wrapper height to (static) height of current inner list
                    jQueryallListWrap = base.jQueryel.find(".list-wrap"),
                    curListHeight = jQueryallListWrap.height();
                jQueryallListWrap.height(curListHeight);
                                        
                if ((listID != curList) && ( base.jQueryel.find(":animated").length == 0)) {
                                            
                    // Fade out current list
                    base.jQueryel.find("#"+curList).fadeOut(base.options.speed, function() {
                        
                        // Fade in new list on callback
                        base.jQueryel.find("#"+listID).fadeIn(base.options.speed);
                        
                        // Adjust outer wrapper to fit new list snuggly
                        var newHeight = base.jQueryel.find("#"+listID).height();
                        jQueryallListWrap.animate({
                            height: newHeight
                        });
                        
                        // Remove highlighting - Add to just-clicked tab
                        base.jQueryel.find(".tabs-nav li a").removeClass("current");
                        jQuerynewList.addClass("current");
                            
                    });
                    
                }   
                
                // Don't behave like a regular link
                // Stop propegation and bubbling
                return false;
            });
            
        };
        base.init();
    };
    
    jQuery.organicTabs.defaultOptions = {
        "speed": 700
    };
    
    jQuery.fn.organicTabs = function(options) {
        return this.each(function() {
            (new jQuery.organicTabs(this, options));
        });
    };
    
})(jQuery);



jQuery(function() {
'use strict';
            jQuery("#tabs-container").organicTabs({
                "speed": 500
            });
});



jQuery(document).ready(function() { 
'use strict';
    jQuery('#banner').oneByOne({
		className: 'oneByOne1',
		showButton: true,  
		showArrow: false, 
		autoHideButton: false,	     
		easeType: 'random'
	});  
}); 



jQuery(function(){
'use strict';
var bracket1 = jQuery('#members-groups-li a span').text();
jQuery('#members-groups-li a span').text('('+ bracket1 +')');

var bracket2 = jQuery('#friends-personal-li a span').text();
jQuery('#friends-personal-li a span').text('('+ bracket2 +')');

var bracket3 = jQuery('#groups-personal-li a span').text();
jQuery('#groups-personal-li a span').text('('+ bracket3 +')');

var bracket4 = jQuery('#activity-all a span').text();
jQuery('#activity-all a span').text('('+ bracket4 +')');

var bracket5 = jQuery('#messages-personal-li a span').text();
jQuery('#messages-personal-li a span').text('('+ bracket5 +')');

var bracket6 = jQuery('#activity-friends a span').text();
jQuery('#activity-friends a span').text('('+ bracket6 +')');

var bracket7 = jQuery('#activity-groups a span').text();
jQuery('#activity-groups a span').text('('+ bracket7 +')');

var bracket8 = jQuery('#activity-favorites a span').text();
jQuery('#activity-favorites a span').text('('+ bracket8 +')');

var bracket9 = jQuery('#forums-groups-li a span').text();
jQuery('li#forums-groups-li a span').text('('+ bracket9 +')');

var bracket10 = jQuery('#blogs-all a span').text();
jQuery('#blogs-all a span').text('('+ bracket10 +')');

var bracket11 = jQuery('#blogs-personal a span').text();
jQuery('#blogs-personal a span').text('('+ bracket11 +')');

var bracket12 = jQuery('#blogs-personal-li a span').text();
jQuery('#blogs-personal-li a span').text('('+ bracket12 +')');

var bracket13 = jQuery('#notifications-personal-li a span').text();
jQuery('#notifications-personal-li a span').text('('+ bracket13 +')');

var bracket14 = jQuery('#media-personal-li a span').text();
jQuery('#media-personal-li a span').text(' ('+ bracket14 +')');

var bracket15 = jQuery('#media-groups-li a span').text();
jQuery('#media-groups-li a span').text(' ('+ bracket15 +')');

var bracket16 = jQuery('#events-groups-li a span').text();
jQuery('#events-groups-li a span').text(' ('+ bracket16 +')');

})



jQuery(function() {
'use strict';
jQuery('table tr.sticky div.topic-title a.forum-post-title').before('<span class="sticky-label">Sticky</span>');
jQuery('table tr.status-closed div.topic-title a.forum-post-title').before('<span class="closed-label">Closed</span>');
});
