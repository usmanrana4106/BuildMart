
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Delete Todo List') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('todoList.delete',$todoList->id) }}">
                        {{method_field('DELETE')}}
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12">
                                <p style="font-size: 20px;"> <b> ARE you Sure you want to Delete this List, if you do this all the tasks will be Deleted as well!!! </b></p>
                                <br>
                                    <p> <label  class="col-md-4 col-form-label text-md-right"><b>{{ __('Todo List Description : ') }}</b></label>
                                        {{ $todoList->todo_description }} </p>


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

