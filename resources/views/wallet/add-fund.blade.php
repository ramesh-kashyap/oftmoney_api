@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow" style="padding-top: 10px; margin-top: 10px;">
    <h2 class="text-2xl font-semibold mb-4" style="margin-left: 10px;margin-top: 10px">
        Add Funds
    </h2>
    <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title">Floating labels</h4>
                                        <p class="text-muted font-14">
                                            Wrap a pair of <code>&lt;input class="form-control"&gt;</code> and <code>&lt;label&gt;</code> elements in <code>.form-floating</code> to enable floating labels with Bootstrap’s textual form fields. A <code>placeholder</code> is required on each <code>&lt;input&gt;</code> as our method of CSS-only floating labels uses the <code>:placeholder-shown</code> pseudo-element. Also note that the <code>&lt;input&gt;</code> must come first so we can utilize a sibling selector (e.g., <code>~</code>).
                                        </p> -->
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            <!-- <li class="nav-item">
                                                <a href="#floating-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    Preview
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#floating-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                    Code
                                                </a>
                                            </li> -->
                                        </ul> <!-- end nav-->
                                     
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="floating-preview">
                                                <div class="row">
                                                    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                                                    <form action="{{ route('admin.buy.funds') }}" method="post">
                                                        @csrf
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-3">Buy Funds</h5>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="user_id" class="form-control" id="floatingInput" placeholder="Enter Telegram Id">
                                                            <label for="floatingInput">Enter Telegram Id</label>
                                                        </div>
                                                        <div class="form-floating">
                                                            <input type="Number" name="amount" class="form-control" id="floatingPassword" placeholder="Enter Amount">
                                                            <label for="floatingPassword">Enter Amount</label>
                                                        </div>
                                                
                                                       
                                                        <div class="mt-4">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <!-- <div class="col-lg-6">
                                                        <h5 class="mb-3">Selects</h5>
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                                <option selected="">Open this select menu</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                            <label for="floatingSelect">Works with selects</label>
                                                        </div>
                                                
                                                        <h5 class="mb-3 mt-4">Layout</h5>
                                                        <div class="row g-2">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="email" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="mdo@example.com">
                                                                    <label for="floatingInputGrid">Email address</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                                        <option selected="">Open this select menu</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                    <label for="floatingSelectGrid">Works with selects</label>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="mt-4">
                                                            <button type="submit" class="btn btn-primary">Sign in</button>
                                                        </div>
                                                        
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div> <!-- end tab-content-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>

     </div>

@endsection