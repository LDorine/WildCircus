require('../scss/places.scss');

let $addPlaceLink = $('<button class="add_place_link btn btnAddPlace">Ajouter une place</button>');
let $newLinkLiPlace = $('<p></p>').append($addPlaceLink);

$(document).ready(function () {
    // Get the ul that holds the collection of tags
    let $collectionHolder = $('ol.places');

    // add the "add a step" anchor and <li> to the .steps <ul>
    $collectionHolder.append($newLinkLiPlace);

    // count the current form inputs, use that as the new
    // index when inserting a new item
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPlaceLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new Step form (see code block below)
        addPlaceForm($collectionHolder, $newLinkLiPlace);
    });


});

//allow existing steps removal
$('button.remove-existing-place').click(function () {
    event.preventDefault();
    $(this).parent().remove();

    return false;
});

function addPlaceForm($collectionHolder, $newLinkLiPlace)
{
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newFormPlace = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an <li>, before the "Ajouter une étape" link <li>
    var $newFormLiPlace = $('<li></li>').append(newFormPlace);

    // Add a remove link <li>
    $newFormLiPlace.append('<button class="remove-tag btn btnRemovePlace">Supprimer cette place</button>');

    $newLinkLiPlace.before($newFormLiPlace);

    // handles the removal
    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}
