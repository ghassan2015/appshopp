<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="">
@lang('admin.Delete Brands')
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.option.delete')}}" method="post">
                    @csrf
                    <h4>@lang('message.message_not_delete')</h4>
                    <input type="hidden">
                    <input id="Delete_id" type="hidden" name="id" class="form-control">
                    <input id="Name_Delete" type="text" name="Name_Delete" class="form-control" disabled>


                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-danger"><span><i
                                    class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span>@lang('admin.submit')
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-window-close" aria-hidden="true">@lang('admin.cancel')</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
