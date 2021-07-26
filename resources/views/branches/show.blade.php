<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>View Branch Form</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
	</head>
	<body>
		<div class="container mt-2">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2>View Branch</h2>
				</div>
				<div class="pull-right">
                <form action="{{ route('branches.destroy',$branch->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('branches.index') }}" enctype="multipart/form-data"> Back</a>
                    <a class="btn btn-secondary" href="{{ route('branches.edit', $branch->id) }}">Edit</a>
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
						<strong>Name:</strong>
						{{ $branch->name }}
					</div>
				</div>
		</div>
	</body>
</html>
