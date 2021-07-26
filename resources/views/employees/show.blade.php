<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Employee Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>View Employee</h2>
            </div>
            <div class="pull-right">
                <form action="{{ route('employees.destroy',$employee->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('employees.index') }}" enctype="multipart/form-data">
                        Back</a>
                    <a class="btn btn-secondary" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Firstname:</strong>
                {{ $employee->firstname }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lastname:</strong>
                {{ $employee->lastname }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Middlename:</strong>
                {{ $employee->middlename }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Sex:</strong>
                {{ $employee->sex }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Salary:</strong>
                {{ $employee->salary }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Branches:</strong>
                @foreach ($branches as $branch)
                    <p>{{ $branch->name }}</p>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
