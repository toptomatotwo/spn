jQuery(document).ready(function() {

      if(jQuery('li.menu-item-692').hasClass('active-trail') || (jQuery('li.menu-item-693').hasClass('active-trail')) || (jQuery('li.menu-item-720').hasClass('active-trail'))) {
        //if(true) {  
        //alert('true'); 
        jQuery('ul.primary-menu li.menu-533 a').addClass('active-trail');
        //alert('true');
        } 
       if(jQuery('li.menu-item-687').hasClass('active-trail') || (jQuery('li.menu-item-733').hasClass('active-trail')) || (jQuery('li.menu-item-685').hasClass('active-trail'))) { 

        jQuery('ul.primary-menu li.menu-539 a').addClass('active-trail');
      }
        if(jQuery('li.menu-item-780').hasClass('active-trail') || (jQuery('li.menu-item-781').hasClass('active-trail')) || (jQuery('li.menu-item-782').hasClass('active-trail'))) { 

        jQuery('ul.primary-menu li.menu-540 a').addClass('active-trail');
      }

function getAndShowWindowSize(){
    var width = window.innerWidth;
  //  alert('window resized');
    jQuery('#monitor').html(width);
  }

  getAndShowWindowSize();

  jQuery(window).resize(function() {
        getAndShowWindowSize();
    });

      //MOBILE SUB-MENU STUFF
    var searchDivOn = '';
  jQuery('a#mobile-search').click(function(event){
        jQuery('#block-search-form').fadeIn('slow');
        searchDivOn = true;
        alert(searchDivOn);
        event.stopPropagation();

      });
      
//      jQuery(':not(a#mobile-search), :not(#block-search-form)').click(function(){
//        jQuery(':not(a#mobile-search)').click(function(){  

        jQuery(':not(#block-search-form)').click(function(){  
          if(searchDivOn == true){
          jQuery('#block-search-form').fadeOut('fast');
          console.log('hello');
          searchDivOn = false;
          }
        });
    }) //END DOC READY 

    /* SOCIAL MEDIA BLOCK FOR EVENTS */
    jQuery('.twitter-share a span').click(function(){
      //alert('twitclicked');
      var width  = 575,
        height = 400,
        left   = (jQuery(window).width()  - width)  / 2,
        top    = (jQuery(window).height() - height) / 2,
        //url    = this.href,
        url = 'https://twitter.com/share',
        opts   = 'status=1' +
                 ',width='  + width  +
                 ',height=' + height +
                 ',top='    + top    +
                 ',left='   + left;
    
    window.open(url, 'twitter', opts);
    });

function fbshareCurrentPage()
    {window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false; }

    var url = window.location;  
    jQuery('.fb-share-button').attr('data-href', url);

    
