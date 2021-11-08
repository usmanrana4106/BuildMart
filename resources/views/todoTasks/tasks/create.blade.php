
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>{{ __('Create Tasks For '). ":  ( ". $list->todo_description . " )" }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('todo-tasks.store') }}">
                        @csrf
                        <input name="list_id" id="list_id" type="hidden" value="{{$list_id}}">
                        <div class="form-group row">
                            <br>
                            <br>
                            <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('Task : ') }}</label>

                            <div class="col-md-6">
                                    <input id="task" type="text" class="form-control" name="task" required autocomplete="todo description" placeholder="Enter your Task here" autofocus>
                                    </input>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Task') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

