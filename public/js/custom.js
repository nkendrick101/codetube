$('#search-form').submit(function () {
    if ($.trim($("#search-input").val()) === "") {
        return false;
    }
});

var client = algoliasearch('2ZIRRHJHQD', '7c46f37c2fc05b633dd074bb6fa600e6');
var index = client.initIndex('videos');

autocomplete('#search-input', { hint: false }, [
    {
        source: autocomplete.sources.hits(index, { hitsPerPage: 6 }),
        displayKey: 'title',
        templates: {
            suggestion: (suggestion) => {
                return '<span>' + suggestion._highlightResult.title.value + '</span>' +
                       '<span>' + suggestion.visibility + '</span>';
            }
        }
    }
]).on('autocomplete:selected', function() {
   this.form.submit();
});