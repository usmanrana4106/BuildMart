
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create Task') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('todo-tasks.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('Task') }}</label>

                                <div class="col-md-6">
                                    <textarea id="task" type="text" class="form-control" name="task" rows="5" cols="100" required autocomplete="firstName" placeholder="Enter your Task here" autofocus>
                                    </textarea>
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

