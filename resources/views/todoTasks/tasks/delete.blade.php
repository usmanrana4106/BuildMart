
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Delete Tasks For '). ":  ( ". $todoList->todo_description . " )" }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('todo-tasks.destroy',$todotask->id) }}">
                        {{method_field('DELETE')}}
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12">
                                <p style="font-size: 20px;"> <b> ARE you Sure you want to Delete this task !!!! </b></p>
                                <br>
                                <p> <label  class="col-md-4 col-form-label text-md-right"><b>{{ __('Todo List Description : ') }}</b></label>
                                    {{ $todotask->task }} </p>


                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Delete List') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

