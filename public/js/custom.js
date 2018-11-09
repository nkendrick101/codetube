$("#message_body").maxlength({
    threshold: 6,
    alwaysShow: true,
    warningClass: "m-badge m-badge--rounded m-badge--wide m--margin-top-5",
    limitReachedClass:
        "m-badge m-badge--danger m-badge--rounded m-badge--wide m--margin-top-5",
    appendToParent: true,
    separator: " of ",
    preText: "You have ",
    postText: " chars",
    validate: true
});

$("#send-btn").on("click", function() {
    $(this)
        .removeClass()
        .addClass(
            "btn btn-block btn-focus m-btn m-btn--wide m-btn--air modal-btn m-loader m-loader--light"
        )
        .html("");
});

$("#search-form").submit(function() {
    if ($.trim($("#search-input").val()) === "") {
        return false;
    }
});

var client = algoliasearch("BHNLIWJU3E", "2e50ffd7be29006ad749f5cd0fbf040d");
var index = client.initIndex("videos");

autocomplete("#search-input", { hint: false }, [
    {
        source: autocomplete.sources.hits(index, { hitsPerPage: 6 }),
        displayKey: "title",
        templates: {
            suggestion: suggestion => {
                return (
                    "<span>" +
                    suggestion._highlightResult.title.value +
                    "</span>" +
                    "<span>" +
                    suggestion.visibility +
                    "</span>"
                );
            }
        }
    }
]).on("autocomplete:selected", function() {
    this.form.submit();
});
