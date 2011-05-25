// $Id$

/**
 * Ting facet browser configuration function.
 */
Drupal.tingFacetBrowser = function(facetBrowserElement, searchResultElement, result) {
  this.searchResultElement = searchResultElement;
  this.facetBrowserElement = facetBrowserElement;

  this.renderFacetBrowser = function(element, result) {
	var htmlList = [],
	facet = {},
	$template = $('<div class="collapsed"><h4></h4><ul style="display:none;"><li><a href="#"></a></li></ul></div>');
			
	$.each(result.facets, function(index, value) {
		var $html = $template.clone(true).remove('li');
		facet = {
			name: value.name
			, translated: (Drupal.settings.tingResult.facetNames[value.name]) ? Drupal.settings.tingResult.facetNames[value.name] : value.name
			, stripped: value.name.replace('.', '')
		};

		$html.find('h4')
      .click(function(e) {
        var $parent = $(this).parent('div');
        
        if ($parent.hasClass('collapsed')) {
				  //Show the current facet
          if (Drupal.settings.druPac.skipEffects) {
            $parent.removeClass('collapsed').addClass('expanded').find('ul').show();            
          } else {
            $parent.removeClass('collapsed').addClass('expanded').find('ul').slideDown();
          }
				} else {
				  //Hide the current facet
          if (Drupal.settings.druPac.skipEffects) {
						$parent.removeClass('expanded').addClass('collapsed').find('ul').hide();
					} else {
					  $parent.removeClass('expanded').addClass('collapsed').find('ul').slideUp();
					}

				}
			})
			.text(facet.translated)
			.attr('id', 'dp-' + facet.stripped)
			.end();
							
		$.each(value.terms, function(key, value) {
			var $li = $template.find('li').clone(true);
			$li
				.find('a')
				.click(function(){
					$(this).parent('li').toggleClass('selected');
					Drupal.saveFacetState(facetBrowserElement);
					Drupal.updateSelectedUrl(facetBrowserElement);
					Drupal.doUrlSearch(facetBrowserElement, searchResultElement);
					return false;
				})
				.text(key+' ('+value+')')
				.attr('href', '#'+facet.name+':'+key)
				.end();

			$html
				.find('ul')
					.append($li)
					.end();
		});
		htmlList.push($html);
	});
	
	$(htmlList).appendTo(element);

  //Expand the elements from last if it is reload
  Drupal.settings.druPac.skipEffects = true;	
	$.each(Drupal.settings.druPac.expandedElms, function(i,v) {
    $('#'+i).click();
  });
  Drupal.settings.druPac.skipEffects = false;	

  };

  this.updateFacetBrowser = function(element, result) {
  	$(element).html('');
  	this.renderFacetBrowser(element, result);
  	return true;
  };

  this.updateSelectedUrl = function(element) {
    var facets, sort, vars;
    facets = '';
    $('.selected a', element).each(function(i, e) {
		facets += $(e).attr('href').substring(1)+';';
    });
    sort = Drupal.getAnchorVars().sort;
    vars = {};
    if (facets.length > 0) {
      vars.facets = facets;
    }
    if (sort) {
      vars.sort = sort;
    }
    Drupal.setAnchorVars(vars);
  };
  
  this.updateSelectedFacetsFromUrl = function(element) {
	var facets, match;
    if ($.url.attr('anchor')) {
      match = $.url.attr('anchor').match('facets=(([^:]*:[^;]*;)+)');
      if (match && match.length > 1) {
        facets = match[1].split(';');
        for (f in facets) {
          f = facets[f].split(':');
          if (f.length > 1) {
            $('a[href=#'+f[0]+':'+f[1]+']', element).parent('li').addClass('selected');
        		//make sure that we expand the facetgroups - with no effects

            Drupal.settings.druPac.skipEffects = true;
            //Make sure we expanded all the correct facets (this should only activate if it was URL search)!
            var $list = $('div.collapsed li.selected');
            
            $.each($list, function(index, value) {
              $(this)
                .parent('ul') //Stupid 1.2.6 - should be parentsUntil
                .parent('div.collapsed') //Stupid 1.2.6 - should be parentsUntil
                .find('h4').click();
            });
            Drupal.settings.druPac.skipEffects = false;

            //Make sure at least one is expanded!
            if (1 > $(facetBrowserElement+' div.expanded').length) {
              $(facetBrowserElement+' div.collapsed h4:first').click();
            }
          }
        }
      }
    }
    return $('.selected', element).size() > 0;
  };

  //Save all expanded h4
  this.saveFacetState = function(element) {
    var $facetBrowser = $(element);
    $.each($facetBrowser.find('div.expanded'), function(i,v) {
      Drupal.settings.druPac.expandedElms[$(this).find('h4').attr('id')] = true;
    });
  }

  this.bindSelectEvent = function() {
    return true; // yes nice - but needed because ting_result.js call this function
  }

	//initialization
	this.renderFacetBrowser(facetBrowserElement, result);
	if (this.updateSelectedFacetsFromUrl(facetBrowserElement)) {
		this.doUrlSearch(facetBrowserElement, searchResultElement);
	} else {
	  $(facetBrowserElement+' div.collapsed h4:first').click();
	}
};

//do we have an obj 
Drupal.settings = Drupal.settings || {};

Drupal.settings.druPac = {
  skipEffects: false,
  expandedElms: {}
}

//FIXME - find a better solution than doing this all the time
setInterval(function() {
  updateSocialservices();
}, 500);

