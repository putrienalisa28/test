@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Master /</span> COA</h4>
    <!-- DataTable with Buttons -->
    <div class="row">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                    <table class="table table-responsive table-striped table-hover">
                        <thead>
                            <tr>
                                <th>lable</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Form Input COA</h5>
                <div class="card-body">
                    <div x-data="{ accountNumber : '', accountName: '', groupName: '', }">
                        <form @submit.prevent="saveData()">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Number COA</label>
                                <input type="text" x-model="accountNumber" name="accountNumber" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Account Name</label>
                                <input type="text" x-model="accountName" name="accountName" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Group COA</label>
                                <select class="form-select" x-model="groupName" name="groupName" id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="pt-1">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection