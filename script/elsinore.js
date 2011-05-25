// $Id$

/**
 * @file
 * JavaScript tweaks for the Elsinore theme.
 */
Drupal.behaviors.elsinore = function () {
  // Check if the tabs lib is loaded before trying to call it.
  if ($.fn.tabs) {
    $("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 7000, true);
  }
};

//Wrap the socialservice call in a nice try/catch
function updateSocialservices() {
  try {
  	$('.dp-ting-object').socialservices();
  } catch(e) {
  	return;
  }
}

$(document).ready(function(){
    DD_belatedPNG.fix('#pageheader');
    DD_belatedPNG.fix('#pagebody');
    DD_belatedPNG.fix('#pagebody-inner');
    DD_belatedPNG.fix('#pagefooter');
    //DD_belatedPNG.fix('#featured li.ui-tabs-nav-item a');
    DD_belatedPNG.fix('div.jcarousel-next');
    DD_belatedPNG.fix('div.jcarousel-prev');
    DD_belatedPNG.fix('div.ding-library-map a.resize');
    DD_belatedPNG.fix('div#account-profile li.loans div.status span.warning');
    DD_belatedPNG.fix('div#account-profile li.reservations div.status span.ok');
    DD_belatedPNG.fix('div#pageheader-inner ul#helpers li a');
    
    //SS call!
    updateSocialservices();
});

$(function() {
	$("#user-login-form").bind("click keydown", function() {
		$(this).expose({
			onLoad: function() {
				$('#account').addClass('exposeOnLoad');
			},
			onClose: function() {
				$('#account').removeClass('exposeOnLoad');
			}
		});
	});
		
});
