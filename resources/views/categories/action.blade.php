<div class="btn-group">
    <a class="btn btn-primary mr-1" data-toggle="tooltip" title="{{ trans('buttons.show') }}"  href="{{ route('categories.show', [$id]) }}">
        <i class="fa fa-eye"></i>
    </a>
    <a class="btn btn-warning mr-1" data-toggle="tooltip" title="{{ trans('buttons.edit') }}"  href="{{ route('categories.edit', [$id]) }}">
        <i class="fa fa-edit"></i>
    </a>
    <form id="category-delete" action="{{ route('categories.destroy',[$id]) }}" method="POST" enctype="multipart/form-data">
        {!! method_field('delete') !!}
        {!! csrf_field() !!}
        <button class="btn btn-danger mr-1" type="submit" data-toggle="tooltip" title="{{ trans('buttons.delete') }}" onclick="return confirm('{{ trans('messages.confirm') }}')">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
