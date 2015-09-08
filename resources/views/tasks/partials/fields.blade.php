<div class='form-group'>
    <label for='title'>Title</label>
    <input name='title' class='form-control' value='{{ $record["title"] or '' }}'>
</div>
<div class='form-group'>
    <label for='description'>Description</label>
    <textarea type='textarea' name='description' class='textarea form-control'>{{ $record['description'] or '' }}</textarea>
</div>
<div class='form-group'>
    <label for='complete'>Complete</label>
    <input type='checkbox' name='complete' class='form-control' {{ ( !isset($record['complete']) || $record['complete'] == '' ? '' : 'checked') }} >
</div>
