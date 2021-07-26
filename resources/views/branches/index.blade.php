<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Branches List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Branches List</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('branches.create') }}"> Create Branch</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('fail'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Number of employees</th>
            <th>Max Salary</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($branches->data as $branch)
            <tr>
                <td>{{ $branch->id }}</td>
                <td>{{ $branch->name }}</td>
                <td>{{ $branch->employees_qty }}</td>
                <td>{{ $branch->max_salary }}</td>
                <td>
                    <form action="{{ route('branches.destroy',$branch->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('branches.show',$branch->id) }}">View</a>
                        <a class="btn btn-primary" href="{{ route('branches.edit',$branch->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div style="padding: 20px 0;">
            @if(!empty($branches->prev_page_url))
                <a href="{{ $branches->prev_page_url}}" rel="prev"
                   class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                   aria-label="&amp;laquo; Previous">
                    @else
                        <span aria-disabled="true" aria-label="Next &amp;raquo;">
							@endif
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 style="height: 20px;width: 20px;">
								<path fill-rule="evenodd"
                                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                      clip-rule="evenodd"></path>
							</svg>
                        @if(!empty($branches->prev_page_url))
                </a>
                @else
                </span>
            @endif
            @if(!empty($branches->next_page_url))
                <a href="{{ $branches->next_page_url}}" rel="prev"
                   class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                   aria-label="&amp;laquo; Previous">
                    @else
                        <span aria-disabled="true" aria-label="Next &amp;raquo;">
							@endif
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 style="height: 20px;width: 20px;">
								<path fill-rule="evenodd"
                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                      clip-rule="evenodd"></path>
							</svg>
                        @if(!empty($branches->next_page_url))
                </a>
                @else
                </span>
            @endif
        </div>
        <div style="padding: 20px 0;">
            <div>
						<span class="relative z-0 inline-flex shadow-sm rounded-md">
						@foreach($branches->links as $link)
                                @if(!$link->active)
                                    <a href="{{ $link->url}}"
                                       class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                       aria-label="Go to page {{ $link->label}}">
						@else
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">
                                        @endif
                                        {!! $link->label!!}
                                        @if(!$link->active)
						</a>
                                @else
						</span>
                @endif
                @endforeach
            </div>
        </div>
    </nav>
</div>
</body>
</html>
