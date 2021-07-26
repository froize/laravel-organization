<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Employee Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}" enctype="multipart/form-data"> Back</a>
            </div>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mb-1 mt-1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Firstname*:</strong>
                    <input type="text" name="firstname" class="form-control" placeholder="Employee firstname">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lastname*:</strong>
                    <input type="text" name="lastname" class="form-control" placeholder="Employee lastname">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Middlename*:</strong>
                    <input type="text" name="middlename" class="form-control" placeholder="Employee Middlename">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sex:</strong>
                    <select name="sex" class="form-control">
                        @foreach ($sexTypes as $sex)
                            <option value="{{ $sex['value'] }}">
                                {{ $sex['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Salary:</strong>
                    <input type="number" name="salary" class="form-control" placeholder="Employee Salary">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Branches:</strong>
                    <select name="branches[]" id="branches_select" class="form-control" multiple>
                        @foreach ($branches as $branch)
                            <option value="{{$branch->id }}">
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                    <div id="clear_selection" class="btn btn-primary">Clear selection</div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Create</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function () {
        $("#clear_selection").on('click', function () {
            $("#branches_select").prop('selectedIndex', -1);
        })
    });

</script>
</body>
</html>
