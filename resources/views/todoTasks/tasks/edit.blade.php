
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Tasks For '). ":  ( ". $todoList->todo_description . " )" }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('todo-tasks.update',$todotask->id) }}">
                        {{method_field("PATCH")}}
                        @csrf

                        <div class="form-group row">
                            <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('Todo List Description') }}</label>

                            <div class="col-md-6">
                                    <input id="task" type="text" class="form-control" name="task" required autocomplete="todo description" placeholder="Enter your Task here" value="{{ $todotask->task }}" autofocus >

                                    </input>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update List') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

