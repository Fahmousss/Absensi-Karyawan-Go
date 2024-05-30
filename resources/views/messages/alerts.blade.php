@if (session('success'))
    <div class="alert alert-success solid alert-dismissible fade show">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                    class="mdi mdi-close"></i></span>
        </button>
        <strong>Success!</strong> {{ session('success') }}
    </div>
@elseif (session('warning'))
    <div class="alert alert-warning solid alert-dismissible fade show">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                    class="mdi mdi-close"></i></span>
        </button>
        <strong>Warning!</strong> {{ session('warning') }}
    </div>
@endif
