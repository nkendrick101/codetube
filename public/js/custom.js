AOS.init({
    easing: 'ease-out-back',
    duration: 1000
});

$('#search-form').submit(function () {
    if ($.trim($("#search-input").val()) === "") {
        return false;
    }
});

$('#search-input').focus(function () {
    $('.page-content').addClass('blur');
});

$('#search-input').blur(function () {
    $('.page-content').removeClass('blur');
});

/*var client = algoliasearch('GGK8JVIH46', 'd9d4195caee4226baa9dda7912b1853b');
var index = client.initIndex('forums');

autocomplete('#search-input', { hint: false }, [
    {
        source: autocomplete.sources.hits(index, { hitsPerPage: 6 }),
        displayKey: 'title',
        templates: {
            header: '<div class="aa-suggestions-category">Job results</div>',
            suggestion: (suggestion) => {            
                return '<span>' +
                    suggestion._highlightResult.title.value + '</span>' +
                    '<span>' + suggestion.category.name + '</span>';
            }
        }
    },
    {
        source: autocomplete.sources.hits(index, { hitsPerPage: 6 }),
        displayKey: 'address',
        templates: {
            header: '<div class="aa-suggestions-category">Forum results</div>',
            suggestion: (suggestion) => {            
                return '<span>' +
                    suggestion._highlightResult.title.value + '</span>' +
                    '<span>' + suggestion.category.name + '</span>';
            }
        }
    }
]).on('autocomplete:selected', function() {
   this.form.submit();
});*/