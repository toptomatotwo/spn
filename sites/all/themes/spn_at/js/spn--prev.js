/*
$( document ).ready(function() {
    console.log( "ready!" );
    alert("bunning");	
});
*/
//	alert("running");	
//(function ($) { 
  //jQuery code. Will proceed with a gif related example.
    
   
    	
  //End of gif related example. Put your code between these comments;
//})(jQuery);

jQuery(document).ready(function() {



  function getAndShowWindowSize(){
    var width = window.innerWidth;
  //  alert('window resized');
    jQuery('#monitor').html(width);
  }

  getAndShowWindowSize();


  
  jQuery(window).resize(function() {
        getAndShowWindowSize();
    });


  	jQuery(window).load(function () {
    	
    	
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
		
      //MOBILE SUB-MENU STUFF
      mobileSearchState = '';

      jQuery('#mobile-menu-a').click(function(){
        url = document.URL;
        //alert(url);
        //if(){
        //jQuery('#about-menu-mobile-popup').css({ "display": "block"});
        jQuery('#about-menu-mobile-popup').fadeToggle('slow');
        mobileSearchState = true;
          //  }
      })
      if(mobileSearchState == true) {
      jQuery('not:#moble-menu-a').click(function(){
        alert('menu turning off');
        jQuery('#about-menu-mobile-popup').fadeToggle('fast');
      })

}


    }); //END DOCUMENT READY
    

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


    jQuery('a#mobile-search').click(function(){
        jQuery('#block-search-form').fadeIn('slow');
        searchMenuOn = true;
    });
    jQuery(document).mouseup(function(e){
      var container = jQuery('#block-search-form');
      if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
    })
      //jQuery('#block-search-form').fadeOut();
    

})

function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  

/*
(function ($, Drupal){
jQuery(window).load(function () {
  
    alert('test')
  });
})(jQuery, Drupal)
*/
