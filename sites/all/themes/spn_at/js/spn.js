//alert('working');
var mobileSearchDiv = '';

jQuery(document).ready(function() {


//BOF SHOW WINDOW SIZE
  function getAndShowWindowSize(){
    var width = window.innerWidth;
    jQuery('#monitor').html(width);
  }

  getAndShowWindowSize();

  jQuery(window).resize(function() {
        getAndShowWindowSize();
    });
//EOF SHOW WINDOW SIZE

//BOF MAIN NAV
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
	//EOF MAIN NAV

//BOF HIDE SHOW MOBILE SEARCH BOX
jQuery('a#mobile-search').click(function(event){
    jQuery('#block-search-form').fadeIn('slow');
    mobileSearchDiv = true;
    //alert(mobileSearchDiv);
    event.stopPropagation();
  });

/*
jQuery(':not(#block-search-form)').click(function(){  
      if(mobileSearchDiv == true){
      jQuery('#block-search-form').fadeOut('fast');
      console.log('hello');
      mobileSearchDiv = false;
      }
    });
*/


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


}) //END DOC READY

function checkPass() {
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




