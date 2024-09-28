{{-- resources/views/admin/users/view.blade.php --}}
@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title d-flex justify-content-between align-items-center">
                <h5>User Details</h5>
                <a class="btn btn-primary" href="{{route('admin.users')}}" style="margin-right:-72px;"><i
                        class="fa fa-arrow-left"> </i> All Users</a>

            </div>
            <div class="ibox-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="" method="post" id="addRecord" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <div class="row mt-4">
                                <div class="form-group col-5">
                                    <label for="name" class="form-label">
                                        <h4>Name</h4>
                                    </label>
                                    <input type="text" class="form-control" name="name" disabled id="name"
                                        value="{{$user->name}}" required />
                                </div>
                                <div class="form-group col-7">
                                    <label for="email" class="form-label">
                                        <h4>Email</h4>
                                    </label>
                                    <input type="text" class="form-control" name="email" disabled id="email"
                                        value="{{$user->email}}" required />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="form-group col-12">
                                    <label for="name" class="form-label">
                                        <h4>Referal Code</h4>
                                    </label>
                                    <input type="text" class="form-control" name="referral_code" disabled
                                        id="referral_code" value="{{  $user->referral_code }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-auto">
                            <label for="editImage" style="cursor: pointer;" class="form-label float-right float-end">
                                <div id="cropContainer my-auto">
                                    <input type="file" name="image" id="image" hidden>
                                    <label><img id="imageView"
                                            src="{{asset('/uploads/profile/' . ($user->image ?? 'avatar.jpg'))}}"
                                            style=" width:200px; height: 200px;" alt="Image View"></label>
                                </div>
                        </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="tickersTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Client Email</th>
                            <th>Client Phone Number</th>
                            <th>Project Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="ihub-news-records">
                        @foreach($referrals as $referral)
                            <tr class="gradeX">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$referral->name}}</td>
                                <td>{{$referral->email}}</td>
                                <td>{{$referral->phone_number}}</td>
                                <td>{{$referral->project_type}}</td> <!-- Project Type shown here -->
                                @if ($referral->status == 'in_progress')
                                    <td class="text-info fw-bold">In Progress</td>
                                @elseif ($referral->status == 'completed')
                                    <td class="text-success fw-bold">Completed</td>
                                @elseif ($referral->status == 'not_started')
                                    <td class="text-warning fw-bold">Not Started</td>
                                @else
                                    <td class="text-danger fw-bold">Cancelled</td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    function capture() {
        const captureElement = document.querySelector('#tree_canvas')
        html2canvas(captureElement)
            .then(canvas => {
                canvas.style.display = 'none'
                document.body.appendChild(canvas)
                return canvas
            })
            .then(canvas => {
                const image = canvas.toDataURL('image/png')
                const a = document.createElement('a')
                a.setAttribute('download', 'tree.png')
                a.setAttribute('href', image)
                a.click()
                canvas.remove()
            })
    }
</script>
@endsection