<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Employee</h2>
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
    <form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Firstname*:</strong>
                    <input type="text" name="firstname" value="{{ $employee->firstname }}" class="form-control"
                           placeholder="Employee firstname">
                    @error('firstname')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lastname*:</strong>
                    <input type="text" name="lastname" value="{{ $employee->lastname }}" class="form-control"
                           placeholder="Employee lastname">
                    @error('lastname')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Middlename*:</strong>
                    <input type="text" name="middlename" value="{{ $employee->middlename }}" class="form-control"
                           placeholder="Employee Middlename">
                    @error('middlename')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sex:</strong>
                    <select name="sex" class="form-control">
                        @foreach ($sexTypes as $sex)
                            <option value="{{ $sex['value'] }}"
                                    @if($sex['selected'])
                                    selected @endif>{{ $sex['name'] }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Salary:</strong>
                    <input type="salary" name="salary" value="{{ $employee->salary }}" class="form-control"
                           placeholder="Employee Salary">
                    @error('salary')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Branches:</strong>
                    <select name="branches[]" id="branches_select" class="form-control" multiple>
                        @foreach ($branches as $branch)
                            <option value="{{$branch->id }}"
                                    @foreach ($branchesWithEmployee as $branchWithEmployee)
                                    @if($branchWithEmployee->id == $branch->id)
                                    selected
                                @endif
                                @endforeach
                            >{{ $branch->name }}

                            </option>
                        @endforeach

                    </select>
                    <div id="clear_selection" class="btn btn-primary">Clear selection</div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Save</button>
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
