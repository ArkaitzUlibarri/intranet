<div class="btn-group">
    <a class="btn btn-primary mr-1" data-toggle="tooltip" title="{{ trans('buttons.show') }}"  href="{{ route('projects.show', [$id]) }}">
        <i class="fa fa-eye"></i>
    </a>
    <a class="btn btn-warning mr-1" data-toggle="tooltip" title="{{ trans('buttons.edit') }}"  href="{{ route('projects.edit', [$id]) }}">
        <i class="fa fa-edit"></i>
    </a>
    <form id="project-delete" action="{{ route('projects.destroy',[$id]) }}" method="POST" enctype="multipart/form-data">
        {!! method_field('delete') !!}
        {!! csrf_field() !!}
        <button class="btn btn-danger mr-1" type="submit" data-toggle="tooltip" title="{{ trans('buttons.delete') }}" onclick="return confirm('{{ trans('messages.confirm') }}')">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
