
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-HKoQE36HtLF5197bKMEQxNCRg85tBk5mcLUj99nPoxTR+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$(document).on('click', '.delete', function (e) {
    var $id = $(this).attr('data-id');
    var skill_name = $(this).attr('data-skill_name');
    $('#Delete_id').val($id);
    $('#Name_Delete').val(skill_name);
    $('#confirmModal').modal('show')
});

$('.repeater').repeater({
    // (Optional)
    // start with an empty list of repeaters. Set your first (and only)
    // "data-repeater-item" with style="display:none;" and pass the
    // following configuration flag
    initEmpty: true,
    // (Optional)
    // "defaultValues" sets the values of added items.  The keys of
    // defaultValues refer to the value of the input's name attribute.
    // If a default value is not specified for an input, then it will
    // have its value cleared.
    defaultValues: {
        'text-input': 'foo'
    },
    // (Optional)
    // "show" is called just after an item is added.  The item is hidden
    // at this point.  If a show callback is not given the item will
    // have $(this).show() called on it.
    show: function () {
        $(this).slideDown();
    },
    // (Optional)
    // "hide" is called when a user clicks on a data-repeater-delete
    // element.  The item is still visible.  "hide" is passed a function
    // as its first argument which will properly remove the item.
    // "hide" allows for a confirmation step, to send a delete request
    // to the server, etc.  If a hide callback is not given the item
    // will be deleted.
    hide: function (deleteElement) {
        if(confirm('Are you sure you want to delete this element?')) {
            $(this).slideUp(deleteElement);
        }
    },
    // (Optional)
    // You can use this if you need to manually re-index the list
    // for example if you are using a drag and drop library to reorder
    // list items.
    ready: function (setIndexes) {
        $dragAndDrop.on('drop', setIndexes);
    },
    // (Optional)
    // Removes the delete button from the first list item,
    // defaults to false.
    isFirstItemUndeletable: true
});

</script>
